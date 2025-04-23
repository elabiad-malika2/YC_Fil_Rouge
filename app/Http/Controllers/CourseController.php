<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Chapitre;
use App\Models\Lesson;
use App\Http\Requests\CourseRequest;
use App\Models\Categorie;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function show()
    {
        $courses = Course::with(['category', 'tags'])->get();

        return view('welcome', compact('courses'));
    }
    public function store(CourseRequest $request)
    {
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

        if ($request->has('tags')) {
            $course->tags()->attach($request->tags);
        }

        foreach ($request->chapitres as $chapitreData) {
            $chapitre = Chapitre::create([
                'title' => $chapitreData['title'],
                'description' => $chapitreData['description'] ?? null,
                'course_id' => $course->id,
            ]);

            foreach ($chapitreData['lessons'] as $lessonData) {
                $lesson = Lesson::create([
                    'title' => $lessonData['title'],
                    'type' => $lessonData['type'],
                    'chapitres_id' => $chapitre->id,
                    'text_content' => $lessonData['type'] === 'text' ? $lessonData['text_content'] : null,
                    'video_path' => $lessonData['type'] === 'video' ? 
                        $lessonData['video']->store('courses/videos', 'public') : null,
                ]);

            }
        }

        return redirect()->route('enseignant.dashboard')
            ->with('success', 'Cours créé avec succès !');
    }
    public function edit($id)
    {
        $course = Course::with(['chapters.lessons', 'tags'])->findOrFail($id);

        if ($course->user_id !== Auth::id()) {
            abort(403, 'Vous etes pas autorisé à modifier ce cours.');
        }

        $categories = Categorie::all();
        $tags = Tag::all();

        return view('enseignant.editCourse', compact('course', 'categories', 'tags'));
    }
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'level' => 'required|in:debutant,intermediaire,avance,expert',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::delete($course->image);
            }
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($validated);

        return redirect()->route('enseignant.dashboard')->with('success', 'Cours mis à jour avec succès.');
    }

    
    
}
