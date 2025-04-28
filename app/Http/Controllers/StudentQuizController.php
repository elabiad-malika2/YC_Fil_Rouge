<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Quiz_result;
use App\Models\Student_answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentQuizController extends Controller
{
    public function show($id)
{
    $quiz = Quiz::with('questions.answers')->findOrFail($id);

    $isEnrolled = Auth::check() && Auth::user()->enrollments()->where('course_id', $quiz->course_id)->where('payment_status', 'completed')->exists();
    if (!$isEnrolled) {
        return redirect()->route('courses.showDetails', $quiz->course_id)->with('error', 'Vous devez être inscrit au cours pour passer ce quiz.');
    }

    // Vérifier si l'étudiant a déjà un résultat
    $existingResult = Quiz_result::where('student_id', Auth::id())
        ->where('quiz_id', $id)
        ->first();

    if ($existingResult) {
        return redirect()->route('quizzes.results', $id)
            ->with('error', 'Vous avez déjà passé ce quiz.');
    }

    return view('Etudiant.quiz', compact('quiz'));
}

    public function results($id)
    {
        $quiz = Quiz::findOrFail($id);
        $answers = Student_answer::where('student_id', Auth::id())
            ->whereHas('answer', function ($query) use ($quiz) {
                $query->whereHas('question', function ($q) use ($quiz) {
                    $q->where('quiz_id', $quiz->id);
                });
            })
            ->with(['answer.question'])
            ->get();
        $result = Quiz_result::where('student_id', Auth::id())
            ->where('quiz_id', $id)
            ->firstOrFail();

        return view('Etudiant.results', compact('quiz', 'answers', 'result'));
    }
}