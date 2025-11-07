<?php

namespace App\Admin\Controllers;

use App\Helpers\ApiHelper;
use App\Models\Department;
use App\Models\Direction;
use App\Models\Science;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ScienceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Science';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Science());

        $grid->model()->orderBy('created_at', 'desc');

        $grid->column('id', __('Id'));
        $grid->column('name', __('Fan'));
        $grid->column('department_id', __('Kafedra'))->display(function ($departmentId) {
            $department = Department::find($departmentId);
            return $department ? $department->name : null;
        });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        // course ustuni JSON yoki vergul bilan ajratilgan bo'lishi mumkin, har ikkisini to'g'ri ko'rsatamiz
        $grid->column('course', 'Kurslar')->display(function ($courses) {
            if (is_array($courses)) {
                return implode(', ', $courses);
            }
            if (is_string($courses) && $courses !== '') {
                // JSON bo'lsa
                $decoded = json_decode($courses, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    return implode(', ', $decoded);
                }
                // oddiy "1-kurs,2-kurs" ko'rinishida bo'lsa
                return $courses;
            }
            return '';
        });

        $grid->column('direction_id', __('Direction'))->display(function ($directionId) {
            $direction = Direction::find($directionId);
            return $direction ? $direction->name : null;
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
        $show = new Show(Science::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
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
        $departments = Department::pluck('name', 'id');
        $directions = Direction::pluck('name', 'id');
        $form = new Form(new Science());

        $form->select('department_id', 'Kafedra')
            ->options($departments)
            ->required();

        $form->multipleSelect('directions', "Yo'nalishlar")
            ->options($directions)
            ->required();
        $form->textarea('name', __('Fan nomi'))->required();

        $form->checkbox('course', 'Kurslar')->options([
            '1-kurs' => '1 - kurs',
            '2-kurs' => '2 - kurs',
            '3-kurs' => '3 - kurs',
            '4-kurs' => '4 - kurs',
            '5-kurs' => '5 - kurs',
            '6-kurs' => '6 - kurs',
        ]);

        return $form;
    }
}
