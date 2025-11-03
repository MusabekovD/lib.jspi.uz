<?php

namespace App\Admin\Actions\Topics;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class ShowResults extends RowAction
{
    public $name = 'Natijalar';

    public function href()
    {
        return '/admin/topics/results/' . $this->getKey();
    }
}
