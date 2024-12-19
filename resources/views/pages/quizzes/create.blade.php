@extends('layouts.master')

@section('page_title', 'Buat Kuis Baru')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Buat Kuis Baru</h1>
        <form action="{{ route('quiz.store') }}" method="POST">
            @csrf

<<<<<<< HEAD
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
                </select>

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
=======
            <!-- Informasi Umum -->
            <div class="mb-3">
                <label for="title" class="form-label">Judul Kuis</label>
                <input type="text" class="form-control" id="title" name="title" required>
>>>>>>> 63c74110c599f77ca817e6105181777e5c647940
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <!-- Daftar Pertanyaan -->
            <div id="questions-container">
                <h4>Pertanyaan</h4>
            </div>
            <button type="button" id="add-question" class="btn btn-secondary mb-4">Tambah Pertanyaan</button>

            <button type="submit" class="btn btn-primary">Simpan Kuis</button>
        </form>
    </div>

    <script>
        let questionIndex = 0;

        document.getElementById('add-question').addEventListener('click', function () {
            const container = document.getElementById('questions-container');

            const questionHtml = `
                <div class="question-item mb-4 border p-3 rounded">
                    <h5>Pertanyaan ${questionIndex + 1}</h5>
                    <div class="mb-3">
                        <label for="questions[${questionIndex}][question]" class="form-label">Pertanyaan</label>
                        <input type="text" class="form-control" name="questions[${questionIndex}][question]" required>
                    </div>

                    <div class="mb-3">
                        <label for="questions[${questionIndex}][type]" class="form-label">Tipe Pertanyaan</label>
                        <select class="form-select question-type" name="questions[${questionIndex}][type]" data-index="${questionIndex}" required>
                            <option value="multiple_choice">Multiple Choice</option>
                            <option value="short_answer">Short Answer</option>
                        </select>
                    </div>

                    <div class="answers-container" id="answers-container-${questionIndex}">
                        <!-- Default: Multiple Choice -->
                        <div class="mb-3">
                            <label class="form-label">Jawaban</label>
                            <div>
                                <input type="text" class="form-control mb-2" name="questions[${questionIndex}][answers][0][answer]" placeholder="Jawaban 1" required>
                                <input type="text" class="form-control mb-2" name="questions[${questionIndex}][answers][1][answer]" placeholder="Jawaban 2" required>
                                <input type="text" class="form-control mb-2" name="questions[${questionIndex}][answers][2][answer]" placeholder="Jawaban 3" required>
                                <input type="text" class="form-control mb-2" name="questions[${questionIndex}][answers][3][answer]" placeholder="Jawaban 4" required>
                            </div>
                            <label for="questions[${questionIndex}][correct_answer]" class="form-label">Jawaban Benar</label>
                            <select class="form-select" name="questions[${questionIndex}][correct_answer]" required>
                                <option value="0">Jawaban 1</option>
                                <option value="1">Jawaban 2</option>
                                <option value="2">Jawaban 3</option>
                                <option value="3">Jawaban 4</option>
                            </select>
                        </div>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', questionHtml);
            questionIndex++;
        });

        document.addEventListener('change', function (e) {
            if (e.target.classList.contains('question-type')) {
                const index = e.target.dataset.index;
                const container = document.getElementById(`answers-container-${index}`);
                if (e.target.value === 'short_answer') {
                    container.innerHTML = `
                        <div class="mb-3">
                            <label class="form-label">Jawaban Singkat</label>
                            <input type="text" class="form-control" name="questions[${index}][answers][0][answer]" placeholder="Jawaban Singkat" required>
                        </div>
                    `;
                } else {
                    container.innerHTML = `
                        <div class="mb-3">
                            <label class="form-label">Jawaban</label>
                            <div>
                                <input type="text" class="form-control mb-2" name="questions[${index}][answers][0][answer]" placeholder="Jawaban 1" required>
                                <input type="text" class="form-control mb-2" name="questions[${index}][answers][1][answer]" placeholder="Jawaban 2" required>
                                <input type="text" class="form-control mb-2" name="questions[${index}][answers][2][answer]" placeholder="Jawaban 3" required>
                                <input type="text" class="form-control mb-2" name="questions[${index}][answers][3][answer]" placeholder="Jawaban 4" required>
                            </div>
                            <label for="questions[${index}][correct_answer]" class="form-label">Jawaban Benar</label>
                            <select class="form-select" name="questions[${index}][correct_answer]" required>
                                <option value="0">Jawaban 1</option>
                                <option value="1">Jawaban 2</option>
                                <option value="2">Jawaban 3</option>
                                <option value="3">Jawaban 4</option>
                            </select>
                        </div>
                    `;
                }
            }
        });
    </script>
@endsection
