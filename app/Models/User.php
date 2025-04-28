<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'image','is_active'
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class, 'user_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Obtenir les cours favoris de l'utilisateur
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

   // Obtenir les cours favoris de l'utilisateur avec les détails des cours
    
    public function favoriteCourses()
    {
        return $this->belongsToMany(Course::class, 'favorites')
            ->withTimestamps();
    }

   // Vérifier si un cours est en favori pour l'utilisateur

    public function hasFavorited(Course $course)
    {
        return $this->favorites()->where('course_id', $course->id)->exists();
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'teacher_id');
    }

    public function studentAnswers()
    {
        return $this->hasMany(Student_answer::class, 'student_id');
    }

    public function quizResults()
    {
        return $this->hasMany(Quiz_result::class, 'student_id');
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }
}
