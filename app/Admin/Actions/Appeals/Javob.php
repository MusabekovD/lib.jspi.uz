<?php

namespace App\Admin\Actions\Appeals;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\TelegramActions;
use Illuminate\Http\Request;

class Javob extends RowAction
{
    public $name = 'Javob yuborish';

    public function handle(Model $model,  Request $request)
    {

        // $model ...
        $msg = '*' . $model->message_id . ' raqamli savolingizga javob:*
' . $request->get('response');
        TelegramActions::sendMessage($model->chat_id, $msg);
        return $this->response()->success('Success message.')->refresh();
    }

    public function form()
    {
        $this->textarea('response', 'reason')->rules('required');
    }
}
