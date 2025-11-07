<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Science extends Model
{
    use HasFactory;

    protected $table = 'science';

    protected $fillable = ['department_id', 'name', 'course'];
    protected $casts = [
        'course' => 'array',
    ];


    public function books()
    {
        return $this->hasMany(BooksLessonAndManual::class, 'lib_subject', 'id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function directions()
    {
        return $this->belongsToMany(Direction::class, 'direction_science', 'science_id', 'direction_id');
    }
}
