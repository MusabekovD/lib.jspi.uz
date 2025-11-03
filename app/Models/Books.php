<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LikeBooks;
use EloquentFilter\Filterable;

class Books extends Model
{
    use Filterable;
    protected $table = 'books';

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\BooksFilter::class);
    }



    public static function langs()
    {
        return [
            "O'zbekcha",
            "Ruscha",
            "Inglizcha",
        ];
    }

    public static function reads()
    {
        return [
            "Lotin",
            "Kril",
        ];
    }

    public function read_lang()
    {
        $langs = [
            "Lotin",
            "Kril",
        ];
        return $langs[$this->b_read_lang];
    }

    public function likebooks()
    {
        return $this->hasMany(LikeBooks::class, 'books_id');
    }

    public function Muallif()
    {
        return $this->hasOne('App\Models\Authors', 'id', 'author');
    }
    public function Category()
    {
        return $this->hasOne('App\Models\CategoriesBooks', 'id', 'category_id');
    }

    public function getImage()
    {
        return "https://lib.jdpu.uz/storage/uploads/" . $this->img;
    }

    public function getFile()
    {
        return "https://lib.jdpu.uz/storage/uploads/" . $this->file_path;
    }

    public function Publishing()
    {
        return $this->hasOne('App\Models\Publishing', 'id', 'b_publishing');
    }
    public function Lang()
    {
        return $this->hasOne('App\Models\Langs', 'id', 'b_lang');
    }

    public function User()
    {
        return $this->hasOne('App\Models\AdminUsers', 'id', 'user_id');
    }
}