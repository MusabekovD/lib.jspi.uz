<?php

namespace App\Admin\Controllers;

use App\Models\Members;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MembersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Members';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Members());

        $grid->column('id', __('Id'));
        $grid->column('full_name', __('Full name'));
        $grid->column('description', __('Description'));
        $grid->column('tell', __('Tell'));
        $grid->column('adress', __('Adress'));
        $grid->column('status', __('Status'));
        $grid->column('telegram_id', __('Telegram id'));
        $grid->column('created_at', __('Created at'));
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
        $show = new Show(Members::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('full_name', __('Full name'));
        $show->field('description', __('Description'));
        $show->field('tell', __('Tell'));
        $show->field('adress', __('Adress'));
        $show->field('status', __('Status'));
        $show->field('telegram_id', __('Telegram id'));
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
        $form = new Form(new Members());

        $form->text('full_name', __('Full name'));
        $form->text('description', __('Description'));
        $form->text('tell', __('Tell'));
        $form->text('adress', __('Adress'));
        $form->switch('status', __('Status'))->default(1);
        $form->number('telegram_id', __('Telegram id'));

        return $form;
    }
}
