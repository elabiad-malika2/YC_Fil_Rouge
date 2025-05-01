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

    public function update(Request $request, $id)
    {
        $categorie = Categorie::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $categorie->update($request->all());

        return redirect()->route('admin.categories_tags.index')->with('success', 'Catégorie mise à jour avec succès');
    }

    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
        return redirect()->back()->with('success', 'Catégorie supprimée avec succès');
    }
}
