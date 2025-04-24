<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Ajouter un cours aux favoris
     */
    public function store($courseId)
    {
        $course = Course::findOrFail($courseId);
        $user = Auth::user();

        // Vérifier si le cours est déjà en favori
        if ($user->hasFavorited($course)) {
            return response()->json([
                'success' => false,
                'message' => 'Ce cours est déjà dans vos favoris.'
            ]);
        }

        // Ajouter le cours aux favoris
        Favorite::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Cours ajouté à vos favoris avec succès.'
        ]);
    }

    /**
     * Supprimer un cours des favoris
     */
    public function destroy($courseId)
    {
        $course = Course::findOrFail($courseId);
        $user = Auth::user();

        // Supprimer le cours des favoris
        $user->favorites()->where('course_id', $course->id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cours retiré de vos favoris avec succès.'
        ]);
    }

    /**
     * Afficher la liste des cours favoris
     */
    public function index()
    {
        $user = Auth::user();
        $favoriteCourses = $user->favoriteCourses()->with(['category', 'chapters'])->get();

        return view('Etudiant.favorites', compact('favoriteCourses'));
    }
}
