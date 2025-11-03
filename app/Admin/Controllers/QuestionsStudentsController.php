<?php

namespace App\Admin\Controllers;

use App\SavolStudents;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\QuestionsStudents\Javob;

class QuestionsStudentsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\SavolStudents';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SavolStudents());
        $grid->model()->orderBy('created_at', 'desc');
        $grid->column('id', __('Id'));
        $grid->column('student_id', __('Student id'))->display(function ($studentId) {
            $student = \App\Students::where('telegram_user_id', $studentId)->first();
            return !empty($student) ? $student->fio : $studentId;
        });

        // $grid->column('chat_id', __('Chat id'));
        $grid->column('message', __('Message'));
        $grid->column('created_at', 'Sana va vaqt')->display(function ($created) {
            return date('Y-m-d H:i:s', strtotime($created));
        });
        $grid->actions(function ($actions) {
            $actions->add(new Javob);
        });

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
        $show = new Show(SavolStudents::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('student_id', __('Student id'));
        $show->field('message_id', __('Message id'));
        $show->field('chat_id', __('Chat id'));
        $show->field('message', __('Message'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SavolStudents());

        $form->number('student_id', __('Student id'));
        $form->number('message_id', __('Message id'));
        $form->number('chat_id', __('Chat id'));
        $form->text('message', __('Message'));

        return $form;
    }
}
