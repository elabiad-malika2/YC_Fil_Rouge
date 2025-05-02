<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Chapitre;
use App\Models\Lesson;
use App\Http\Requests\CourseRequest;
use App\Models\Categorie;
use App\Models\Quiz_result;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function show(){
        $categories = Categorie::all();
        return view('welcome', compact('categories'));
    }
    public function apiShow(Request $request)
    {
        $query = Course::with(['category', 'tags', 'user', 'chapters', 'chapters.lessons'])
        ->select('courses.*')
        ->where('is_active', true);

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $courses = $query->paginate(3);

        $courses->getCollection()->transform(function ($course) {
            $course->image_url = $course->image ? Storage::url($course->image) : null;
            $course->teacher_name = $course->user->name;
            $course->teacher_photo = $course->user->photo ? Storage::url($course->user->photo) : null;
            $course->is_favorited = Auth::check() && Auth::user()->hasFavorited($course);
            return $course;
        });

        return response()->json([
            'courses' => $courses->items(),
            'pagination' => [
                'current_page' => $courses->currentPage(),
                'last_page' => $courses->lastPage(),
                'per_page' => $courses->perPage(),
                'total' => $courses->total(),
            ],
        ]);
    }
    public function showDetails($id)
    {
        $course = Course::with(['category', 'user', 'chapters.lessons', 'quiz', 'tags'])->findOrFail($id);
        $isEnrolled = Auth::check() && Auth::user()->enrollments()->where('course_id', $id)->where('payment_status', 'completed')->exists();
        $quizResult = null;

        if (Auth::check() && $isEnrolled) {
            $quizResult = Quiz_result::where('student_id', Auth::id())
                ->whereHas('quiz', function ($query) use ($id) {
                    $query->where('course_id', $id);
                })
                ->first();
        }

        return view('Etudiant.details', compact('course', 'isEnrolled', 'quizResult'));
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
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::delete($course->image);
            }
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($validated);

        // Mise à jour des tags
        if ($request->has('tags')) {
            $course->tags()->sync($request->tags);
        }

        return redirect()->route('enseignant.dashboard')->with('success', 'Cours mis à jour avec succès.');
    }

    
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        
        // Vérifier si l'utilisateur est autorisé à supprimer ce cours
        if ($course->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer ce cours.');
        }
        
        // Supprimer les leçons et leurs fichiers associés
        foreach ($course->chapters as $chapter) {
            foreach ($chapter->lessons as $lesson) {
                if ($lesson->video_path) {
                    Storage::disk('public')->delete($lesson->video_path);
                }
                $lesson->delete();
            }
            $chapter->delete();
        }
        
        // Supprimer l'image du cours
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        
        // Supprimer les relations avec les tags
        $course->tags()->detach();
        
        // Supprimer le cours
        $course->delete();
        
        return redirect()->route('enseignant.dashboard')->with('success', 'Cours supprimé avec succès.');
    }
}
