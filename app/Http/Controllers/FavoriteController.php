<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    
    public function store(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        $user = Auth::user();

        if ($user->hasFavorited($course)) {
            return response()->json([
                'success' => false,
                'message' => 'Ce cours est déjà dans vos favoris.'
            ]);
        }

        Favorite::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Cours ajouté à vos favoris avec succès.'
        ]);
    }

    public function destroy(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        $user = Auth::user();

        $user->favorites()->where('course_id', $course->id)->delete();

        if ($request->input('from_favorites') === 'true') {
            return redirect()->back()->with('success', 'Cours retiré de vos favoris avec succès.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Cours retiré de vos favoris avec succès.'
        ]);
    }


    public function index()
    {
        $user = Auth::user();
        $favoriteCourses = $user->favoriteCourses()->with(['category', 'chapters'])->get();

        return view('Etudiant.favorites', compact('favoriteCourses'));
    }
}