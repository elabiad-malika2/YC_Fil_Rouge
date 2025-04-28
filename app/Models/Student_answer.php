<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_answer extends Model
{
    protected $fillable = ['student_id', 'answer_id', 'is_correct'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
