<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable =['title','level','price','user_id','category_id','image','description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapitre::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'course_tags');
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class, 'course_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
