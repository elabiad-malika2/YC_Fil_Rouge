<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('Admin.categorie_tags', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags',
            'color' => 'required|string|max:7',
        ]);

        Tag::create($request->all());

        return redirect()->back()->with('success', 'Tag ajouté avec succès');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('Admin.edit_tag', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $id,
            'color' => 'required|string|max:7',
        ]);

        $tag->update($request->all());

        return redirect()->back()->with('success', 'Tag mis à jour avec succès');
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect()->back()->with('success', 'Tag supprimé avec succès');
    }
} 