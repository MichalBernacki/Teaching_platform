<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonTime extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('presence', 'pluses');
    }

    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }
}
