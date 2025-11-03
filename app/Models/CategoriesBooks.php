<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Books;

class CategoriesBooks extends Model
{
    protected $table = 'category_books';
    protected $fillable = ['name', 'sts'];

    public function books()
    {
        return $this->hasMany(Books::class, 'category_id');
    }
}
