<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('confirmed', 'mark');
    }

    public function lecturer(){
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

}
