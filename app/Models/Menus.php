<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Nestable\NestableTrait;

class Menus extends Model
{
    use ModelTree, AdminBuilder;


    protected $parent = 'parent_id';
}