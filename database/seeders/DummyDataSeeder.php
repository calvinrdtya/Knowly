<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the quiz
        $quiz = Quiz::create([
            'title' => 'Kuis Pengetahuan Umum',
            'description' => 'Kuis ini menguji pengetahuan umum tentang berbagai topik.',
            'teacher_id' => rand(1, 10),
            'my_class_id' => rand(1, 10),
            'subject_id' => rand(1, 10),
        ]);

        $multipleChoiceQuestions = [
            [
                'question' => 'Apa ibu kota dari Prancis?',
                'answers' => ['Berlin', 'Madrid', 'Paris', 'Roma'],
                'correct' => 2,
                'type' => 'multiple_choice',
            ],
            [
                'question' => 'Unsur apa yang memiliki nomor atom 1?',
                'answers' => ['Helium', 'Hidrogen', 'Oksigen', 'Nitrogen'],
                'correct' => 1,
                'type' => 'multiple_choice',
            ],
            [
                'question' => 'Planet terbesar dalam tata surya kita adalah?',
                'answers' => ['Bumi', 'Jupiter', 'Saturnus', 'Mars'],
                'correct' => 1,
                'type' => 'multiple_choice',
            ],
            [
                'question' => 'Berapa kecepatan cahaya?',
                'answers' => ['300.000 km/detik', '150.000 km/detik', '500.000 km/detik', '1.000.000 km/detik'],
                'correct' => 0,
                'type' => 'multiple_choice',
            ],
            [
                'question' => 'Siapa yang mengembangkan teori relativitas?',
                'answers' => ['Newton', 'Einstein', 'Galileo', 'Hawking'],
                'correct' => 1,
                'type' => 'multiple_choice',
            ],
            [
                'question' => 'Apa simbol kimia untuk Emas?',
                'answers' => ['Au', 'Ag', 'Fe', 'Pb'],
                'correct' => 0,
                'type' => 'multiple_choice',
            ],
            [
                'question' => 'Ada berapa benua di dunia?',
                'answers' => ['5', '6', '7', '8'],
                'correct' => 2,
                'type' => 'multiple_choice',
            ],
            [
                'question' => 'Berapakah akar kuadrat dari 64?',
                'answers' => ['6', '7', '8', '9'],
                'correct' => 2,
                'type' => 'multiple_choice',
            ],
            [
                'question' => 'Gas apa yang diserap tumbuhan dari atmosfer?',
                'answers' => ['Oksigen', 'Karbon Dioksida', 'Nitrogen', 'Hidrogen'],
                'correct' => 1,
                'type' => 'multiple_choice',
            ],
            [
                'question' => 'Apa zat alami terkeras di Bumi?',
                'answers' => ['Emas', 'Besi', 'Berlian', 'Grafit'],
                'correct' => 2,
                'type' => 'multiple_choice',
            ],
        ];

        foreach ($multipleChoiceQuestions as $mcq) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question' => $mcq['question'],
                'type' => $mcq['type'],
            ]);

            foreach ($mcq['answers'] as $index => $answer) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer' => $answer,
                    'is_correct' => $index === $mcq['correct'],
                ]);
            }
        }

        // Soal Isian Singkat
        $shortAnswerQuestions = [
            ['question' => 'Sebutkan proses di mana tumbuhan membuat makanannya.', 'answer' => 'Fotosintesis', 'type' => 'short_answer'],
            ['question' => 'Apa pusat tenaga dari sel?', 'answer' => 'Mitokondria', 'type' => 'short_answer'],
            ['question' => 'Siapa penulis "Romeo dan Juliet"?', 'answer' => 'William Shakespeare', 'type' => 'short_answer'],
            ['question' => 'Apa ibu kota Indonesia?', 'answer' => 'Jakarta', 'type' => 'short_answer'],
            ['question' => 'Apa mamalia terbesar di dunia?', 'answer' => 'Paus Biru', 'type' => 'short_answer'],
        ];

        foreach ($shortAnswerQuestions as $saq) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question' => $saq['question'],
                'type' => $saq['type'],
            ]);

            // Jawaban untuk soal isian singkat
            Answer::create([
                'question_id' => $question->id,
                'answer' => $saq['answer'],
                'is_correct' => true,
            ]);
        }
        echo "Custom quiz seeded successfully with multiple choice and short answer questions.\n";
    }
}
