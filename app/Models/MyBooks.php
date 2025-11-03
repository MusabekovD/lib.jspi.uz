<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Books;

class MyBooks extends Model
{
    protected $table = 'my_books';
    protected $fillable = ['books_id', 'members_id'];

    public function book()
    {
        return $this->hasOne('App\Models\Books', 'id', 'books_id');
    }
}
