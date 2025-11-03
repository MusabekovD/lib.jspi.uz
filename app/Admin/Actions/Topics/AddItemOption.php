<?php

namespace App\Admin\Actions\Topics;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Actions\Action;
use App\Questions;
use App\QuestionsOptions;
use Encore\Admin\Form;
use Illuminate\Http\Request;

class AddItemOption extends RowAction
{
    public $name = 'Variant qo`shish';

    public function handle(Model $model,  Request $request)
    {

        // $model ...
        $questionOption = new QuestionsOptions();
        $questionOption->question_id = $model->id;
        $questionOption->option = $request->input('option');
        $questionOption->correct = $request->input('correct');
        if ($questionOption->save())
            return $this->response()->success('Muvoffaqiyatli.')->refresh();
        else
            return $this->response()->error('Xatolik.')->refresh();
    }

    public function form()
    {
        $this->textarea('option', "Variant")->required();

        $this->radio('correct', "To`g`ri javob")->options([0 => "Noto'g'ri", 1 => "To'g'ri"]);
    }
}
