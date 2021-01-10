<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'path',
        'file_name'
        ];

    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }
}
