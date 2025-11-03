<?php

namespace App\Admin\Controllers;

use App\Questions;
use App\QuestionsOptions;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;


class QuestionsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Questions';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Questions());

        $grid->column('id', __('Id'));
        $grid->column('topic_id', __('Topic id'));
        $grid->column('question_text', __('Question text'));
        $grid->column('answer_explanation', __('Answer explanation'));
        $grid->column('more_info_link', __('More info link'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Questions::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('topic_id', __('Topic id'));
        $show->field('question_text', __('Question text'));
        $show->field('answer_explanation', __('Answer explanation'));
        $show->field('more_info_link', __('More info link'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }
    public function storedata(Request $request)
    {
        // $answers =  $request->input('question_options');

        // foreach ($answers as $answer_item) {
        //     dump($answer_item);
        // }
        // return;
        $question = new Questions();
        $question->topic_id = $request->input('topic_id');
        $question->question_text = $request->input('question_text');
        $question->answer_explanation = $request->input('answer_explanation');
        $question->more_info_link = $request->input('more_info_link');
        if ($question->save()) {
            $answers =  $request->input('question_options');
            foreach ($answers as $answer_item) {
                $questionOption = new QuestionsOptions();
                $questionOption->question_id = $question->id;
                $questionOption->option = $answer_item['option'];
                $questionOption->correct = $answer_item['correct'] == "on" ? 1 : 0;
                $questionOption->save();
            }
            admin_toastr('Added success');
            return redirect('/admin/questions');
            //return response()->success('Success message.')->refresh();
        }
        return response()->error('Errors')->refresh();
    }



    public function add($id)
    {

        $form = new Form(new Questions());
        $form->setAction(admin_base_path('questions/storedata'));
        // $form->action(admin_base_path('questions/storedata'));
        // $form->hidden('_token')->default(csrf_token());
        $form->hidden('topic_id')->default($id);

        $form->textarea('question_text', __('Question text'))->required();
        $form->textarea('answer_explanation', __('Answer explanation'));
        $form->text('more_info_link', __('More info link'));
        $form->table('question_options', function ($table) {
            $table->textarea('option', "Javob")->required();
            $states = [
                '1'  => ['value' => 1, 'text' => "Rost", 'color' => 'success'],
                '0' => ['value' => 0, 'text' => "yolg`on", 'color' => 'danger'],
            ];

            $table->switch('correct', "To`g`ri javob")->states($states);
        });
        $content = new Content();
        $content->header("Savol qo'shish");
        $content->body($form);
        return $content;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Questions());

        $form->number('topic_id', __('Topic id'));
        $form->textarea('question_text', __('Question text'));
        $form->textarea('answer_explanation', __('Answer explanation'));
        $form->text('more_info_link', __('More info link'));

        return $form;
    }
}
