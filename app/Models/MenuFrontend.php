<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Nestable\NestableTrait;

class MenuFrontend extends Model
{
    use NestableTrait;

    protected $table = 'menuses';
    protected $parent = 'parent_id';
}