<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\Quiz_result;
use App\Models\Student_answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAnswerController extends Controller
{
    public function submitAnswer(Request $request)
    {
        $request->validate([
            'answer_id' => 'nullable|exists:answers,id',
        ]);

        $answer = Answer::find($request->answer_id);
        $isCorrect = $answer ? $answer->is_correct : false;

        Student_answer::create([
            'student_id' => Auth::id(),
            'answer_id' => $request->answer_id,
            'is_correct' => $isCorrect,
        ]);

        return response()->json(['message' => 'Réponse enregistrée', 'is_correct' => $isCorrect]);
    }

    public function completeQuiz(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
        ]);

        $existingResult = Quiz_result::where('student_id', Auth::id())
            ->where('quiz_id', $request->quiz_id)
            ->first();

        if ($existingResult) {
            return response()->json(['error' => 'Quiz déjà complété'], 422);
        }

        $quiz = Quiz::with('questions')->findOrFail($request->quiz_id);
        $answers = Student_answer::where('student_id', Auth::id())
            ->whereHas('answer', function ($query) use ($quiz) {
                $query->whereHas('question', function ($q) use ($quiz) {
                    $q->where('quiz_id', $quiz->id);
                });
            })
            ->with(['answer.question'])
            ->get();

        $score = $answers->where('is_correct', true)->sum('answer.question.points');
        $totalPoints = $quiz->questions->sum('points');
        $status = ($score / $totalPoints >= 0.7) ? 'passed' : 'failed';

        Quiz_result::create([
            'student_id' => Auth::id(),
            'quiz_id' => $request->quiz_id,
            'score' => $score,
            'total_points' => $totalPoints,
            'status' => $status,
        ]);

        return response()->json([
            'message' => 'Quiz terminé',
            'score' => $score,
            'total_points' => $totalPoints,
            'status' => $status,
        ]);
    }
}