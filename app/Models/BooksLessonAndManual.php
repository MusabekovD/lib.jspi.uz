<?php

namespace App\Models;

use App\Models\LikeBooks;
use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class BooksLessonAndManual extends Model
{
    use Filterable;

    protected $table = 'books_lesson_and_manual';

    protected $casts = [
        'course' => 'array',
        'department' => 'array',
    ];

//    public static function whereJsonContains(string $string, int $param)
//    {
//    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (is_array($model->course)) {
                $model->course = json_encode($model->course);
            }
        });
        static::saving(function ($model) {
            if (is_array($model->department)) {
                $model->department = json_encode($model->department);
            }
        });
    }

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\BooksFilter::class);
    }

    public function bookCourses()
    {
        return $this->hasMany(BookCourses::class, 'book_id');
    }

    public function bookDepartments()
    {
        return $this->hasMany(BookDepartments::class, 'book_id');
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
