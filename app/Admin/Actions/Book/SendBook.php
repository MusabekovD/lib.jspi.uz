<?php

namespace App\Admin\Actions\Book;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\TelegramActions;

class SendBook extends RowAction
{
    public $name = 'send';

    public function handle(Model $model)
    {
        // $model ...
        if (TelegramActions::sendBook($model->id, '-1001373421300')) {
            return $this->response()->success('Success message.')->refresh();
        } else {
            return $this->response()->error('Errors')->refresh();
        }
    }
}
