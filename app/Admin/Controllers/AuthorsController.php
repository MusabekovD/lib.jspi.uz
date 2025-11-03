<?php

namespace App\Admin\Controllers;

use App\Models\Authors;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AuthorsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Mualliflar';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Authors());

        $grid->column('id', __('Id'));
        $grid->column('name', __('F.I.O'));
        $grid->column('birthday', __('Tu\'ulgan yili'));
        $grid->column('desc', __('Haqida'));
        $grid->column('img', __('Rasmi'))->image('/storage/uploads/', 100, 100);
        $grid->column('created_at', __('Yaratilgan'));

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
        $show = new Show(Authors::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('F.I.O'));
        $show->field('desc', __('Haqida'));
        $show->field('img', __('Rasm'));
        $show->field('created_at', __('Created at'));        

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Authors());

        $form->text('name', __('F.I.O'));
        $form->date('birthday', __('Tug\'ulgan kuni'))->format('YYYY-MM-DD')->default(date('Y-m-d'));

        $form->text('desc', __('Haqida'));
        $form->image('img', __('Rasm'));

        return $form;
    }
}
