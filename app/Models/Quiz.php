<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['title', 'course_id', 'teacher_id', 'status'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function quizResults()
    {
        return $this->hasMany(Quiz_result::class);
    }
}
