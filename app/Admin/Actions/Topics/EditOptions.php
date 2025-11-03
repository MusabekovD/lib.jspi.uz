<?php

namespace App\Admin\Actions\Topics;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class EditOptions extends RowAction
{
    public $name = 'Tahrirlash';

    public function handle(Model $model,  Request $request)
    {
        $model->correct = $request->get('correct');
        $model->option = $request->get('option');
        if ($model->save())
            return $this->response()->success("Muvoffaqiyatli tahrirlandi!")->refresh();
        else
            return $this->response()->error("Tahrirlashda xatolik")->refresh();
    }

    public function form(Model $model)
    {

        $this->textarea('option', "Variant")->default($model->option);
        $this->radio('correct', "To`g`ri javob")->options([0 => "Noto'g'ri", 1 => "To'g'ri"])->default($model->correct);
    }
}
