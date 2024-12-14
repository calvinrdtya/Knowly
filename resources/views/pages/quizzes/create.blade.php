<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Kuis</title>
</head>
<body>
    <h1>Buat Kuis Baru</h1>

    <form action="{{ route('quiz.store') }}" method="POST">
        @csrf
        <!-- Detail Kuis -->
        <label for="title">Judul Kuis:</label>
        <input type="text" name="title" id="title" placeholder="Masukkan judul kuis" required><br>

        <label for="description">Deskripsi:</label>
        <textarea name="description" id="description" placeholder="Masukkan deskripsi kuis"></textarea><br>

        <!-- Soal -->
        <div id="questions-container">
            <h3>Soal</h3>
            <div class="question" data-index="0">
                <label>Pertanyaan:</label>
                <input type="text" name="questions[0][question]" placeholder="Masukkan pertanyaan" required><br>

                <label>Tipe Soal:</label>
                <select name="questions[0][type]" class="question-type" onchange="toggleAnswerOptions(this)">
                    <option value="multiple_choice">Pilihan Ganda</option>
                    <option value="short_answer">Isian Singkat</option>
                </select><br>

                <!-- Opsi Jawaban Pilihan Ganda -->
                <div class="multiple-choice-options">
                    <label>Opsi Jawaban:</label><br>
                    <input type="text" name="questions[0][options][]" placeholder="Jawaban 1"><br>
                    <input type="text" name="questions[0][options][]" placeholder="Jawaban 2"><br>
                    <input type="text" name="questions[0][options][]" placeholder="Jawaban 3"><br>
                    <input type="text" name="questions[0][options][]" placeholder="Jawaban 4"><br>

                    <label>Jawaban Benar:</label>
                    <select name="questions[0][correct]">
                        <option value="0">Opsi 1</option>
                        <option value="1">Opsi 2</option>
                        <option value="2">Opsi 3</option>
                        <option value="3">Opsi 4</option>
                    </select><br>
                </div>

                <!-- Jawaban Isian Singkat -->
                <div class="short-answer-option" style="display: none;">
                    <label>Jawaban Benar:</label>
                    <input type="text" name="questions[0][correct_answer]" placeholder="Jawaban yang benar"><br>
                </div>

                <hr>
            </div>
        </div>

        <button type="button" onclick="addQuestion()">Tambah Soal</button><br>
        <button type="submit">Simpan Kuis</button>
    </form>

    <script>
        let questionIndex = 1;

        function addQuestion() {
            const container = document.getElementById('questions-container');
            const questionTemplate = `
                <div class="question" data-index="${questionIndex}">
                    <label>Pertanyaan:</label>
                    <input type="text" name="questions[${questionIndex}][question]" placeholder="Masukkan pertanyaan" required><br>

                    <label>Tipe Soal:</label>
                    <select name="questions[${questionIndex}][type]" class="question-type" onchange="toggleAnswerOptions(this)">
                        <option value="multiple_choice">Pilihan Ganda</option>
                        <option value="short_answer">Isian Singkat</option>
                    </select><br>

                    <!-- Opsi Jawaban Pilihan Ganda -->
                    <div class="multiple-choice-options">
                        <label>Opsi Jawaban:</label><br>
                        <input type="text" name="questions[${questionIndex}][options][]" placeholder="Jawaban 1"><br>
                        <input type="text" name="questions[${questionIndex}][options][]" placeholder="Jawaban 2"><br>
                        <input type="text" name="questions[${questionIndex}][options][]" placeholder="Jawaban 3"><br>
                        <input type="text" name="questions[${questionIndex}][options][]" placeholder="Jawaban 4"><br>

                        <label>Jawaban Benar:</label>
                        <select name="questions[${questionIndex}][correct]">
                            <option value="0">Opsi 1</option>
                            <option value="1">Opsi 2</option>
                            <option value="2">Opsi 3</option>
                            <option value="3">Opsi 4</option>
                        </select><br>
                    </div>

                    <!-- Jawaban Isian Singkat -->
                    <div class="short-answer-option" style="display: none;">
                        <label>Jawaban Benar:</label>
                        <input type="text" name="questions[${questionIndex}][correct_answer]" placeholder="Jawaban yang benar"><br>
                    </div>

                    <hr>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', questionTemplate);
            questionIndex++;
        }

        function toggleAnswerOptions(selectElement) {
            const questionDiv = selectElement.closest('.question');
            const multipleChoiceDiv = questionDiv.querySelector('.multiple-choice-options');
            const shortAnswerDiv = questionDiv.querySelector('.short-answer-option');

            if (selectElement.value === 'multiple_choice') {
                multipleChoiceDiv.style.display = '';
                shortAnswerDiv.style.display = 'none';
            } else if (selectElement.value === 'short_answer') {
                multipleChoiceDiv.style.display = 'none';
                shortAnswerDiv.style.display = '';
            }
        }
    </script>
</body>
</html>
