<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use Illuminate\Http\Request;

class ChapitreController extends Controller
{
    

    public function destroy($id)
    {
        $chapter = Chapitre::findOrFail($id);
        $chapter->delete();

        return redirect()->back()->with('success', 'Chapitre supprimé avec succès.');
    }
}
