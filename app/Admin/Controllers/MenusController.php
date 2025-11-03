<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menus;
use Encore\Admin\Form;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Tree;

class MenusController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Tuzilma');

            $content->body(Menus::tree(function (Tree $tree) {
                $tree->branch(function ($branch) {
                    return "{$branch['title']}";
                });
            }));
        });
    }
    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Bo`limni tahrirlash');


            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->breadcrumb(
                ['text' => 'Tuzilma', 'url' => '/departments'],
                ['text' => 'Yaratish']

            );
            $content->header('Yangi bo`lim yaratish');
            $content->description('Institut tuzilmasi');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function tree()
    {
        return Menus::tree(function (Tree $tree) {
            $tree->branch(function ($branch) {
                return "{$branch['title']}";
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Menus::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('title', 'Nomi')->rules('required|max:255');
            $form->text('link', 'link')->rules('required');
            $form->text('settings', 'settings');
            $form->number('order', 'Navbat')->default(1);
            $form->select('parent_id', 'Voris')->options(Menus::selectOptions());
            $states = [
                'on' => ['value' => '1', 'text' => 'Faol', 'color' => 'primary'],
                'off' => ['value' => '0', 'text' => 'Passiv', 'color' => 'default'],
            ];
            $form->switch('status', 'Holat')->default(1)->states($states);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
