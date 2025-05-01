<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function create()
    {
        $roles = Role::whereIn('name', ['etudiant', 'enseignant'])->get();
        return view('register', compact('roles'));
    }

    public function store(RegisterRequest $request)
    {
        $role = Role::where('name', $request->role)->firstOrFail();

        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
            'image' => $request->file('image')->store('users/images', 'public'),
        ]);

        Auth::login($user);

        if ($user->role->name === 'enseignant') {
            return redirect()->route('enseignant.dashboard');
        } elseif ($user->role->name === 'etudiant') {
            return redirect()->route('courses.show');
        }

        return redirect()->route('dashboard');
    }
}
