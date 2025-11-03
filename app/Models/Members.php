<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    protected $table = 'members';
    protected $fillable = ['full_name', 'description', 'tell', 'adress', 'status', 'telegram_id'];
}
