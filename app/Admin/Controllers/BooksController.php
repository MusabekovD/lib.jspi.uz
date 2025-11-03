<?php

namespace App\Admin\Controllers;

use App\Models\Authors;
use App\Models\Books;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\CategoriesBooks;
use App\Models\Langs;
use App\Models\Publishing;
use App\Admin\Actions\Book\SendBook;

class BooksController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Kitoblar bazasi';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Books());
        $grid->actions(function ($actions) {
            $actions->add(new SendBook);
        });
        $grid->column('id', __('Id'));
        $grid->column('title', __('Nomi'));
        // $grid->column('isbn', __('Isbn'));
        $grid->column('author', __('Muallif'))->display(function ($model) {
            return $this->muallif->name;
        });
        $grid->column('img', __('Muqova'))->image('/storage/uploads/', 100, 100);
        // $grid->column('b_size', __('B size'));
        // $grid->column('b_page_count', __('B page count'));
        $grid->column('category_id', __('Kategoriya'))->display(function ($model) {
            return $this->category->name;
        });
        $grid->column('user_id', __('Foydalanuvchi'))->display(function ($model) {
            return $this->user->name;
        });
        $grid->column('b_lang', __('Til'))->display(function ($model) {
            return $this->lang->name;
        });
        // $grid->column('b_read_lang', __('B read lang'));
        $grid->column('b_published_year', __('Chop etilgan'));
        $grid->column('b_publishing', __('Nashiryot'))->display(function ($model) {
            return $this->publishing->name;
        });
        $grid->column('file_path', __('File'))->downloadable();
        // $grid->column('telegram_msg_id', __('Telegram msg id'));
        $grid->column('view_count', __('soni'));
        $grid->column('created_at', __('vaqti'))->date('Y-m-d H:i:s');
        // $grid->column('updated_at', __('Updated at'));
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
        $show = new Show(Books::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('isbn', __('Isbn'));
        $show->field('author', __('Author'));
        $show->field('img', __('Img'));
        $show->field('b_size', __('B size'));
        $show->field('b_page_count', __('B page count'));
        $show->field('category_id', __('Category id'));
        $show->field('user_id', __('User id'));
        $show->field('b_lang', __('B lang'));
        $show->field('b_read_lang', __('B read lang'));
        $show->field('b_published_year', __('B published year'));
        $show->field('b_publishing', __('B publishing'));
        $show->field('file_path', __('File path'));
        $show->field('telegram_msg_id', __('Telegram msg id'));
        $show->field('view_count', __('View count'));
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
        $form = new Form(new Books());
        $form->column(1 / 2, function ($form) {
            $form->text('title', __('Nomi'))->required();
            $form->select('author', 'Muallif')->options(function ($id) {
                $Authors = Authors::find($id);

                if ($Authors) {
                    return [$Authors->id => $Authors->name];
                }
            })->ajax('/admin/api/authors')->required();
            $form->select('category_id', __('Kategoriya'))->options(CategoriesBooks::where('sts', 1)->pluck('name', 'id'))->required();

            $form->select('b_publishing', 'Nashiryot')->options(function ($id) {
                $publishings = Publishing::find($id);

                if ($publishings) {
                    return [$publishings->id => $publishings->name];
                }
            })->ajax('/admin/api/publishings')->required();

            $form->image('img', __('Muqova'))->thumbnail('small', $width = 300, $height = 420)->required();
            $form->select('b_lang', __('Til'))->options(Langs::all()->pluck('name', 'id'))->required();
            $form->select('b_read_lang', __('Yozuv'))->options(Books::reads())->required();
            $form->file('file_path', __('File'))->required();
            $form->textarea('desc', __('Anatatsiya'))->rows(10)->required();
        });
        $form->column(1 / 2, function ($form) {
            $form->text('isbn', __('Isbn'));

            $form->text('b_size', __('Hajmi'));
            $form->number('b_page_count', __('Sahifalar soni'));

            $form->number('user_id', __('User id'))->default(1)->required();

            $form->date('b_published_year', __('Nashr yili'))->format('YYYY')->default(date('Y'));
            $form->text('telegram_msg_id', __('TELEGRAM ID'));
            $form->number('view_count', __('Ko\'rishlar soni'));
        });


        return $form;
    }
}