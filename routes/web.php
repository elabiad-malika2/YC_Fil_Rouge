<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

// Routes d'authentification
Route::get('/register', [RegisterController::class, 'create'])->name('register.form');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

// Routes des dashboards
Route::get('/enseignant/dashboard', function () {
    return view('Enseignant.dashboard');
})->name('enseignant.dashboard');

Route::get('/etudiant/dashboard', function () {
    return view('Etudiant.dashboard');
})->name('etudiant.dashboard');

// Route par défaut
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
