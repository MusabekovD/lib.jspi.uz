<?php

namespace App\Admin\Actions\Topics;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class deleteResult extends RowAction
{
    public $name = 'Natijani ochirish';

    public function handle(Model $model)
    {
        if ($model->delete())
            return $this->response()->success('Muvaffaqiyatli.')->refresh();
        else
            return $this->response()->error('Xatolik.')->refresh();
    }

    public function dialog()
    {
        $this->confirm('Siz haqiqatdan natijani o`chirmoqchimisiz?');
    }
}
