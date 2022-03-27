<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $table = 'lessons';
    protected $fillable = [
        'level_id', 'title'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'lesson_id', 'id');
    }

    public function studies()
    {
        return $this->belongsTo(Studies::class, 'lesson_id', 'id');
    }

    public function level()
    {
        return $this->hasOne(Level::class, 'id', 'level_id');
    }


}
