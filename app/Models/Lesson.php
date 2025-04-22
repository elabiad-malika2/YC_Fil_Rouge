<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'title',
        'type',
        'text_content',
        'video_path',
        'chapitres_id',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapitre::class, 'chapitres_id');
    }
}
