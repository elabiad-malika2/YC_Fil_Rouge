<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        Categorie::create($request->all());

        return redirect()->back()->with('success', 'Catégorie ajoutée avec succès');
    }

    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $categorie->id,
        ]);

        $categorie->update($request->all());

        return redirect()->back()->with('success', 'Catégorie mise à jour avec succès');
    }

    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return redirect()->back()->with('success', 'Catégorie supprimée avec succès');
    }
}
