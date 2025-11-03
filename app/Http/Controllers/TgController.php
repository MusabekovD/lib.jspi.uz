<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TgController extends Controller
{

    public function hook()
    {
        try {
            // Create Telegram API object
            $telegram = new \Longman\TelegramBot\Telegram("7303830975:AAEyC1O4iqfVqEfAr30ENfqDTurBRCLtgGI", "@testmpay_bot");
            $commandsPaths = [
                realpath(app_path('Commands/'))
            ];
            $telegram->addCommandsPaths($commandsPaths);
            $telegram->enableAdmin(49690237);
            // Enable MySQL
            $telegram->enableMySql([
                'host' => "localhost",
                'user' => "root",
                'password' =>  "Dilshod@#123",
                'database' =>  "lib",
            ]);
            // Handle telegram webhook request
            $response = $telegram->handle();
            // $response = $telegram->getTelegram()->handle();
            return response()->json(['status' => 'success']);
        } catch (\Longman\TelegramBot\Exception\TelegramException $e) {
            Log::info(json_encode($e->getMessage()));
        }
    }
}
