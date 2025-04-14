<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(RegisterRequest $request)
    {
        $role = Role::where('name', $request->role)->firstOrFail();

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('images/users', 'public')
            : null;

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => $role->id,
            'image'    => $imagePath,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Bienvenue ' . $user->name);
    }
}
