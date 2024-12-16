@extends('layouts.apps')

@section('content')

<section>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                @include('teacher.layouts.aside')
            </aside>
            <!-- Menu -->
    
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    @include('teacher.layouts.nav')
                </nav>
                <!-- / Navbar -->
    
                <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">

                    <div class="d-flex align-items-center justify-content-center">
                        <div class="card w-50 p-5">
                            <div class="card-title">
                                <h4 class="card-title text-dark mb-0">Buat Kuiz</h4>
                            </div>
                            <form action="{{ route('quiz.store') }}" method="POST">
                                @csrf
                                <div class="card-body p-1">
                                    <div class="my-3">
                                        <label for="title" class="form-label">Judul Kuis</label>
                                        <input type="text" id="title" name="title" class="form-control" placeholder="masukkan judul kuis" required>
                                    </div>
                                    <div class="my-3">
                                        <label for="description" class="form-label">Deskripsi <span>(opsional)</span></label>
                                        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                                    </div>
                                    <div id="questions-container"></div>
                                    <div class="my-3 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-info" id="add-question">Tambah Pertanyaan</button>
                                        <button type="submit" class="btn btn-sm btn-primary ms-2">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>                        
                    </div>
                    <!-- / Content -->
        
                <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
          <!-- / Layout page -->
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
</section>

<script>
    let questionIndex = 0;

document.getElementById('add-question').addEventListener('click', function () {
    const container = document.getElementById('questions-container');

    const questionHtml = `
        <div class="question-item mb-4">
            <h5>Pertanyaan ${questionIndex + 1}</h5>
            <div class="mb-3">
                <label for="questions[${questionIndex}][question]" class="form-label">Pertanyaan</label>
                <input type="text" class="form-control" name="questions[${questionIndex}][question]" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tipe Pertanyaan</label>
                <select class="form-select question-type" name="questions[${questionIndex}][type]" data-index="${questionIndex}" required>
                    <option value="multiple_choice">Multiple Choice</option>
                    <option value="short_answer">Short Answer</option>
                </select>
            </div>
            <div class="answers-container" id="answers-container-${questionIndex}">
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
                    <label class="form-label">Jawaban Benar</label>
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