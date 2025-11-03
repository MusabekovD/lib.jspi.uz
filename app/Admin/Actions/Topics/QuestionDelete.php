<?php

namespace App\Admin\Actions\Topics;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class QuestionDelete extends RowAction
{
    public $name = 'O`chirish';

    public function handle(Model $model)
    {
        if ($model->delete())
            return $this->response()->success("Muvoffaqiyatli o'chirildi!")->refresh();
        else
            return $this->response()->error("O'chirishda xatolik")->refresh();
    }

    public function dialog()
    {
        $this->confirm("Rostan ham o'chrishni hohlaysizmi? Bu tizim xatoliklarini keltirib chiqarishi mumkin qachon bu test foydalanuvchilar tamonidan ishlangan bo'lsa");
    }
}
