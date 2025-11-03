<?php

namespace App\Admin\Controllers;

use App\KitobBuyurtma;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BuyurtmaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\KitobBuyurtma';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new KitobBuyurtma());

        $grid->column('id', __('Id'));
        $grid->column('fio', __('Fio'));
        $grid->column('tell', __('tell'));
        $grid->column('kitobnomi', __('Kitobnomi'));
        $grid->column('muallif', __('Muallif'));
        $grid->column('nashryili', __('Nashryili'));
        $grid->column('status', __('Status'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->model()->orderBy('id', 'desc');

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
        $show = new Show(KitobBuyurtma::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('fio', __('Fio'));
        $show->field('kitobnomi', __('Kitobnomi'));
        $show->field('muallif', __('Muallif'));
        $show->field('nashryili', __('Nashryili'));
        $show->field('status', __('Status'));
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
        $form = new Form(new KitobBuyurtma());

        $form->text('fio', __('Fio'));
        $form->text('tell', __('Tell'));
        $form->text('kitobnomi', __('Kitobnomi'));
        $form->text('muallif', __('Muallif'));
        $form->text('nashryili', __('Nashryili'));
        $form->switch('status', __('Status'));

        return $form;
    }
}