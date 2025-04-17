<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   

    public function index()
    {
        $categories = Categorie::all();
        $tags = Tag::all();
        return view('Admin.categorie_tags', compact('categories', 'tags'));
    }

  
}
