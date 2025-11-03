<?php

namespace App\Admin\Actions\Topics;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Questions extends RowAction
{
    public $name = 'Savollar';

    public function href()
    {
        return '/admin/topics/questions/' . $this->getKey();
    }
}
