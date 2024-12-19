<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use DB;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\MyClass;
use App\Models\UserQuizResult;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexStudent()
    {
        $quizzes = Quiz::all();
        // return view('pages.quizzes.index', compact('quizzes'));
        return view('student.kuis.index', compact('quizzes'));
    }
    public function showKuisStudent(Quiz $quiz)
    {
        $userId = auth()->user()->id;
        $quiz->load('questions.answers');

        $hasSubmitted = \App\Models\UserQuizResult::where('user_id', $userId)
                        ->where('quiz_id', $quiz->id)
                        ->exists();

        $userAnswers = DB::table('user_quiz_results')
                        ->where('quiz_id', $quiz->id)
                        ->where('user_id', auth()->user()->id)
                        ->pluck('user_answer', 'question_id');

        return view('student.kuis.show', compact('quiz', 'hasSubmitted', 'userAnswers'));
    }

    public function indexTeacher()
    {
        $quizzes = Quiz::all();
        return view('teacher.pages.kuis.index', compact('quizzes'));
    }

    public function showKuisTeacher(Quiz $quiz)
    {
        $userId = auth()->user()->id;
        $quiz->load('questions.answers');

        $userQuizResults = \App\Models\UserQuizResult::where('user_id', $userId)
                            ->where('quiz_id', $quiz->id)
                            ->first();
        
        $answers = [];
        if ($userQuizResults) {
            $answers = $userQuizResults->answers->pluck('answer_id', 'question_id')->toArray();
        }
        return view('teacher.pages.kuis.show', compact('quiz', 'answers'));
    }

    public function createKuis()
    {
        if (auth()->user()->user_type !== 'teacher') {
            return redirect()->route('quizzes.index')->with('error', 'Ups kamu tidak dapat membuat kuis.');
        } 

        $classes = MyClass::whereHas('subjects', function ($query) {
            $query->where('teacher_id', auth()->user()->id);
        })->get();

        $data = [
            'classes' => $classes
        ];

        return view('teacher.pages.kuis.create', $data);
        // return view('pages.quizzes.create_2');
    }

    public function store(Request $request)
    {
        if (auth()->user()->user_type !== 'teacher') {
            return redirect()->route('quizzes.index')->with('error', 'Ups, kamu tidak dapat membuat kuis.');
        }

        $teacher = auth()->user();


        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string|max:500',
            'questions.*.type' => ['required', Rule::in(['multiple_choice', 'short_answer'])],
            'questions..correct_answer' => 'required_if:questions..type,multiple_choice|integer|min:0|max:3',
        ]);
        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
            'teacher_id' => $teacher->id,
            'subject_id' => $request->subject_id,
            'my_class_id' => $request->class_id
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
        return redirect()->route('teacher.quizzes.index')->with('success', 'Quiz berhasil dibuat!');
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $score = 0;

        $userAnswers = $request->input('answers', []); 

        foreach ($quiz->questions as $question) {
            $userAnswer = array_key_exists($question->id, $userAnswers) ? $userAnswers[$question->id] : null;
            $correctAnswer = null;
            $isCorrect = false; 

            if ($question->type === 'multiple_choice') {
                $correctAnswer = $question->answers()->where('is_correct', true)->first();

                if ($correctAnswer && $correctAnswer->id == $userAnswer) {
                    $isCorrect = true;
                    $score++;
                }
            } elseif ($question->type === 'short_answer') {
                $correctAnswer = $question->answers()->first();

                if ($correctAnswer && strcasecmp($correctAnswer->answer, $userAnswer) === 0) {
                    $isCorrect = true;
                    $score++;
                }
            }
            UserQuizResult::create([
                'user_id' => auth()->id(),
                'quiz_id' => $quiz->id,
                'question_id' => $question->id,
                'answer_id' => $correctAnswer ? $correctAnswer->id : null,
                'user_answer' => $userAnswer ?? '',
                'is_correct' => $isCorrect,
                'score' => $isCorrect ? 1 : 0,
            ]);
        }
        $finalScore = round(($score / $quiz->questions()->count()) * 100, 1);

        return redirect()->route('student.quizzes.index')->with('success', "Kuis selesai! Skor Anda: $finalScore");
    }
}