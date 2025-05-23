<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); 
    }
    public function login(Request $request){

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Aucun compte trouvé avec cet e-mail.',
            ]);
        }


        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Mot de passe incorrect.',
            ]);
        }

        // Vérifier si le compte est actif
        if (!$user->is_active) {
            return back()->withErrors([
                'email' => 'Votre compte est désactivé. Veuillez contacter administrateur.',
            ]);
        }
        Auth::login($user); 

        if ($user->role->name === 'enseignant') {
            return redirect()->route('enseignant.dashboard');
        } elseif ($user->role->name === 'etudiant') {
            return redirect()->route('courses.show');
        }elseif ($user->role->name === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }
    
}
