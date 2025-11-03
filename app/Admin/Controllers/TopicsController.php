<?php

namespace App\Admin\Controllers;

use App\Topics;
use App\MyTests;
use App\TestAnswers;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Topics\AddQuestion;
use App\Admin\Actions\Topics\Send;
use App\Admin\Actions\Topics\ShowResults;
use App\Admin\Actions\Topics\deleteResult;
use App\Admin\Actions\Topics\Questions;
use App\Admin\Actions\Topics\QuestionEdit;
use App\Admin\Actions\Topics\QuestionDelete;
use App\Admin\Actions\Topics\AddItem;
use App\Admin\Actions\Topics\AddItemOption;
use App\Admin\Actions\Topics\Variantlar;
use App\Admin\Actions\Topics\EditOptions;
use App\Admin\Actions\Topics\ViewAnswers;
use App\Students;
use App\QuestionsOptions;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Table;


class TopicsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Testlar';
    public function send($id)
    {
        // $topic = Topics::find($id);
        // dump($topic);
        //echo "test";
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Topics());
        $grid->actions(function ($actions) {
            $actions->add(new AddQuestion);
            $actions->add(new Send);
            $actions->add(new Questions);
            $actions->add(new ShowResults);
        });
        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('t_time', __('Vaqt'));
        $grid->column('description', __('Description'));
        $grid->column('created_at', 'Sana va vaqt')->display(function ($created) {
            return date('Y-m-d H:i:s', strtotime($created));
        });
        $grid->column('updated_at', __('Updated at'));
        $grid->column('sts', __('Sts'));

        return $grid;
    }

    public function resultTest($id)
    {
        $MyTests = Topics::find($id);
        $grid = new Grid(new MyTests());
        $grid->model()->where('topic_id', '=', $id);
        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableView()
                ->disableEdit()
                ->disableDelete();
            $actions->add(new deleteResult);
            $actions->add(new ViewAnswers);
        });
        $grid->filter(function ($filter) {

            // Remove the default id filter
            $filter->disableIdFilter();

            // Add a column filter
            $filter->like('student.fio', 'F.I.O');
            $filter->like('student.work', 'Ish joyi');
        });
        $grid->column('id', __('Id'));
        $grid->column('student.fio', 'F.I.O');
        $grid->column('student.work', 'Ish joyi');
        $grid->column('created_at', 'Sana va vaqt')->display(function ($created) {
            return date('Y-m-d H:i:s', strtotime($created));
        });
        $grid->column('natija', 'Natija')->display(function ($model) {
            return $this->right_answers;
        });
        $grid->column('question_ids', 'Savollar soni')->display(function ($question_ids) {

            return count(json_decode($question_ids));
        });
        $grid->column('sts', 'Status')->display(function ($sts) {
            return $sts == 0 ? "Active" : "Yakunlangan";
        });

        $content = new Content();
        $content->header("Natijalar - " . $MyTests->title);
        $content->breadcrumb(
            ['text' => 'Bosh sahifa', 'url' => '/'],
            ['text' => 'Testlar', 'url' => '/topics'],
            ['text' => $MyTests->title]
        );
        $content->body($grid);
        return $content;
    }


    //savollar
    public function questions($id)
    {
        $grid = new Grid(new \App\Questions());
        $grid->model()->where('topic_id', '=', $id);
        $grid->disableCreateButton();


        $grid->tools(function (Grid\Tools $tools) use ($id) {
            $tools->append(new AddItem($id));
        });

        $grid->actions(function ($actions) {

            $actions->disableView()
                ->disableEdit()
                ->disableDelete();
            $actions->add(new QuestionEdit);
            $actions->add(new QuestionDelete);
            $actions->add(new AddItemOption);
            $actions->add(new Variantlar);
        });
        $grid->column('id', __('Id'));

        $grid->column('question_text', "Savol")->expand(function ($model) {
            $questionOptions = [];
            foreach ($model->options as $item) {
                $questionOption['id'] = $item->id;
                $questionOption['option'] = $item->option;
                $questionOption['correct'] = $item->correct;
                $questionOptions[] = $questionOption;
            }
            return new Table(['id', 'option', 'correct'], $questionOptions);
            // if (empty($model->options)) {
            //     return new \Encore\Admin\Widgets\Box('Variantlar', "Bironta ham javob kiritilmagan");
            // }
            // $gridExpanded = new Grid(new QuestionsOptions());

            // $gridExpanded->disablePagination();

            // $gridExpanded->disableCreateButton();

            // $gridExpanded->disableFilter();

            // $gridExpanded->disableRowSelector();

            // $gridExpanded->disableColumnSelector();

            // $gridExpanded->disableTools();

            // $gridExpanded->disableExport();


            // $gridExpanded->model()->where('question_id', '=', $model->id);
            // $gridExpanded->column('id', __('Id'));
            // $gridExpanded->column('option', "Variant");
            // return  new \Encore\Admin\Widgets\Box('Variantlar', $gridExpanded->render());
            // return $gridExpanded->render();
        });
        $grid->column('answer_explanation', __('answer_explanation'));

        $content = new Content();
        $content->header("Savollar");
        $content->body($grid);
        return $content;
    }


    //savollar
    public function variantlar($id)
    {
        $ques = \App\Questions::find($id);
        // if (empty($model->options)) {
        //     return new \Encore\Admin\Widgets\Box('Variantlar', "Bironta ham javob kiritilmagan");
        // }
        $gridExpanded = new Grid(new QuestionsOptions());

        $gridExpanded->disablePagination();

        $gridExpanded->disableCreateButton();

        $gridExpanded->disableFilter();

        $gridExpanded->disableRowSelector();

        $gridExpanded->disableColumnSelector();

        $gridExpanded->disableTools();

        $gridExpanded->disableExport();


        $gridExpanded->model()->where('question_id', '=', $id);
        $gridExpanded->column('id', __('Id'));
        $gridExpanded->column('option', "Variant");
        $gridExpanded->column('correct', "To'g'ri javob")->display(function ($dsp) {
            return $dsp == 1 ? "To'g'ri" : "Noto'g'ri";
        });

        $gridExpanded->actions(function ($actions) {
            $actions->disableView()
                ->disableEdit()
                ->disableView();
            $actions->add(new EditOptions);
        });
        // return  new \Encore\Admin\Widgets\Box('Variantlar', $gridExpanded->render());
        // return $gridExpanded->render();


        $content = new Content();
        $content->header($ques->question_text);
        $content->body($gridExpanded);
        return $content;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Topics::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('sts', __('Sts'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Topics());

        $form->text('title', __('Title'));
        $form->textarea('description', __('Description'));
        $form->number('t_time', __('t_time'));
        $form->switch('sts', __('Sts'));

        return $form;
    }
}
