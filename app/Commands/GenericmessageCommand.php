<?php

/**
 * This file is part of the PHP Telegram Bot example-bot package.
 * https://github.com/php-telegram-bot/example-bot/
 *
 * (c) PHP Telegram Bot Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Generic message command
 *
 * Gets executed when any type of message is sent.
 *
 * In this message-related context, we can handle any kind of message.
 */

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;
use Illuminate\Support\Facades\Log;
use App\Models\HelperBot;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Conversation;

class GenericmessageCommand extends SystemCommand
{
    /** 
     * @var string
     */
    protected $name = 'genericmessage';

    /**
     * @var string
     */
    protected $description = 'Handle generic message';

    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * Main command execution
     *
     * @return ServerResponse
     */
    public function execute(): ServerResponse
    {

        $message = $this->getMessage();

        if (empty($message)) {
            return Request::emptyResponse();
        }

        $chat = $message->getChat();
        $chat_id = $chat->getId();
        $user_id = $message->getFrom()->getId();
        $message_text = $message->getText(true);

        if ($chat->isGroupChat() || $chat->isSuperGroup()) {
            //reply to message id is applied by default
            //Force reply is applied by default so it can work with privacy on
            // $data['reply_markup'] = Keyboard::forceReply(['selective' => true]);
            if (strpos($message_text, '#bookneed') !== false || strpos($message_text, '#Bookneed') !== false) {
                $userFio =  $message->getFrom()->getFirstName();
                $datasend['chat_id']    = 49690237;
                $datasend['from_chat_id']    = $chat->getId();
                $datasend['message_id']    =  $message->getMessageId();
                Request::forwardMessage($datasend);
                $datasend['chat_id']    = 236898818;
                $datasend['from_chat_id']    = $chat->getId();
                $datasend['message_id']    =  $message->getMessageId();
                Request::forwardMessage($datasend);
                return $this->replyToChat("Salom {$userFio}! So`rovingiz hodimlarimizga yuborildi!");
            }
            return Request::emptyResponse();
        }
        //If a conversation is busy, execute the conversation command after handling the message
        $conversation = new Conversation(
            $this->getMessage()->getFrom()->getId(),
            $this->getMessage()->getChat()->getId()
        );
        //Fetch conversation command if it exists and execute it
        if ($conversation->exists() && ($command = $conversation->getCommand())) {
            return $this->telegram->executeCommand($command);
        }
        /**
         * Handle any kind of message here
         */
        $rows = [];
        $dataHelper = HelperBot::generatePaginateSearch(1, $message_text, "search_" . $message_text . "_");
        if (count($dataHelper['keyboard']) > 0) {
            $rows = $dataHelper['keyboard'];
        }
        $text = $dataHelper['text'];
        $rows[] = [
            ['text' => "Kategoriyalar", 'callback_data' => "categories"]
        ];
        $rows[] = [
            ['text' => "Bosh menyuga qaytish", 'callback_data' => "main"]
        ];
        $inline_keyboard = new InlineKeyboard(...$rows);
        $data['reply_markup'] = $inline_keyboard;
        $data['text'] = $text;
        $data['parse_mode'] = "HTML";
        // $data['reply_markup'] = $inline_keyboard;
        $data['chat_id']    = $chat->getId();
        $data['message_id']    =  $message->getMessageId();
        return Request::sendMessage($data);
    }
}