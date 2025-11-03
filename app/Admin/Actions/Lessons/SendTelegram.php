<?php

namespace App\Admin\Actions\Lessons;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\TelegramActions;

class SendTelegram extends RowAction
{
    public $name = 'send';

    public function handle(Model $model)
    {
        // $model ...
        if (TelegramActions::sendLession($model->id)) {
            return $this->response()->success('Success message.')->refresh();
        } else {
            return $this->response()->error('Errors')->refresh();
        }
    }
}
