<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appeals extends Model
{
    protected $table = 'appeals';
    protected $fillable = ['student_id', 'message_id', 'chat_id', 'message'];
}
