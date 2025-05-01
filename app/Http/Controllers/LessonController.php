<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    //
    public function store(Request $request)
    {
        // dd($request->chapitres_id);
        $validated = $request->validate([
            'chapitres_id' => 'required|exists:chapitres,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:text,video',
            'text_content' => 'required_if:type,text|string|nullable',
            'video' => 'required_if:type,video|file|mimes:mp4,avi,mov|max:102400|nullable',
        ]);
        
        if ($request->hasFile('video')) {
            $validated['video'] = $request->file('video')->store('courses/videos', 'public');
        }

        Lesson::create($validated);

        return redirect()->back()->with('success', 'Leçon ajoutée avec succès.');
    }
    //
    public function update(Request $request, $id)
    {
        $lesson = Lesson::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:text,video',
            'text_content' => 'required_if:type,text|string|nullable',
            'video' => 'required_if:type,video|file|mimes:mp4,avi,mov|nullable',
        ]);

        if ($request->hasFile('video')) {
            if ($lesson->video) {
                Storage::delete($lesson->video_path);
            }
            $validated['video'] = $request->file('video')->store('courses/videos', 'public');
        }

        $lesson->update($validated);

        return redirect()->back()->with('success', 'Leçon mise à jour avec succès.');
    }
    // 
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        if ($lesson->video) {
            Storage::delete($lesson->video_path);
        }
        $lesson->delete();

        return redirect()->back()->with('success', 'Leçon supprimée avec succès.');
    }

}
