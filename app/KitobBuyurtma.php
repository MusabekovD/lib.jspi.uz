<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KitobBuyurtma extends Model
{
    protected $fillable = [
        'fio',
        'kitobnomi',
        'muallif',
        'nashryili',
        'tell',
    ];
}