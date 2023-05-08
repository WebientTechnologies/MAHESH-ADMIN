<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuizCreated;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
    }
    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('quizzes.show', compact('quiz'));
    }

    public function create()
    {
        return view('quizzes.create');
    }

    public function store(Request $request)
    {
        $quiz = Quiz::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ]);

        foreach ($request->input('questions') as $question) {
            QuizQuestion::create([
                'quiz_id' => $quiz->id,
                'question' => $question['question'],
                'options' => json_encode($question['options']),
                'answer' => $question['answer'],
            ]);
        }

        // Notify all users
        Notification::send(User::all(), new QuizCreated($quiz));

        return redirect()->route('quizzes.index');
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quizQuestions = $quiz->questions;

        // Delete all quiz questions associated with this quiz
        foreach ($quizQuestions as $question) {
            $question->delete();
        }

        // Delete the quiz itself
        $quiz->delete();

        return redirect()->route('quizzes.index')
            ->with('success', 'Quiz deleted successfully.');
    }
}
