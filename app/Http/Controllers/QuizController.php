<?php 
namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\UserQuizResult;
use Illuminate\Http\Request;

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
        return view('pages.quizzes.create');
    }

    // Menyimpan kuis beserta pertanyaan dan jawabannya
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'questions.*.question' => 'required|string|max:500',
            'questions.*.answers.*.answer' => 'required|string|max:255',
            'questions.*.correct_answer' => 'required|integer',
        ]);

        // Simpan kuis
        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
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

        foreach ($request->input('answers') as $questionId => $answerId) {
            $correctAnswer = $quiz->questions()->find($questionId)->answers()->where('is_correct', true)->first();
            if ($correctAnswer && $correctAnswer->id == $answerId) {
                $score++;
            }
        }

        UserQuizResult::create([
            'user_id' => auth()->user()->id,
            'quiz_id' => $quiz->id,
            'question_id' => $questionId,
            'answer_id' => $answerId,
            'score' => $score,
        ]);

        return redirect()->route('quizzes.index')->with('success', "Kuis selesai! Skor Anda: $score");
    }
}
