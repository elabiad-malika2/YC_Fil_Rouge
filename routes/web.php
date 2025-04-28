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
use App\Http\Middleware\Role;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentAnswerController;
use App\Http\Controllers\StudentQuizController;
use App\Http\Controllers\TeacherQuizController;

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
Route::get('/courses/{id}', [CourseController::class, 'showDetails'])->name('courses.details');

// Route par défaut
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// route payment 

Route::middleware(['auth', Role::class . ':etudiant', 'throttle:6,1'])->group(function () {
    Route::get('/courses/{id}/payment', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/courses/{id}/payment', [PaymentController::class, 'process'])->name('payment.process');
    
    // Routes pour les favoris
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/courses/{id}/favorite', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/courses/{id}/favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
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

Route::middleware(['auth', Role::class . ':enseignant' ])->group(function () {
    Route::get('/teacher/quizzes/create', [TeacherQuizController::class, 'showCreateForm'])->name('quizzes.create.view');
    Route::post('/quizzes', [TeacherQuizController::class, 'create'])->name('quizzes.create');
    Route::get('/teacher/quizzes/{quiz}/edit', [TeacherQuizController::class, 'edit'])->name('quizzes.edit');
    Route::put('/teacher/quizzes/{quiz}', [TeacherQuizController::class, 'update'])->name('quizzes.update');
    Route::delete('/teacher/quizzes/{quiz}', [TeacherQuizController::class, 'destroy'])->name('quizzes.destroy');
});

Route::get('/quizzes/{id}', [StudentQuizController::class, 'show'])->name('quizzes.show');
Route::get('/quizzes/{id}/results', [StudentQuizController::class, 'results'])->name('quizzes.results');

// Routes pour les réponses des étudiants
Route::post('/answers/submit', [StudentAnswerController::class, 'submitAnswer'])->name('answers.submit');
Route::post('/answers/complete', [StudentAnswerController::class, 'completeQuiz'])->name('answers.complete');

Route::prefix('admin')->middleware(['auth', Role::class . ':admin'])->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Gestion des utilisateurs (activation/désactivation uniquement)
    Route::put('users/{id}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('admin.users.toggle-status');
    
    // Gestion des cours (vue et activation/désactivation uniquement)
    Route::get('/courses', [AdminController::class, 'courses'])->name('admin.courses.index');
    Route::get('/courses/{id}', [AdminController::class, 'showCourse'])->name('admin.courses.show');
    Route::get('/courses/{id}/stats', [AdminController::class, 'courseStats'])->name('admin.courses.stats');
    Route::put('/courses/{id}/toggle-status', [AdminController::class, 'toggleCourseStatus'])->name('admin.courses.toggle-status');
});