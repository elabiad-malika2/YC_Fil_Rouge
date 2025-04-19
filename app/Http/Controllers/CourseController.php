<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Chapitre;
use App\Models\Lesson;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function store(CourseRequest $request)
    {
        // Création du cours
        // dd($request);
        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->file('image')->store('courses/images', 'public'),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'level' => $request->level,
            'user_id' => Auth::id(),
        ]);

        // Attacher les tags
        if ($request->has('tags')) {
            $course->tags()->attach($request->tags);
        }

        // Création des chapitres et leçons
        foreach ($request->chapitres as $chapitreData) {
            $chapitre = Chapitre::create([
                'title' => $chapitreData['title'],
                'description' => $chapitreData['description'] ?? null,
                'course_id' => $course->id,
            ]);

            foreach ($chapitreData['lessons'] as $lessonData) {
                $lesson = new Lesson([
                    'title' => $lessonData['title'],
                    'type' => $lessonData['type'],
                    'text_content' => $lessonData['type'] === 'text' ? $lessonData['text_content'] : null,
                    'video_path' => $lessonData['type'] === 'video' ? 
                        $lessonData['video']->store('courses/videos', 'public') : null,
                ]);

                $chapitre->lessons()->save($lesson);
            }
        }

        return redirect()->route('enseignant.dashboard')
            ->with('success', 'Cours créé avec succès !');
    }

    public function test(){
        dd('fffffffffff');
    }
}
