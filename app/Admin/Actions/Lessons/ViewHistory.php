<?php

namespace App\Admin\Actions\Lessons;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class ViewHistory extends RowAction
{
    public $name = 'Qabul qilganlar';

    // public function handle(Model $model)
    // {
    //     // $model ...

    //     return $this->response()->success('Success message.')->refresh();
    // }
    /**
     * @return string
     */
    public function href()
    {
        return '/admin/lessons/viewhistory/' . $this->getKey();
    }
}
