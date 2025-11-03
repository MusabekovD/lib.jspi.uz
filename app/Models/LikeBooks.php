<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeBooks extends Model
{
    //like_books
    protected $table = 'like_books';
    protected $fillable = ['books_id', 'members_id'];


    public function book()
    {
        return $this->hasOne('App\Models\Books', 'id', 'books_id');
    }
}
