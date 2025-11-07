<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function sciences()
    {
        return $this->belongsToMany(Science::class, 'direction_science', 'direction_id', 'science_id');
    }
}
