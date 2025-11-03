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
use Longman\TelegramBot\Entities\ServerResponse;

/**
 * User "/survery" command
 */
class SavoljavobCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'savoljavob';
    /**
     * @var string
     */
    protected $description = 'Savoljavob for bot users';
    /**
     * @var string
     */
    protected $usage = '/savoljavob';
    /**
     * @var string
     */
    protected $version = '0.3.0';
    /**
     * @var bool
     */
    protected $need_mysql = true;
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
        $message_id = $message->getMessageId();
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
                if ($text === '') {
                    $notes['state'] = 0;
                    $this->conversation->update();
                    $data['text'] = 'Savolingizni kiriting:...';
                    $data['reply_markup'] = Keyboard::remove(['selective' => true]);
                    $result = Request::sendMessage($data);
                    break;
                }
                $notes['fio'] = $text;
                $text = '';
                // no break
                // no break

            case 1:
                $this->conversation->update();
                $out_text = "Savolingiz qabul qilindi";

                $data['reply_markup'] = Keyboard::remove(['selective' => true]);
                $data['text'] = $out_text;
                $this->conversation->stop();

                $text = trim($message->getText(true));
                $msg =  \App\Models\Appeals::create([
                    'student_id' => $user_id,
                    'message_id' => $message_id,
                    'chat_id' => $chat_id,
                    'message' => $text
                ]);
                if ($msg) {
                    $data['text'] = "Savolingiz muvoffaqiyatli yuborildi! Savol id: " . $message_id;
                }

                $result = Request::sendMessage($data);
                break;
        }
        return $result;
    }
}