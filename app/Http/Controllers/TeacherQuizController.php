<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Course;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherQuizController extends Controller
{
    public function showCreateForm()
    {
        $courses = Course::where('user_id', Auth::id())
            ->whereDoesntHave('quiz')
            ->get(['id', 'title']);
        
        $quizzes = Quiz::where('teacher_id', Auth::id())
            ->with('course', 'questions')
            ->get(['id', 'title', 'course_id', 'created_at']);
        
        return view('Enseignant.create_quiz', compact('courses', 'quizzes'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'questions' => 'required|array|min:1',
            'questions.*.text' => 'required|string',
            'questions.*.points' => 'required|integer|min:1',
            'questions.*.duration' => 'required|integer|min:1',
            'questions.*.answers' => 'required|array|size:4',
            'questions.*.answers.*.text' => 'required|string',
            'questions.*.correct_answer' => 'required|integer|between:0,3',
        ]);

        foreach ($request->questions as $index => $qData) {
            $correctAnswers = array_filter($qData['answers'], fn($answer) => isset($answer['is_correct']) && $answer['is_correct'] == '1');
            if (count($correctAnswers) !== 1) {
                return back()->withErrors(["questions.$index.correct_answer" => 'Chaque question doit avoir exactement une réponse correcte.']);
            }
        }

        // Créer le quiz
        $quiz = Quiz::create([
            'title' => $request->title,
            'course_id' => $request->course_id,
            'teacher_id' => Auth::id(),
        ]);

        // Créer les questions et réponses
        foreach ($request->questions as $index => $qData) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'text' => $qData['text'],
                'points' => $qData['points'],
                'duration' => $qData['duration'],
            ]);

            foreach ($qData['answers'] as $aIndex => $aData) {
                Answer::create([
                    'question_id' => $question->id,
                    'text' => $aData['text'],
                    'is_correct' => $aIndex == $qData['correct_answer'],
                ]);
            }
        }

        return redirect()->route('enseignant.quizzes.create.view')->with('success', 'Quiz créé avec succès !');
    }
    public function edit(Quiz $quiz)
    {
        if ($quiz->teacher_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }
        $courses = Course::where('user_id', Auth::id())->get(['id', 'title']);
        $quiz->load('questions.answers');
        return view('Enseignant.edit_quiz', compact('quiz', 'courses'));
    }
    public function update(Request $request, Quiz $quiz)
    {
        if ($quiz->teacher_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'questions' => 'required|array|min:1',
            'questions.*.text' => 'required|string',
            'questions.*.points' => 'required|integer|min:1',
            'questions.*.duration' => 'required|integer|min:1',
            'questions.*.answers' => 'required|array|size:4',
            'questions.*.answers.*.text' => 'required|string',
            'questions.*.correct_answer' => 'required|integer|between:0,3',
        ]);

        // Vérifier si le nouveau cours a déjà un quiz (et ce n'est pas le quiz actuel)
        $course = Course::find($request->course_id);
        if ($course->quiz && $course->quiz->id !== $quiz->id) {
            return back()->withErrors(['course_id' => 'Ce cours a déjà un quiz associé. Chaque cours ne peut avoir qu\'un seul quiz.']);
        }

        // Vérifier qu'il y a exactement une réponse correcte par question
        foreach ($request->questions as $index => $qData) {
            $correctAnswers = array_filter($qData['answers'], fn($answer) => isset($answer['is_correct']) && $answer['is_correct'] == '1');
            if (count($correctAnswers) !== 1) {
                return back()->withErrors(["questions.$index.correct_answer" => 'Chaque question doit avoir exactement une réponse correcte.']);
            }
        }

        // Mettre à jour le quiz
        $quiz->update([
            'title' => $request->title,
            'course_id' => $request->course_id,
        ]);

        // Supprimer les anciennes questions et réponses
        $quiz->questions()->each(function ($question) {
            $question->answers()->delete();
            $question->delete();
        });

        // Créer les nouvelles questions et réponses
        foreach ($request->questions as $index => $qData) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'text' => $qData['text'],
                'points' => $qData['points'],
                'duration' => $qData['duration'],
            ]);

            foreach ($qData['answers'] as $aIndex => $aData) {
                Answer::create([
                    'question_id' => $question->id,
                    'text' => $aData['text'],
                    'is_correct' => $aIndex == $qData['correct_answer'],
                ]);
            }
        }

        return redirect()->route('enseignant.quizzes.create.view')->with('success', 'Quiz mis à jour avec succès !');
    }

    public function destroy(Quiz $quiz)
    {
        if ($quiz->teacher_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        $quiz->questions()->each(function ($question) {
            $question->answers()->delete();
            $question->delete();
        });
        $quiz->delete();

        return redirect()->route('enseignant.quizzes.create.view')->with('success', 'Quiz supprimé avec succès !');
    }
}
