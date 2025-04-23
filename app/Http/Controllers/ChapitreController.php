<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use App\Models\Lesson;
use Illuminate\Http\Request;

class ChapitreController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Chapitre::create($validated);

        return redirect()->back()->with('success', 'Chapitre ajouté avec succès.');
    }
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
    public function destroy($id)
    {
        $chapter = Chapitre::findOrFail($id);

        Lesson::where('chapitres_id', $chapter->id)->delete();

        $chapter->delete();

        return redirect()->back()->with('success', 'Chapitre et ses leçons supprimés avec succès.');
    }
}
