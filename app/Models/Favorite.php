<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
    ];

    /**
     * Obtenir l'utilisateur qui a ajouté ce cours en favori
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtenir le cours qui a été ajouté en favori
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
