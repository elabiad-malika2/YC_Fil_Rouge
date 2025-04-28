<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz_result extends Model
{
    protected $fillable = ['student_id', 'quiz_id', 'score', 'total_points', 'status', 'completed_at'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
