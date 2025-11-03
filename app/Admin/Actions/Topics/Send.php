<?php

namespace App\Admin\Actions\Topics;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\TelegramActions;

class Send extends RowAction
{
    public $name = 'Telegramga yuborish';


    public function handle(Model $model)
    {
        // $model ...
        $d = TelegramActions::sendTests($model->id);
        if ($d)
            return $this->response()->success('Success message.')->refresh();
        else
            return $this->response()->error('Error message.')->refresh();
    }
    // public function href()
    // {
    //     return "/admin/topics/send/" . $this->getKey();
    // }
}
