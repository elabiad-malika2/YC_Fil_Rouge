<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Student_answer;
use App\Models\Quiz_result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StudentAnswerController extends Controller
{
    public function submitAnswers(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'answers' => 'required|array',
            'answers.*' => 'exists:answers,id',
        ]);

        try {
            $quiz = Quiz::with('questions')->findOrFail($request->quiz_id);
            $studentId = Auth::id();
            $answers = $request->answers;

            $existingResult = Quiz_result::where('student_id', $studentId)
                ->where('quiz_id', $request->quiz_id)
                ->first();

            if ($existingResult) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quiz déjà complété'
                ], 422);
            }

            $score = 0;
            $totalPoints = $quiz->questions->sum('points');

            foreach ($answers as $questionId => $answerId) {
                $question = Question::where('id', $questionId)
                    ->where('quiz_id', $quiz->id)
                    ->first();

                if (!$question) {
                    return response()->json([
                        'success' => false,
                        'message' => "La question ID {$questionId} n'appartient pas au quiz ID {$quiz->id}"
                    ], 422);
                }

                $answer = Answer::where('id', $answerId)
                    ->where('question_id', $questionId)
                    ->first();

                if (!$answer) {
                    return response()->json([
                        'success' => false,
                        'message' => "La réponse ID {$answerId} n'appartient pas à la question ID {$questionId}"
                    ], 422);
                }

                Student_answer::create([
                    'student_id' => $studentId,
                    'answer_id' => $answerId,
                    'is_correct' => $answer->is_correct,
                ]);

                if ($answer->is_correct) {
                    $score += $question->points;
                }
            }

            $status = ($score / $totalPoints >= 0.7) ? 'passed' : 'failed';

            $quizResult = Quiz_result::create([
                'student_id' => $studentId,
                'quiz_id' => $request->quiz_id,
                'score' => $score,
                'total_points' => $totalPoints,
                'status' => $status,
            ]);

            return response()->json([
                'success' => true,
                'redirect_url' => route('etudiant.quizzes.results', ['id' => $quiz->id, 'result' => $quizResult->id])
            ]);

        } catch (\Exception $e) {
            Log::error('Échec de la soumission du quiz : ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la soumission du quiz.'
            ], 500);
        }
    }
}