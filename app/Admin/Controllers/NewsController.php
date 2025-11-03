<?php

namespace App\Admin\Controllers;

use App\Models\News;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class NewsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Yangiliklar';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new News());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Sarlovha'));
        // $grid->column('short_content', __('Short content'));
        // $grid->column('content', __('Content'));
        $grid->column('slug', __('Slug'));
        // $grid->column('thumb_img', __('Thumb img'));
        $grid->column('pubdate', __(' pubdate'));
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
        $show = new Show(News::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('short_content', __('Short content'));
        $show->field('content', __('Content'));
        $show->field('slug', __('Slug'));
        $show->field('thumb_img', __('Thumb img'));
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
        $form = new Form(new News());

        $form->text('title', __('Sarlovha'));
        $form->textarea('short_content', __('Qisqacha ma`zmuni'));
        $form->tinymce('content', __('Ma`zmun'));
        $form->text('slug', __('Slug'));
        $form->datetime('pubdate', __('pubdate'))->format('YYYY-MM-DD HH:mm:ss');

        $form->image('thumb_img', __('Yangilik asosiy rasmi'));

        return $form;
    }
}