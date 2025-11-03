<?php

/**
 * This file is part of the TelegramBot package.
 *
 * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Conversation;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\KeyboardButton;
use Longman\TelegramBot\Entities\PhotoSize;
use Longman\TelegramBot\Request;
use App\Models\Members;
use Longman\TelegramBot\Entities\ServerResponse;

/**
 * User "/survery" command
 */
class RegCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'reg';
    /**
     * @var string
     */
    protected $description = 'Registration';
    /**
     * @var string
     */
    protected $usage = '/reg';
    /**
     * @var string
     */
    protected $version = '0.0.1';
    /**
     * @var bool
     */

    /**
     * Conversation Object
     *
     * @var \Longman\TelegramBot\Conversation
     */
    protected $conversation;
    /**
     * Command execute method
     *
     * @return mixed
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute(): ServerResponse
    {
        $message = $this->getMessage();
        $chat = $message->getChat();
        $user = $message->getFrom();
        $text = trim($message->getText(true));
        $chat_id = $chat->getId();
        $user_id = $user->getId();
        //Preparing Response
        $data = ['chat_id' => $chat_id];
        // $res =  Request::getChatMember([
        //     'chat_id' => '-1001193599884',
        //     'user_id' => $user_id,
        // ])->getResult();

        // if (!in_array($res->getStatus(), ["member", "administrator", "creator"])) {
        //     $data['text'] = "Sizda botdan foydalanishga huquq yo'q! Chunki siz kanal a'zosi emassiz";
        //     return Request::sendMessage($data);
        // }
        if ($chat->isGroupChat() || $chat->isSuperGroup()) {
            //reply to message id is applied by default
            //Force reply is applied by default so it can work with privacy on
            $data['reply_markup'] = Keyboard::forceReply(['selective' => true]);
        }
        //Conversation start
        $this->conversation = new Conversation($user_id, $chat_id, $this->getName());
        $notes = &$this->conversation->notes;
        !is_array($notes) && ($notes = []);
        //cache data from the tracking session if any
        $state = 0;
        if (isset($notes['state'])) {
            $state = $notes['state'];
        }
        $result = Request::emptyResponse();


        //State machine
        //Entrypoint of the machine state if given by the track
        //Every time a step is achieved the track is updated
        switch ($state) {
            case 0:
                if ($text === '' || !in_array($text, ['Roziman'], true)) {
                    $notes['state'] = 0;
                    $this->conversation->update();
                    $data['reply_markup'] = (new Keyboard(['Roziman ', 'Rozi emasman']))->setResizeKeyboard(true)->setOneTimeKeyboard(true)->setSelective(true);

                    $user = Members::where('telegram_id', $user_id)->first();
                    if ($user != null) {
                        $this->conversation->stop();
                        $data['text'] = "*Siz tizimdan muvoffaqiyatli ro'yxatdan o'tgansiz* \n*F.I.O:* `$user->telegram_id`\n*Viloyat yoki shahr:* `$user->adress`\n*Telefon raqamingiz:* `$user->tell`\n*Telegram ID:* `$user->telegram_id`\n";
                        $data['parse_mode'] = "Markdown";
                        $data['reply_markup'] = Keyboard::remove(['selective' => true]);
                        $result = Request::sendMessage($data);
                        return Request::emptyResponse();
                    }
                    $data['text'] = "Botdan foydalanish qoidalari: \n https://bit.ly/1111111111111 \n Roziman tugmasini bosish orqali foydalanish shartlariga rozilik birldirgan hisoblanasiz!";
                    if ($text !== '') {
                        $data['text'] = "Botdan foydalanish qoidalari: \n https://bit.ly/111111111 \n Roziman tugmasini bosish orqali foydalanish shartlariga rozilik birldirgan hisoblanasiz!";
                    }

                    if ($text == 'Rozi emasman') {

                        $this->getTelegram()->executeCommand('start');
                        $this->conversation->stop();
                        return Request::emptyResponse();
                    }

                    $result = Request::sendMessage($data);
                    break;
                }

                $notes['shart'] = $text;
                $text         = '';
                // no break
                // no break    

            case 1:
                if ($text === '') {
                    $notes['state'] = 1;
                    $this->conversation->update();
                    $data['text'] = 'F.I.O:...';
                    $data['reply_markup'] = Keyboard::remove(['selective' => true]);
                    $result = Request::sendMessage($data);
                    break;
                }
                $notes['full_name'] = $text;
                $text = '';
                // no break
                // no break
            case 2:
                if ($text === '' || !in_array($text, [
                    'Jizzax viloyati',
                    'Andijon viloyati',
                    "Buxoro viloyati",
                    "Fargʻona viloyati",
                    "Xorazm viloyati",
                    "Namangan viloyati",
                    "Navoiy viloyati",
                    "Qashqadaryo viloyati",
                    "Qoraqalpogʻiston Respublikasi",
                    "Samarqand viloyati",
                    "Sirdaryo viloyati",
                    "Surxondaryo viloyati",
                    "Toshkent viloyati",
                    "Toshkent shahar",
                    "Boshqa"
                ], true)) {
                    $notes['state'] = 2;
                    $this->conversation->update();
                    $data['reply_markup'] = (new Keyboard(
                        [
                            'Jizzax viloyati',
                            'Andijon viloyati',
                        ],
                        [
                            "Buxoro viloyati",
                            "Fargʻona viloyati",
                        ],
                        [
                            "Xorazm viloyati",
                            "Namangan viloyati",
                        ],
                        [
                            "Navoiy viloyati",
                            "Qashqadaryo viloyati",
                        ],
                        [
                            "Qoraqalpogʻiston Respublikasi",
                            "Samarqand viloyati",
                        ],
                        [
                            "Sirdaryo viloyati",
                            "Surxondaryo viloyati",
                        ],
                        [
                            "Toshkent viloyati",
                            "Toshkent shahar",
                        ],
                        ["Boshqa"]
                    ))->setResizeKeyboard(true)->setOneTimeKeyboard(true)->setSelective(true);
                    $data['text'] = "Viloyat yoki shahringizni tanlang:";
                    if ($text !== '') {
                        $data['text'] = "Viloyat yoki shahringizni tanlang:";
                    }
                    $result = Request::sendMessage($data);
                    break;
                }

                $notes['adress'] = $text;
                $text         = '';
            case 3:
                if ($text === '') {
                    $notes['state'] = 3;
                    $this->conversation->update();
                    $data['text'] = 'O\'zingiz haqingizda(Ish joyingizni, o\'qish joyingiz): ';
                    $result = Request::sendMessage($data);
                    break;
                }
                $notes['description'] = $text;
                $text = '';
                // no break
                // no break

            case 4:
                if ($message->getContact() === null) {
                    $notes['state'] = 4;
                    $this->conversation->update();
                    $data['reply_markup'] = (new Keyboard((new KeyboardButton('Share Contact'))->setRequestContact(true)))->setOneTimeKeyboard(true)->setResizeKeyboard(true)->setSelective(true);
                    $data['text'] = "Telefon raqamingiz:";
                    $result = Request::sendMessage($data);
                    break;
                }
                $notes['phone_number'] = $message->getContact()->getPhoneNumber();
                // no break
                // no break
            case 3:
                $this->conversation->update();
                $data['reply_markup'] = Keyboard::remove(['selective' => true]);
                $student = new Members();
                $student->full_name = $notes['full_name'];
                $student->adress = $notes['adress'];
                $student->description = $notes['description'];
                $student->tell = $notes['phone_number'];
                $student->telegram_id = $user_id;
                $student->status = 1;
                if ($student->save()) {
                    $out_text = "*Siz muvoffaqiyatli ro'yxatdan o'tdingiz* \n*F.I.O:* `$student->full_name`\n*Viloyat yoki shaxar:* `$student->adress`\n*Ish joyingiz:* `$student->description`\n*Telefon raqamingiz:* `$student->tell`\n*Telegram ID:* `$student->telegram_id`\n /start buyrug'ini kiriting!";
                } else {
                    $out_text = "Xatolik yuzaga keldi! Iltimos takror urinib ko'ring!";
                }

                $data['text'] = $out_text;
                $data['parse_mode'] = "Markdown";
                $this->conversation->stop();
                $result = Request::sendMessage($data);
                break;
        }
        return $result;
    }
}