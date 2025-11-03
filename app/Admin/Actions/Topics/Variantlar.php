<?php

namespace App\Admin\Actions\Topics;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\TelegramActions;

class Variantlar extends RowAction
{
    public $name = 'Variatlarni tahrirlash';


    // public function handle(Model $model)
    // {
    //     // $model ...
    //     $d = TelegramActions::sendTests($model->id);
    //     if ($d)
    //         return $this->response()->success('Success message.')->refresh();
    //     else
    //         return $this->response()->error('Error message.')->refresh();
    // }
    public function href()
    {
        return "/admin/topics/questions/variantlar/" . $this->getKey();
    }
}
