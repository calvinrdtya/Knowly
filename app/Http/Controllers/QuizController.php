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
        // return view('pages.quizzes.index', compact('quizzes'));
        return view('student.kuis.index', compact('quizzes'));
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions.answers');
        return view('pages.quizzes.show', compact('quiz'));
    }
    public function create()
    {
        if (auth()->user()->user_type !== 'teacher') {
            return redirect()->route('quizzes.index')->with('error', 'Ups kamu tidak dapat membuat kuis.');
        }
        // return view('pages.quizzes.create');
        return view('teacher.pages.kuis.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->user_type !== 'teacher') {
            return redirect()->route('quizzes.index')->with('error', 'Ups, kamu tidak dapat membuat kuis.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string|max:500',
            'questions.*.type' => ['required', Rule::in(['multiple_choice', 'short_answer'])],
            'questions.*.correct_answer' => 'required_if:questions.*.type,multiple_choice|integer|min:0|max:3',
        ]);

        // Simpan kuis
        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        foreach ($request->questions as $questionData) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question' => $questionData['question'],
                'type' => $questionData['type'],
            ]);

            if ($questionData['type'] === 'multiple_choice') {
                foreach ($questionData['answers'] as $key => $answerData) {
                    Answer::create([
                        'question_id' => $question->id,
                        'answer' => $answerData['answer'],
                        'is_correct' => $key == $questionData['correct_answer'],
                    ]);
                }
            } elseif ($questionData['type'] === 'short_answer') {
                Answer::create([
                    'question_id' => $question->id,
                    'answer' => $questionData['answers'][0]['answer'],
                    'is_correct' => true, 
                ]);
            }
        }
        return redirect()->route('quizzes.index')->with('success', 'Quiz berhasil dibuat!');
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
