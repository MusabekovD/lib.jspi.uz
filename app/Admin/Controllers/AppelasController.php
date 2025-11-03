<?php

namespace App\Admin\Controllers;

use App\Models\Appeals;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\DB;
use App\Admin\Actions\Appeals\Javob;

class AppelasController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Murojaatlar';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Appeals());
        $grid->model()->orderBy('created_at', 'desc');

        $grid->column('id', __('Id'));
        $grid->column('student_id', __('F.I.O'))->display(function ($data) {
            $members = DB::table('members')->where('telegram_id', $this->student_id)->first();

            return !empty($members) ? $members->full_name : $this->student_id;
        });
        $grid->column('message_id', __('Xabar ID'));
        $grid->column('message', __('Xabar'));
        $grid->column('created_at', __('Yaratilgan vaqt'));
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
        $show = new Show(Appeals::findOrFail($id));

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
        $form = new Form(new Appeals());

        $form->number('student_id', __('Student id'));
        $form->number('message_id', __('Message id'));
        $form->number('chat_id', __('Chat id'));
        $form->text('message', __('Message'));

        return $form;
    }

    /**
     * Display a custom report.
     *
     * @param Content $content
     * @return Content
     */
    public function customReport(Content $content)
    {
        $results = DB::table('books')
            ->select(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y') as date_appointment"), DB::raw('COUNT(*) as soni'))
            ->whereBetween('created_at', [DB::raw('DATE_SUB(NOW(), INTERVAL 15 DAY)'), DB::raw('NOW()')])
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"), 'DESC')
            ->get();

        return $content
            ->title('Custom Report')
            ->description('Books Report')
            ->body(view('admin.custom_report', compact('results')));
    }
}
