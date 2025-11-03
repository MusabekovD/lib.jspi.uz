<?php

namespace App\Admin\Actions\Topics;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Actions\Action;
use App\Questions;
use App\QuestionsOptions;
use Encore\Admin\Form;
use Illuminate\Http\Request;

class AddItem extends Action
{
    public $name = 'Yangi savol';
    protected $selector = '.add-item';

    protected $topic_id;

    public function __construct($tid = 0)
    {
        $this->topic_id = $tid;

        parent::__construct();
    }

    public function handle(Request $request)
    {
        // $request ...
        $question = new Questions();
        $question->topic_id = $request->input('topic_id');
        $question->question_text = $request->input('question_text');
        $question->answer_explanation = $request->input('answer_explanation');
        $question->more_info_link = $request->input('more_info_link');
        if ($question->save()) {
            return $this->response()->success('Success message.' . $this->topic_id)->refresh();
        }
        // return response()->error('Errors')->refresh();
        return $this->response()->error('Errors...')->refresh();
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default add-item">Yangi savol qo'shish  </a>
HTML;
    }

    public function form()
    {

        $this->hidden('topic_id')->default($this->topic_id);
        $this->textarea('question_text', __('Question text'))->required();
        $this->textarea('answer_explanation', __('Answer explanation'));
        $this->text('more_info_link', __('More info link'));
    }
}
