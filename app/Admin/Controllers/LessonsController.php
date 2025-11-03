<?php

namespace App\Admin\Controllers;

use App\HistoryViews;
use App\Lessons;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Lessons\SendTelegram;
use App\Admin\Actions\Lessons\ViewHistory;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\Log;

use Encore\Admin\Widgets\Box;
use Illuminate\Support\Facades\DB;

class LessonsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Topshiriqlar';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Lessons());

        $grid->actions(function ($actions) {
            $actions->add(new SendTelegram);
            $actions->add(new ViewHistory);
        });
        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('s_path', __('S path'));
        $grid->column('s_type', __('S type'));
        $grid->column('telegram_post_id', __('Telegram post id'));
        $grid->column('chat_id', __('Chat id'));
        $grid->column('mimeType', __('MimeType'));
        $grid->column('created_at', 'Sana va vaqt')->display(function ($created) {
            return date('Y-m-d H:i:s', strtotime($created));
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
        $show = new Show(Lessons::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('s_path', __('S path'));
        $show->field('s_type', __('S type'));
        $show->field('telegram_post_id', __('Telegram post id'));
        $show->field('chat_id', __('Chat id'));
        $show->field('mimeType', __('MimeType'));
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
        $form = new Form(new Lessons());

        $form->text('title', __('Title'));
        $form->textarea('description', __('Description'));
        $form->file('s_path', __('S path'));
        $form->select('s_type', __('S type'))->options(Lessons::types());

        $form->number('telegram_post_id', __('Telegram post id'));
        $form->text('chat_id', __('Chat id'));
        $form->text('mimeType', __('MimeType'));
        $form->deleted(function ($data) {
            return response()->json([
                'status' => false,
                'message' => json_encode($data),
            ]);
        });

        return $form;
    }

    public function results($id)
    {
        $grid = new Grid(new HistoryViews());
        $grid->model()->where('lession_id', '=', $id);
        $grid->model()->orderBy('created_at', 'desc');

        //filter
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();

            $filter->like('student.fio', 'F.I.O');
            $filter->like('student.work', 'Ish joyi');
        });

        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableView()
                ->disableEdit()
                ->disableDelete();
            //$actions->add(new deleteResult);
        });
        $grid->column('id', __('Id'));
        $grid->column('student.fio', 'F.I.O');
        $grid->column('student.work', 'Ish joyi');
        $grid->column('created_at', 'Sana va vaqt')->display(function ($created) {
            return date('Y-m-d H:i:s', strtotime($created));
        });

        $grid->header(function ($query) {
            $accepted = $query->count();
            $studentsCount = DB::table('students')->count();
            $acepted = view('admin.accepted', compact('studentsCount', 'accepted'));


            return new Box("Ro'yxatdan o'tgan foydalanuvchilarga nispatan ", $acepted);
        });


        $content = new Content();
        $content->header("Qabul qilingan foydalanuvchilar");
        $content->body($grid);



        return $content;
    }

    public function history()
    {
        $content = new Content();
        $content->header('View');
        $content->description('Description...');
        $content->body(view('admin.history'));
        return $content;
    }
}
