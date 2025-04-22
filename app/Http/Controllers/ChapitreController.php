<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use Illuminate\Http\Request;

class ChapitreController extends Controller
{
    public function update(Request $request, $id)
    {
        $chapter = Chapitre::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $chapter->update($validated);

        return redirect()->back()->with('success', 'Chapitre mis à jour avec succès.');
    }
}
