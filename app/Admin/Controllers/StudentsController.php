<?php

namespace App\Admin\Controllers;

use App\Students;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Extensions\StudentsExporter;
use App\Admin\Actions\Stuidents\BatchSendMessage;

class StudentsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Nazoratchilar';

    /**
     * Make a grid builder.
     * 
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Students());
        //$grid->exporter(new StudentsExporter());

        //filter
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();

            $filter->like('fio', 'F.I.O');
            $filter->like('work', 'Ish joyi');
        });
        $grid->batchActions(function ($batch) {
            $batch->add(new BatchSendMessage());
        });
        $grid->model()->orderBy('created_at', 'desc');
        $grid->column('id', __('Id'));
        $grid->column('fio', __('Fio'));
        $grid->column('telegram_user_id', __('Telegram user id'));
        $grid->column('tell', __('Tell'));
        $grid->column('adress', __('Adress'));

        $grid->column('work', __('Work'));
        $grid->column('sts', __('Sts'));
        $grid->column('olduser', __('2019/2020'))->display(function ($olduser) {
            return $olduser == 1 ? "Xa" : "Yo'q";
        });
        $grid->column('created_at', __('Created at'))->display(function ($created_at) {
            return date('Y-m-d H:i:s', strtotime($created_at));
        });
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Students::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('fio', __('Fio'));
        $show->field('telegram_user_id', __('Telegram user id'));
        $show->field('tell', __('Tell'));
        $show->field('work', __('Work'));
        $show->field('adress', __('Adress'));
        $show->field('olduser', __('2019/2020'));
        $show->field('sts', __('Sts'));
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
        $form = new Form(new Students());

        $form->text('fio', __('Fio'));
        $form->number('telegram_user_id', __('Telegram user id'));
        $form->text('tell', __('Tell'));
        $form->text('work', __('Work'));
        $form->text('adress', __('Adress'));
        $form->switch('sts', __('Sts'));
        $form->switch('olduser', __('2019/2020'));

        return $form;
    }
}
