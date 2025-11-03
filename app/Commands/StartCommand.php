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
use Longman\TelegramBot\Entities\InlineKeyboard;

use Longman\TelegramBot\Request;
use App\Models\Books;
use App\Models\Members;
use App\TelegramActions;
use Longman\TelegramBot\Entities\ServerResponse;

use Illuminate\Support\Facades\Log;

/**
 * User "/survery" command
 */
class StartCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'start';
    /**
     * @var string
     */
    protected $description = 'Start';
    /**
     * @var string
     */
    protected $usage = '/start';
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
        $data = [
            'chat_id' => $chat_id,
            'text'    => $text,
        ];
        // $res =  Request::getChatMember([
        //     'chat_id' => '-1001193599884',
        //     'user_id' => $user_id,
        // ])->getResult();

        // if (!in_array($res->getStatus(), ["member", "administrator", "creator"])) {
        //     $data['text'] = "Sizda botdan foydalanishga huquq yo'q! Chunki siz kanal a'zosi emassiz";
        //     // $data['text'] = $res->getStatus();
        //     return Request::sendMessage($data);
        //     //return $this->send($data);
        // }
        //Preparing Response
        $data['text'] = 'Hi there!' . PHP_EOL . 'Type /help to see all commands!';
        if (!empty($text)) {
            $data['text'] = "/start buyrug'ini kiriting";
            $data['parse_mode'] = "Markdown";
            return Request::sendMessage($data);
        }

        $member = Members::where('telegram_id', $user_id)->first();
        if ($member == null) {
            $data['text'] = "Siz tizimdan ro'yxatdan o'tmagansiz! Sizning telegram id: $user_id " . PHP_EOL . "Ro'yxatdan o'tish uchun /reg buyrug'ini bosing!";
            return Request::sendMessage($data);
        }

        return $this->sendStartMsg($data);
    }



    public function sendStartMsg($data)
    {

        $data['reply_markup'] = TelegramActions::mainMenu();
        $data['text'] = "**Xush kelibsiz Jizzax davlat pedagogika instituti Axborot resurs markazi elektron kutubxonasiga!!! **" . PHP_EOL . "Elektron kutubxonamiz bazasida **" . Books::all()->count() . "** ta resurs mavjud" . PHP_EOL . " **Asosiy menyu** ";
        $data['parse_mode'] = "Markdown";
        return Request::sendMessage($data);
    }
}