<?php

namespace App\Admin\Actions\Stuidents;

use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;
use App\TelegramActions;
use Illuminate\Http\Request;

class BatchSendMessage extends BatchAction
{
    public $name = 'Xabar junatish';

    public function handle(Collection $collection, Request $request)
    {
        $users = [];
        $usr_msg = "";
        foreach ($collection as $model) {
            try {
                TelegramActions::sendMessage($model->telegram_user_id, $request->get('sms'));
            } catch (\Exception $e) {
                $users[] = $model;
                $usr_msg .= "\n " . $model->fio . "  Ish: " . $model->work;
            }
        }

        if (count($users) > 0) {
            admin_error("Yuborilmadi", $usr_msg);
        }

        return $this->response()->success('Success message...')->refresh();
    }

    public function form()
    {
        $this->textarea('sms', 'Xabar ma`zmuni')->rules('required');
    }
}
