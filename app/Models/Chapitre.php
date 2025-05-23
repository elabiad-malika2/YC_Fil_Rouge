<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapitre extends Model
{
    protected $fillable = [
        'title',
        'description',
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'chapitres_id');    }
}
