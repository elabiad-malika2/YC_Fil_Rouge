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
use App\Http\Controllers\QuizResultController;

// Routes publiques (accessibles à tous)
Route::get('/', [CourseController::class, 'show'])->name('courses.show');
Route::get('/courses/{id}', [CourseController::class, 'showDetails'])->name('courses.details');

// Routes d'authentification
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'store'])->name('register');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Route de déconnexion
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Routes API
Route::get('/api/courses', [CourseController::class, 'apiShow'])->name('api.courses.show');

// Routes Étudiant
Route::middleware(['auth', Role::class . ':etudiant'])->prefix('etudiant')->name('etudiant.')->group(function () {
    Route::get('/dashboard', function () {
        return view('Etudiant.dashboard');
    })->name('dashboard');

    // Routes de paiement
    Route::get('/courses/{id}/payment', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/courses/{id}/payment', [PaymentController::class, 'process'])->name('payment.process');
    
    // Routes des favoris
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/courses/{id}/favorite', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/courses/{id}/favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    // Routes des quiz
    Route::get('/quizzes/{id}', [StudentQuizController::class, 'show'])->name('quizzes.show');
    Route::get('/quizzes/{id}/results', [StudentQuizController::class, 'results'])->name('quizzes.results');
    Route::post('/answers/submit', [StudentAnswerController::class, 'submitAnswers'])->name('answers.submit');
    Route::get('/quiz-results', [StudentQuizController::class, 'quizResults'])->name('quiz-results');
    Route::get('/quiz-results/{id}', [StudentQuizController::class, 'quizResultDetails'])->name('quiz-result-details');
});

// Routes Enseignant
Route::middleware(['auth', Role::class . ':enseignant'])->prefix('enseignant')->name('enseignant.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Routes des cours
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::put('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    
    // Routes des chapitres
    Route::post('/chapters', [ChapitreController::class, 'store'])->name('chapters.store');
    Route::put('/chapters/{id}', [ChapitreController::class, 'update'])->name('chapters.update');
    Route::delete('/chapters/{id}', [ChapitreController::class, 'destroy'])->name('chapters.destroy');
    
    // Routes des leçons
    Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
    Route::put('/lessons/{id}', [LessonController::class, 'update'])->name('lessons.update');
    Route::delete('/lessons/{id}', [LessonController::class, 'destroy'])->name('lessons.destroy');

    // Routes des quiz
    Route::get('/quizzes/create', [TeacherQuizController::class, 'showCreateForm'])->name('quizzes.create.view');
    Route::post('/quizzes', [TeacherQuizController::class, 'create'])->name('quizzes.create');
    Route::get('/quizzes/{quiz}/edit', [TeacherQuizController::class, 'edit'])->name('quizzes.edit');
    Route::put('/quizzes/{quiz}', [TeacherQuizController::class, 'update'])->name('quizzes.update');
    Route::delete('/quizzes/{quiz}', [TeacherQuizController::class, 'destroy'])->name('quizzes.destroy');
});

// Routes Admin
Route::middleware(['auth', Role::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Gestion des catégories et tags
    Route::get('/categories_tags', [AdminController::class, 'index'])->name('categories_tags.index');
    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');
    
    // Routes pour les tags
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');
    Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
    Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
    
    // Gestion des utilisateurs
    Route::match(['put', 'post'], '/users/{id}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('users.toggle-status');
    
    // Gestion des cours
    Route::get('/courses', [AdminController::class, 'courses'])->name('courses.index');
    Route::get('/courses/{id}', [AdminController::class, 'showCourse'])->name('courses.show');
    Route::get('/courses/{id}/stats', [AdminController::class, 'courseStats'])->name('courses.stats');
    Route::put('/courses/{id}/toggle-status', [AdminController::class, 'toggleCourseStatus'])->name('courses.toggle-status');
});