<?php

namespace App\Admin\Actions\Topics;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\MyTests;

class ViewAnswers extends RowAction
{
    public $name = 'Javoblarni ko`rish';

    // public function handle(Model $model)
    // {
    //     // $model ...

    //     return $this->response()->success('Success message.')->refresh();
    // }

    public function href()
    {
        $MyTests = MyTests::find($this->getKey());
        return "/test/results/" . $MyTests->user_id . "/" . $this->getKey();
    }
}
