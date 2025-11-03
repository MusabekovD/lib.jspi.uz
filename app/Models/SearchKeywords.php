<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchKeywords extends Model
{
    protected $table = 'searchkeys';
    protected $fillable = ['keyword'];
}
