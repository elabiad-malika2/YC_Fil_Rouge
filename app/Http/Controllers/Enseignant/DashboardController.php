<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Course;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        $tags = Tag::all();
        $courses = DB::table('courses')
        ->select(
            'courses.id','courses.title','courses.image','courses.description',
            DB::raw('COUNT(DISTINCT chapitres.id) as chapitres_count'),
            DB::raw('COUNT(DISTINCT lessons.id) as lessons_count')
        )
        ->leftJoin('chapitres', 'courses.id', '=', 'chapitres.course_id')
        ->leftJoin('lessons', 'chapitres.id', '=', 'lessons.chapitres_id')
        ->where('courses.user_id','=',Auth::id())
        ->groupBy(
            'courses.id',
            'courses.title',
            'courses.image',
            'courses.description'
        )
        ->get();        

        return view('Enseignant.dashboard', compact('categories','tags','courses'));
    }
} 