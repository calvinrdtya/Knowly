@extends('layouts.master')

@section('page_title', 'Buat Kuis Baru')

@section('content')
    <section>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Sidebar -->
                <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme"></aside>

                <!-- Main Content -->
                <div class="layout-page">
                    <!-- Navbar -->
                    <nav
                        class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme">
                    </nav>

                    <!-- Content -->
                    <div class="content-wrapper">
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="d-flex align-items-center justify-content-center">
                                <!-- Card Wrapper -->
                                <div class="card w-50 p-4">
                                    <div class="card-body">
                                        <!-- Title -->
                                        <h4 class="card-title text-dark mb-4">Buat Kuis Baru</h4>

                                        <!-- Form Start -->
                                        <form action="{{ route('quiz.store') }}" method="POST">
                                            @csrf
                                            <div class="my-3">
                                                <label for="title" class="form-label">Judul Kuis</label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    placeholder="Masukkan judul kuis" required>
                                            </div>

                                            <!-- Deskripsi -->
                                            <div class="my-3">
                                                <label for="description" class="form-label">Deskripsi</label>
                                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Masukkan deskripsi kuis"
                                                    required></textarea>
                                            </div>
                                            <!-- Dropdown Kelas -->
                                            <div class="mb-3">
                                                <label for="class_id" class="form-label">Kelas</label>
                                                <select class="form-control" name="class_id" id="class_id"
                                                    class="form-select" required>
                                                    <option value="">-- Pilih Kelas --</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Dropdown Mata Pelajaran -->
                                            <div class="mb-3">
                                                <label for="subject_id" class="form-label">Mata Pelajaran</label>
                                                <select class="form-control" name="subject_id" id="subject_id"
                                                    class="form-select" disabled required>
                                                    <option value="">-- Pilih Mata Pelajaran --</option>
                                                </select>
                                            </div>

                                            <!-- Judul Kuis -->
                                            

                                            <!-- Container Pertanyaan -->
                                            <div id="questions-container" class="mb-4">
                                                <h5 class="text-secondary">Pertanyaan</h5>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">Simpan Kuis</button>
                                            </div>
                                        </form>
                                        <!-- Add Question Button -->
                                        <div class="text-center mt-4">
                                            <button type="button" class="btn btn-primary btn-lg" id="add-question">Tambah
                                                Pertanyaan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-backdrop fade"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        let questionIndex = 0;

        document.getElementById('add-question').addEventListener('click', function() {
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

        document.addEventListener('change', function(e) {
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

        const classDropdown = document.getElementById('class_id');
        const subjectDropdown = document.getElementById('subject_id');

        classDropdown.addEventListener('change', function() {
            const classId = this.value;

            // Reset dropdown mata pelajaran
            subjectDropdown.innerHTML = '<option value="">-- Pilih Mata Pelajaran --</option>';
            subjectDropdown.disabled = true;

            if (classId) {
                // Fetch data mata pelajaran berdasarkan kelas
                fetch(`/get-subjects-by-class?class_id=${classId}`)
                    .then(response => response.json())
                    .then(subjects => {
                        if (subjects.length > 0) {
                            subjects.forEach(subject => {
                                const option = document.createElement('option');
                                option.value = subject.id;
                                option.textContent = subject.name;
                                subjectDropdown.appendChild(option);
                            });
                            subjectDropdown.disabled = false;
                        } else {
                            alert('Tidak ada mata pelajaran untuk kelas yang dipilih.');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching subjects:', error);
                        alert('Terjadi kesalahan saat mengambil data mata pelajaran.');
                    });
            }
        });
    </script>
@endsection
