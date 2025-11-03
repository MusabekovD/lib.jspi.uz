<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Exception;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Conversation;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\InlineKeyboardButton;
use Longman\TelegramBot\Request;
use Illuminate\Support\Facades\Log;
use App\Models\CategoriesBooks;
use App\Models\Books;
use App\Models\LikeBooks;
use App\Models\MyBooks;
use App\Models\HelperBot;
use App\Students;
use App\TelegramActions;
use App\TestAnswers;
use App\HistoryViews;
use App\Models\Members;
use Longman\TelegramBot\Entities\ServerResponse;



class CallbackqueryCommand extends SystemCommand
{
    protected $name = 'callbackquery';
    protected $description = 'Reply to callback query';
    protected $version = '1.0.0';
    protected $callback_query_id;

    public function execute(): ServerResponse
    {
        $update         = $this->getUpdate();
        $callback_query = $update->getCallbackQuery();
        $from       = $callback_query->getFrom();
        $user_id    = $from->getId();
        $callback_query_id = $callback_query->getId();
        $callback_data  = $callback_query->getData();
        $data_call = explode("_", $callback_data);


        $member = Members::where('telegram_id', $user_id)->first();
        if ($member == null) {
            $text = "Siz tizimdan ro'yxatdan o'tmagansiz! @jspilibbot botdan ro'yxatdan o'ting!";
            return TelegramActions::answerCallBack($text, $callback_query_id);
        }

        switch ($data_call[0]) {


            case "categories":

                $categories =  CategoriesBooks::withCount('books')->get();

                $rows = [];
                foreach ($categories as $category) {
                    $rows[] = [
                        ['text' => $category['name'] . " ({$category['books_count']})", 'callback_data' => "category_" . $category['id']]
                    ];
                }
                $rows[] = [
                    ['text' => "🔗 Kategoriyalar 🔗", 'callback_data' => "categories"]
                ];
                $rows[] = [
                    ['text' => "🏢 Bosh menyuga qaytish 🏢", 'callback_data' => "main"]
                ];
                $inline_keyboard = new InlineKeyboard(...$rows);
                // $data['reply_markup'] = $inline_keyboard;
                $data['text'] = "Jizzax davlat pedagogika instituti Axborot resurs markazi elektron kutubxonasi kategoriyalari";
                $data['parse_mode'] = "Markdown";
                $data['reply_markup'] = $inline_keyboard;
                $data['chat_id']    = $callback_query->getMessage()->getChat()->getId();
                $data['message_id']    = $callback_query->getMessage()->getMessageId();
                return Request::editMessageText($data);


                break;

            case "delete":
                if ($callback_query->getMessage()->getChat()->isGroupChat() || $callback_query->getMessage()->getChat()->isSuperGroup()) {
                    //reply to message id is applied by default
                    //Force reply is applied by default so it can work with privacy on
                    // $data['reply_markup'] = Keyboard::forceReply(['selective' => true]);
                    $text = "@jspilibbot bot orqali foydalanishingiz mumkin!";
                    return TelegramActions::answerCallBack($text, $callback_query_id);
                }
                $data['chat_id']    = $callback_query->getMessage()->getChat()->getId();
                $data['message_id']    = $callback_query->getMessage()->getMessageId();
                return Request::deleteMessage($data);
                break;
            case "book":

                $book = Books::findOrFail($data_call[1]);
                $book->view_count = $book->view_count + 1;
                $book->save();
                $text = "#" . $book->category->name . PHP_EOL;
                $text .= "📕 <b>Nomi:</b> " . $book->title . PHP_EOL;
                $text .= "👤 <b>Muallif:</b> " . $book->muallif->name . PHP_EOL;
                $text .= "📖 <b>Til:</b> " . $book->lang->name . PHP_EOL;
                $text .= "📍 <b>Yozuv:</b> " . $book->read_lang() . PHP_EOL;
                $text .= "🏢 <b>Nashiryot:</b> " . $book->publishing->name . PHP_EOL;
                $text .= "📌 <b>Nashr yili:</b> " . $book->b_published_year . PHP_EOL;
                $text .= "✳️ <b>Ko'rishlar soni:</b> " . $book->view_count . PHP_EOL;
                $text .= "@jspilibbot";
                $likeCount = LikeBooks::where('books_id', $data_call[1])->count();
                $myBookExits = MyBooks::where(['books_id' => $data_call[1]])->count();
                $myBookCOUNT = MyBooks::where(['members_id' => $user_id])->count();
                $rows[] = [
                    ['text' => "💾 ({$myBookExits})", 'callback_data' => "fovrite_" . $book->id],

                    ['text' => "❌", 'callback_data' => "delete_" . $callback_query->getMessage()->getMessageId()],
                    ['text' => "❤️ ({$likeCount})", 'callback_data' => "like_" . $book->id],
                ];
                $rows[] = [
                    ['text' => "Mening kutubxonam ({$myBookCOUNT})", 'callback_data' => "mylibs"]
                ];
                $rows[] = [
                    ['text' => "📎 Yuklab olish", 'url' => $book->getFile()]
                ];
                $inline_keyboard = new InlineKeyboard(...$rows);
                $data['reply_markup'] = $inline_keyboard;
                $data['caption'] = $text;
                $data['parse_mode'] = "HTML";
                $data['photo'] = $book->getImage();
                $data['reply_markup'] = $inline_keyboard;
                $data['chat_id']    = $callback_query->getMessage()->getChat()->getId();

                return Request::sendPhoto($data);
                break;
            case "like":
                $book = Books::findOrFail($data_call[1]);

                $likeBook = LikeBooks::where(['books_id' => $book->id, 'members_id' => $user_id])->first();
                if ($likeBook != null) {
                    $likeBook->delete();
                } else {
                    LikeBooks::create(['books_id' => $data_call[1], 'members_id' => $user_id]);
                }
                $likeCount = LikeBooks::where('books_id', $data_call[1])->count();
                $myBookExits = MyBooks::where(['books_id' => $data_call[1]])->count();
                $myBookCOUNT = MyBooks::where(['members_id' => $user_id])->count();

                $rows[] = [
                    ['text' => "💾 ({$myBookExits})", 'callback_data' => "fovrite_" . $book->id],

                    ['text' => "❌", 'callback_data' => "delete_" . $callback_query->getMessage()->getMessageId()],
                    ['text' => "❤️ (" . $likeCount . ")", 'callback_data' => "like_" . $book->id],
                ];
                $rows[] = [
                    ['text' => "Mening kutubxonam ({$myBookCOUNT})", 'callback_data' => "mylibs"]
                ];
                $rows[] = [
                    ['text' => "📎 Yuklab olish", 'url' => $book->getFile()]
                ];

                $inline_keyboard = new InlineKeyboard(...$rows);
                $data['reply_markup'] = $inline_keyboard;
                $data['chat_id']    = $callback_query->getMessage()->getChat()->getId();
                $data['message_id']    = $callback_query->getMessage()->getMessageId();
                return Request::editMessageReplyMarkup($data);
                break;
            case "fovrite":
                $book = Books::findOrFail($data_call[1]);

                $myBook = MyBooks::where(['books_id' => $book->id, 'members_id' => $user_id])->first();
                if ($myBook != null) {
                    $myBook->delete();
                } else {
                    MyBooks::create(['books_id' => $data_call[1], 'members_id' => $user_id]);
                }


                $myBookExits = MyBooks::where(['books_id' => $data_call[1]])->count();
                $myBookCOUNT = MyBooks::where(['members_id' => $user_id])->count();
                $likeCount = LikeBooks::where('books_id', $data_call[1])->count();
                $rows[] = [
                    ['text' => "💾 ({$myBookExits})", 'callback_data' => "fovrite_" . $book->id],
                    ['text' => "❌", 'callback_data' => "delete_" . $callback_query->getMessage()->getMessageId()],
                    ['text' => "❤️ (" . $likeCount . ")", 'callback_data' => "like_" . $book->id],
                ];
                $rows[] = [
                    ['text' => "Mening kutubxonam ({$myBookCOUNT})", 'callback_data' => "mylibs"]
                ];
                $rows[] = [
                    ['text' => "📎 Yuklab olish", 'url' => $book->getFile()]
                ];

                $inline_keyboard = new InlineKeyboard(...$rows);
                $data['reply_markup'] = $inline_keyboard;
                $data['chat_id']    = $callback_query->getMessage()->getChat()->getId();
                $data['message_id']    = $callback_query->getMessage()->getMessageId();
                return Request::editMessageReplyMarkup($data);
                break;
            case "category":
                $category = CategoriesBooks::findOrFail($data_call[1]);
                $pageNumber = isset($data_call[2]) ? $data_call[2] : 1;

                $dataHelper = HelperBot::generatePaginate($pageNumber, ['category_id' => $category->id], $category->name, "category_" . $data_call[1] . "_");
                if (count($dataHelper['keyboard']) > 0) {
                    $rows = $dataHelper['keyboard'];
                }

                // Log::info($dataHelper);

                $text = $dataHelper['text'];
                $rows[] = [
                    ['text' => "🔗 Kategoriyalar 🔗", 'callback_data' => "categories"]
                ];
                $rows[] = [
                    ['text' => "🏢 Bosh menyuga qaytish 🏢", 'callback_data' => "main"]
                ];
                $inline_keyboard = new InlineKeyboard(...$rows);
                // $data['reply_markup'] = $inline_keyboard;
                $data['text'] = $text;
                $data['parse_mode'] = "HTML";
                $data['reply_markup'] = $inline_keyboard;
                $data['chat_id']    = $callback_query->getMessage()->getChat()->getId();
                $data['message_id']    = $callback_query->getMessage()->getMessageId();
                return Request::editMessageText($data);
                break;
            case "search":

                $message_text = $data_call[1];

                $pageNumber = isset($data_call[2]) ? $data_call[2] : 1;

                $dataHelper = HelperBot::generatePaginateSearch($pageNumber, $message_text, "search_" . $message_text . "_");
                if (count($dataHelper['keyboard']) > 0) {
                    $rows = $dataHelper['keyboard'];
                }
                $text = $dataHelper['text'];

                $rows[] = [
                    ['text' => "🔗 Kategoriyalar 🔗", 'callback_data' => "categories"]
                ];
                $rows[] = [
                    ['text' => "🏢 Bosh menyuga qaytish 🏢", 'callback_data' => "main"]
                ];
                $inline_keyboard = new InlineKeyboard(...$rows);
                // $data['reply_markup'] = $inline_keyboard;
                $data['text'] = $text;
                $data['parse_mode'] = "HTML";
                $data['reply_markup'] = $inline_keyboard;
                $data['chat_id']    = $callback_query->getMessage()->getChat()->getId();
                $data['message_id']    = $callback_query->getMessage()->getMessageId();
                return Request::editMessageText($data);
                break;
            case "mylibs":
                if ($callback_query->getMessage()->getChat()->isGroupChat() || $callback_query->getMessage()->getChat()->isSuperGroup()) {
                    //reply to message id is applied by default
                    //Force reply is applied by default so it can work with privacy on
                    // $data['reply_markup'] = Keyboard::forceReply(['selective' => true]);
                    $text = "@jspilibbot bot orqali foydalanishingiz mumkin!";
                    return TelegramActions::answerCallBack($text, $callback_query_id);
                }

                $pageNumber = isset($data_call[1]) ? $data_call[1] : 1;

                $dataHelper = HelperBot::generatePaginateLibs($pageNumber, $user_id, "mylibs_");
                if (count($dataHelper['keyboard']) > 0) {
                    $rows = $dataHelper['keyboard'];
                }
                $text = $dataHelper['text'];

                $rows[] = [
                    ['text' => "🔗 Kategoriyalar 🔗", 'callback_data' => "categories"]
                ];
                $rows[] = [
                    ['text' => "🏢 Bosh menyuga qaytish 🏢", 'callback_data' => "main"]
                ];
                $inline_keyboard = new InlineKeyboard(...$rows);
                // $data['reply_markup'] = $inline_keyboard;
                $data['text'] = $text;
                $data['parse_mode'] = "HTML";
                $data['reply_markup'] = $inline_keyboard;
                $data['chat_id']    = $callback_query->getMessage()->getChat()->getId();
                $data['message_id']    = $callback_query->getMessage()->getMessageId();
                return Request::sendMessage($data);
                break;
            case "searchCommand":

                $rows[] = [
                    ['text' => "🔗 Kategoriyalar 🔗", 'callback_data' => "categories"]
                ];
                $rows[] = [
                    ['text' => "🏢 Bosh menyuga qaytish 🏢", 'callback_data' => "main"]
                ];
                $text = "Botga izlash uchun kalit so'zni yuboring! Masalan: Algebra";
                $inline_keyboard = new InlineKeyboard(...$rows);
                // $data['reply_markup'] = $inline_keyboard;
                $data['text'] = $text;
                $data['parse_mode'] = "HTML";
                $data['reply_markup'] = $inline_keyboard;
                $data['chat_id']    = $callback_query->getMessage()->getChat()->getId();
                $data['message_id']    = $callback_query->getMessage()->getMessageId();
                return Request::editMessageText($data);
                break;
            case "message":

                $rows[] = [
                    ['text' => "🔗 Kategoriyalar 🔗", 'callback_data' => "categories"]
                ];
                $rows[] = [
                    ['text' => "🏢 Bosh menyuga qaytish 🏢", 'callback_data' => "main"]
                ];
                $text = "/savoljavob buyrug'ini bosing";
                $inline_keyboard = new InlineKeyboard(...$rows);
                // $data['reply_markup'] = $inline_keyboard;
                $data['text'] = $text;
                $data['parse_mode'] = "HTML";
                $data['reply_markup'] = $inline_keyboard;
                $data['chat_id']    = $callback_query->getMessage()->getChat()->getId();
                $data['message_id']    = $callback_query->getMessage()->getMessageId();
                return Request::editMessageText($data);
                break;


            case "main":


                $data['reply_markup'] = TelegramActions::mainMenu();
                $data['chat_id']    = $callback_query->getMessage()->getChat()->getId();
                $data['message_id']    = $callback_query->getMessage()->getMessageId();
                $data['text'] = "**Xush kelibsiz Jizzax davlat pedagogika instituti Axborot resurs markazi elektron kutubxonasiga!!! **" . PHP_EOL . "Elektron kutubxonamiz bazasida **" . Books::all()->count() . "** ta resurs mavjud" . PHP_EOL . " **Asosiy menyu** ";
                $data['parse_mode'] = "Markdown";
                return Request::editMessageText($data);
                break;



            default:
                return Request::editMessageText([
                    'chat_id'    => $callback_query->getMessage()->getChat()->getId(),
                    'message_id' => $callback_query->getMessage()->getMessageId(),
                    'text'       => "not selected",
                ]);
                break;
        }
    }

    private function answerCallBack($text, $callback_query_id)
    {
        $data['callback_query_id'] = $callback_query_id;
        $data['show_alert'] = true;
        $data['text'] = $text;
        return Request::answerCallbackQuery($data);
    }

    // public function addWatermark(): ServerResponse
    // {
    //     $callback_query = $this->getCallbackQuery();
    //     $message        = $callback_query->getMessage();
    //     $chat_id        = $message->getChat()->getId();
    //     $conv  = new Conversation($chat_id, $chat_id, 'watermark');
    //     $notes = &$conv->notes;
    //     $string = $message->getText() ?: $message->getCaption() ?? '';
    //     $photo = $message->getPhoto();
    //     $photo = end($photo);
    //     // Changing state of watermark command
    //     // state 2 in there adds the watermark to the image
    //     $notes['watermark']['state']           = 2;
    //     $notes['watermark']['message_details'] = [
    //         'chat_id' => $chat_id,
    //         'file_id' => $photo->file_id,
    //         'string'  => $string,
    //     ];
    //     $conv->update();
    //     Request::sendMessage([
    //         'chat_id' => $chat_id,
    //         'text'    => 'Now send me a string with max 30 characters to be added as watermark to the image.',
    //     ]);
    //     return Request::answerCallbackQuery([
    //         'callback_query_id' => $callback_query->getId(),
    //         'text'              => 'Almost done!',
    //     ]);
    // }
}