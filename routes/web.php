<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Enseignant\DashboardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PaymentController;

// Routes d'authentification
Route::get('/register', [RegisterController::class, 'create'])->name('register.form');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

// Route de connexion 
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route de déconnexion
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


// 'Routes des dashboards
Route::get('/enseignant/dashboard', [DashboardController::class, 'index'])->name('enseignant.dashboard');
Route::get('/api/courses', [CourseController::class, 'apiShow'])->name('api.courses.show');

Route::get('/etudiant/dashboard', function () {
    return view('Etudiant.dashboard');
})->name('etudiant.dashboard');

Route::get('/', [CourseController::class, 'show'])->name('courses.show');
Route::get('/courses/{id}', [CourseController::class, 'showDetails'])->name('Etudaint.details');

// Route par défaut
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// route payment 

Route::middleware(['auth'])->group(function () {
    Route::post('/courses/{id}/payment', [PaymentController::class, 'create'])->name('payment.create');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

// Routes pour les catégories et tags
Route::prefix('admin')->group(function () {
    Route::get('categories_tags', [AdminController::class, 'index'])->name('categories_tags.index');
    Route::post('categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::put('categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
    Route::delete('categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');
    Route::resource('tags', TagController::class);
});

Route::prefix('enseignant')->group(function () {
    Route::post('courses', [CourseController::class, 'store'])->name('courses.store');
    Route::put('courses/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::post('chapters', [ChapitreController::class, 'store'])->name('chapters.store');
    Route::put('chapters/{id}', [ChapitreController::class, 'update'])->name('chapters.update');
    Route::delete('chapters/{id}', [ChapitreController::class, 'destroy'])->name('chapters.destroy');
    // Route::post('courses',function(){
    //     dd("test");
    // })->name('courses.store');

    // Routes pour les leçons
    Route::post('lessons', [LessonController::class, 'store'])->name('lessons.store');
    Route::put('lessons/{id}', [LessonController::class, 'update'])->name('lessons.update');
    Route::delete('lessons/{id}', [LessonController::class, 'destroy'])->name('lessons.destroy');

    
});
Route::get('/enseignant/courses/{course}/edit', [CourseController::class, 'edit'])->name('enseignant.courses.edit');
Route::put('/enseignant/courses/{course}', [CourseController::class, 'update'])->name('enseignant.courses.update');
