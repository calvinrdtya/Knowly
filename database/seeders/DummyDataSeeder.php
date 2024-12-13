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
        // Buat kuis baru
        $quiz = Quiz::create([
            'title' => 'Kuis Pengetahuan Umum',
            'description' => 'Kuis ini menguji pengetahuan umum tentang berbagai topik.',
        ]);

        // Buat 10 pertanyaan untuk kuis
        for ($i = 1; $i <= 10; $i++) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question' => "Ini adalah pertanyaan ke-$i. Apa jawabannya?",
            ]);

            // Buat 4 jawaban untuk setiap pertanyaan
            for ($j = 1; $j <= 4; $j++) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer' => "Pilihan Jawaban $j untuk Pertanyaan $i",
                    'is_correct' => $j === 1, // Jawaban pertama dianggap benar
                ]);
            }
        }

        echo "Dummy quiz with 10 questions and answers has been seeded.\n";
    }
}
