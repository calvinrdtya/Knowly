@extends('layouts.master')

@section('page_title', 'Buat Tugas Baru')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Buat Tugas Baru</h1>
    <form action="{{ route('assignments.store') }}" method="POST" class="card shadow p-4">
        @csrf

        <!-- Judul -->
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Masukkan judul tugas" required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Masukkan deskripsi tugas"></textarea>
        </div>

        <!-- Batas Waktu -->
        <div class="mb-3">
            <label for="due_date" class="form-label">Batas Waktu</label>
            <input type="datetime-local" name="due_date" id="due_date" class="form-control" required>
        </div>

        <!-- Dropdown Kelas -->
        <div class="mb-3">
            <label for="class_id" class="form-label">Kelas</label>
            <select class="form-control" name="class_id" id="class_id" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown Mata Pelajaran -->
        <div class="mb-3">
            <label for="subject_id" class="form-label">Mata Pelajaran</label>
            <select class="form-control" name="subject_id" id="subject_id" class="form-select" disabled required>
                <option value="">-- Pilih Mata Pelajaran --</option>
            </select>
        </div>

        <!-- Tombol Simpan -->
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<!-- Script Dinamis -->
<script>
    const classDropdown = document.getElementById('class_id');
    const subjectDropdown = document.getElementById('subject_id');

    classDropdown.addEventListener('change', function () {
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
