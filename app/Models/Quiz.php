<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quiz';

    protected $fillable = [
        'user_id',
        'title',
        'level_id',
        'class_id',
        'lesson_id',
        'is_save',
        'length',
        'type',
    ];
}
