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
    
                <!-- Content wrapper -->
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card p-4">
                        <div class="card mb-2 shadow-none">
                            <h5 class="card-header">Buat Tugas Baru</h5>
                            <form action="{{ route('assignments.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="my-3">
                                                <label for="defaultFormControlInput" class="form-label">Judul</label>
                                                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="John Doe"/>
                                            </div>
                                            <div class="my-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Masukkan deskripsi tugas"></textarea>
                                            </div>
                                            <div class="my-3">
                                                <label for="due_date" class="form-label">Deadline</label>
                                                <input type="datetime-local" name="due_date" id="due_date" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="my-3">
                                                <label for="class_id" class="form-label">Kelas</label>
                                                <select class="form-control" name="class_id" id="class_id" class="form-select" required>
                                                    <option value="">Pilih Kelas</option>
                                                    @foreach($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="my-3">
                                                <label for="subject_id" class="form-label">Mata Pelajaran</label>
                                                <select class="form-control" name="subject_id" id="subject_id" class="form-select" disabled required>
                                                    <option value="">Pilih Mata Pelajaran</option>
                                                </select>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-end">
                                                <button type="submit" class="btn btn-primary">Buat Tugas</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
    const classDropdown = document.getElementById('class_id');
    const subjectDropdown = document.getElementById('subject_id');

    classDropdown.addEventListener('change', function () {
        const classId = this.value;

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