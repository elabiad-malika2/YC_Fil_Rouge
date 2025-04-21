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
        // dd($request);
        $role = Role::where('name', $request->role)->firstOrFail();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/images/users', $imageName);
            $imagePath = str_replace('public/', '', $imagePath);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
            'image' => $imagePath,
        ]);

        Auth::login($user);

        if ($user->role->name === 'enseignant') {
            return redirect()->route('enseignant.dashboard');
        } elseif ($user->role->name === 'etudiant') {
            return redirect()->route('etudiant.dashboard');
        }

        return redirect()->route('dashboard');
    }
}
