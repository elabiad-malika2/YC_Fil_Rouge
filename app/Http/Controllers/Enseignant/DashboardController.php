<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Tag;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        $tags = Tag::all();
        return view('Enseignant.dashboard', compact('categories', 'tags'));
    }
} 