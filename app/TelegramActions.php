<?php

namespace App;

use Telegram;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Telegram\Bot\FileUpload\InputFile;

use Longman\TelegramBot\Request;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use App\Models\Books;
use App\Models\LikeBooks;
use App\Models\MyBooks;

class TelegramActions
{
    protected $telegram;

    /**
     * __construct
     *
     * @return void
     */
    function __construct()
    {
        $this->telegram = new Api(env('TELEGRAM_BOT_KEY'));
    }

    public static function sendMessage($to, $message)
    {

        $response = Telegram::sendMessage([
            'text' => $message,
            'parse_mode' => "Markdown",
            'chat_id' => $to
        ]);
        return $response;
    }


    public static function testApp()
    {
        $data['chat_id'] = 49690237;
        $data['text'] = "ssssss";
    }

    public static function sendBook($book_id, $chat_id)
    {
        $book = Books::findOrFail($book_id);
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
        $likeCount = LikeBooks::where('books_id', $book_id)->count();
        $myBookExits = MyBooks::where(['books_id' => $book_id])->count();

        $rows[] = [
            ['text' => "💾 ({$myBookExits})", 'callback_data' => "fovrite_" . $book->id],

            // ['text' => "❌", 'callback_data' => "delete_" . $callback_query->getMessage()->getMessageId()],
            ['text' => "❤️ ({$likeCount})", 'callback_data' => "like_" . $book->id],
        ];
        $rows[] = [
            ['text' => "Mening kutubxonam ({$myBookExits})", 'callback_data' => "mylibs"]
        ];
        $rows[] = [
            ['text' => "📎 Yuklab olish", 'url' => $book->getFile()]
        ];
        $inline_keyboard = new InlineKeyboard(...$rows);
        $data['reply_markup'] = $inline_keyboard;
        $data['caption'] = $text;
        //$data['text'] = InputFile::create(storage_path('app/public/uploads/' . $book->img), "book"); //InputFile::create(storage_path('app/' . $lesson->s_path), "test");// $book->getImage();
        $data['parse_mode'] = "HTML";
        $data['photo'] = InputFile::create(storage_path('app/public/uploads/' . $book->img), "book");
        $data['reply_markup'] = $inline_keyboard;
        $data['chat_id']    = $chat_id;

        return Telegram::sendPhoto($data);
    }

    public static function answerCallBack($text, $callback_query_id)
    {
        $data['callback_query_id'] = $callback_query_id;
        $data['show_alert'] = true;
        $data['text'] = $text;
        return Request::answerCallbackQuery($data);
    }

    public static function mainMenu()
    {
        return $keyboard = new InlineKeyboard(
            [
                ['text' => '🏢 JDPI Axborot resurs markazi 🏢', 'callback_data' => 'arm'],
            ],
            [
                ['text' => '🔎 Kitob izlash 🔎', 'callback_data' => 'searchCommand'],
            ],
            [
                ['text' => '🖇 Kategoriyalar 🖇', 'callback_data' => 'categories'],
            ],
            [
                ['text' => '📚Mening kutubxonam📚', 'callback_data' => 'mylibs'],
            ],
            [
                ['text' => '📩 Kitobga buyurtma berish 📩', 'callback_data' => 'message'],
            ],
            [
                ['text' => '📨 Murojaat qilish 📨', 'callback_data' => 'message'],
            ],
        );
    }
}
