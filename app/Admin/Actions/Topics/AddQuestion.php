<?php

namespace App\Admin\Actions\Topics;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class AddQuestion extends RowAction
{
    public $name = 'Savol qo`shish';

    // public function handle(Model $model)
    // {
    //     // $model ...

    //     return $this->response()->success('Success message.')->refresh();
    // }

    public function href()
    {
        return "/admin/questions/create/" . $this->getKey();
    }
}
