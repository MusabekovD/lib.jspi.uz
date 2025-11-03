<?php

namespace App\Admin\Actions\Topics;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class QuestionEdit extends RowAction
{
    public $name = 'Tahrirlash';

    public function handle(Model $model,  Request $request)
    {
        $model->question_text = $request->get('question_text');
        if ($model->save())
            return $this->response()->success("Muvoffaqiyatli tahrirlandi!")->refresh();
        else
            return $this->response()->error("Tahrirlashda xatolik")->refresh();
    }

    public function form(Model $model)
    {
        $this->textarea('question_text', 'reason')->value($model->question_text);
    }
}
