<?php

namespace App\Admin\Controllers;

use App\Models\Direction;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
class DirectionsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $title = 'Direction';

    protected function grid()
    {
        $grid = new Grid(new Direction());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __("Yo'nalish nomi"));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Direction::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __("Yo'nalish nomi"));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Direction());

        $form->textarea('name', __("Yo'nalish nomi"))->rules('required');

        return $form;
    }

}
