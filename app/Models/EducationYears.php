<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationYears extends Model
{
    use HasFactory;
    protected $table = 'education_years';

    protected $fillable = ['code', 'name'];
}
