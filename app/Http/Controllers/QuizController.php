<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\UserQuizResult;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $quizzes = Quiz::all();
        return view('pages.quizzes.index', compact('quizzes'));
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions.answers'); // Load pertanyaan dan jawaban
        return view('pages.quizzes.show', compact('quiz'));
    }
    public function create()
    {
        if (auth()->user()->role !== 'teacher') {
            return redirect()->route('quizzes.index')->with('error', 'Ups kamu tidak dapat membuat kuis.');
        }

        return view('pages.quizzes.create');
    }

    // Menyimpan kuis beserta pertanyaan dan jawabannya
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'teacher') {
            return redirect()->route('quizzes.index')->with('error', 'Ups kamu tidak dapat membuat kuis.');
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'questions.*.question' => 'required|string|max:500',
            'questions.*.answers.*.answer' => 'required|string|max:255',
            'questions.*.correct_answer' => 'required|integer',
            'type' => ['required', Rule::in(Question::getAllowedTypes())],
        ]);

        // Simpan kuis
        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type
        ]);

        // Simpan pertanyaan dan jawaban
        foreach ($request->questions as $questionData) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question' => $questionData['question'],
            ]);

            foreach ($questionData['answers'] as $key => $answerData) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer' => $answerData['answer'],
                    'is_correct' => $key == $questionData['correct_answer'],
                ]);
            }
        }

        return redirect()->route('quiz.create')->with('success', 'Quiz created successfully!');
    }
    public function submit(Request $request, Quiz $quiz)
    {
        $score = 0;

        foreach ($quiz->questions as $question) {
            $userAnswer = $request->input('answers.' . $question->id);

            if ($question->type === 'multiple_choice') {
                // Validasi jawaban untuk pilihan ganda
                $correctAnswer = $question->answers()->where('is_correct', true)->first();
                if ($correctAnswer && $correctAnswer->id == $userAnswer) {
                    $score++;
                }
            } elseif ($question->type === 'short_answer') {
                // Validasi jawaban untuk isian singkat (case-insensitive)
                $correctAnswer = $question->answers()->first();
                if ($correctAnswer && strcasecmp($correctAnswer->answer, $userAnswer) === 0) {
                    $score++;
                }
            }

            // Simpan hasil untuk setiap pertanyaan
            UserQuizResult::create([
                'user_id' => auth()->id(),
                'quiz_id' => $quiz->id,
                'question_id' => $question->id,
                'answer_id' => $question->type === 'multiple_choice' ? $userAnswer : null,
                'user_answer' => $question->type === 'short_answer' ? $userAnswer : null,
                'is_correct' => isset($correctAnswer) && (
                    ($question->type === 'multiple_choice' && $correctAnswer->id == $userAnswer) ||
                    ($question->type === 'short_answer' && strcasecmp($correctAnswer->answer, $userAnswer) === 0)
                ),
                'score' => isset($correctAnswer) && (
                    ($question->type === 'multiple_choice' && $correctAnswer->id == $userAnswer) ||
                    ($question->type === 'short_answer' && strcasecmp($correctAnswer->answer, $userAnswer) === 0)
                ) ? 1 : 0,
            ]);
        }


        return redirect()->route('quizzes.index')->with('success', "Kuis selesai! Skor Anda: $score");
    }
}
