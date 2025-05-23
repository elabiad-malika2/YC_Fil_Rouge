<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Course;
use App\Models\Tag;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        $tags = Tag::all();
        
        // Récupérer l'ID de l'enseignant connecté
        $teacherId = Auth::id();
        
        //  Nombre de cours 
        $CoursesCount = Course::where('user_id', $teacherId)->count();
        
        //  Nombre d'étudiants inscrits 
        $enrolledStudentsCount = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->where('courses.user_id', $teacherId)
            ->select(DB::raw('COUNT(DISTINCT enrollments.user_id) as count'))
            ->first()
            ->count;
        
        // Revenus totaux 
        $totalRevenue = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->where('courses.user_id', $teacherId)
            ->sum('courses.price');
        
        // cours récents avec leurs statistiques
        $courses = DB::table('courses')
        ->select(
            'courses.id','courses.title','courses.image','courses.description','courses.level',
            DB::raw('COUNT(DISTINCT chapitres.id) as chapitres_count'),
            DB::raw('COUNT(DISTINCT lessons.id) as lessons_count'),
            DB::raw('(SELECT COUNT(*) FROM enrollments WHERE enrollments.course_id = courses.id) as students_count')
        )
        ->leftJoin('chapitres', 'courses.id', '=', 'chapitres.course_id')
        ->leftJoin('lessons', 'chapitres.id', '=', 'lessons.chapitres_id')
        ->where('courses.user_id', $teacherId)
        ->groupBy(
            'courses.id',
            'courses.title',
            'courses.image',
            'courses.description',
            'courses.level'
        )
        ->get();        

        return view('Enseignant.dashboard', compact(
            'categories',
            'tags',
            'courses',
            'CoursesCount',
            'enrolledStudentsCount',
            'totalRevenue'
        ));
    }
} 