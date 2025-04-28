<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Tag;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::with('role')->orderBy('created_at', 'desc')->paginate(10);
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $inactiveUsers = User::where('is_active', false)->count();

        return view('Admin.dashboard', compact('users', 'totalUsers', 'activeUsers', 'inactiveUsers'));
    }

    public function index()
    {
        $categories = Categorie::all();
        $tags = Tag::all();
        return view('Admin.categorie_tags', compact('categories', 'tags'));
    }

    public function toggleUserStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->back()->with('success', 
            $user->is_active 
                ? "L'utilisateur a été activé avec succès." 
                : "L'utilisateur a été désactivé avec succès."
        );
    }

    public function courses()
    {
        $courses = Course::with(['user', 'category'])->paginate(10);
        $totalCourses = Course::count();
        $activeCourses = Course::where('is_active', true)->count();
        $inactiveCourses = Course::where('is_active', false)->count();

        return view('Admin.courses', compact('courses', 'totalCourses', 'activeCourses', 'inactiveCourses'));
    }

    public function showCourse($id)
    {
        $course = Course::with(['user', 'category', 'chapters.lessons'])->findOrFail($id);
        return view('Admin.courses.show', compact('course'));
    }

    public function toggleCourseStatus($id)
    {
        $course = Course::findOrFail($id);
        $course->is_active = !$course->is_active;
        $course->save();

        return redirect()->back()->with('success', 'Le statut du cours a été mis à jour avec succès.');
    }
}
