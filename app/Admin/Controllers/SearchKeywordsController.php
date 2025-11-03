<?php

namespace App\Admin\Controllers;

use App\Models\SearchKeywords;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SearchKeywordsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\SearchKeywords';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SearchKeywords());

        $grid->column('id', __('Id'));
        $grid->column('keyword', __('Kalit so\z'));
        $grid->column('count_using', __('Soni'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->model()->orderBy('updated_at', 'desc');
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
        $show = new Show(SearchKeywords::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('keyword', __('Keyword'));
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
        $form = new Form(new SearchKeywords());

        $form->text('keyword', __('Keyword'));

        return $form;
    }
}
