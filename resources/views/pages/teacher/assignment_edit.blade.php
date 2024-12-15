@extends('layouts.master')

@section('page_title', 'Edit Tugas')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3>Edit Tugas</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('assignments.update', $assignment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $assignment->title }}" required>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ $assignment->description }}</textarea>
                </div>

                <!-- Batas Waktu -->
                <div class="mb-3">
                    <label for="due_date" class="form-label">Batas Waktu</label>
                    <input type="datetime-local" name="due_date" id="due_date" class="form-control" value="{{ \Carbon\Carbon::parse($assignment->due_date)->format('Y-m-d\TH:i') }}" required>
                </div>

                <!-- Dropdown Kelas -->
                <div class="mb-3">
                    <label for="class_id" class="form-label">Kelas</label>
                    <select name="class_id" id="class_id" class="form-select" required>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ $assignment->class_id == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Dropdown Mata Pelajaran -->
                <div class="mb-3">
                    <label for="subject_id" class="form-label">Mata Pelajaran</label>
                    <select name="subject_id" id="subject_id" class="form-select" required>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ $assignment->subject_id == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Simpan -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const classDropdown = document.getElementById('class_id');
    const subjectDropdown = document.getElementById('subject_id');

    classDropdown.addEventListener('change', function () {
        const classId = this.value;

        subjectDropdown.innerHTML = '<option value="">-- Pilih Mata Pelajaran --</option>';
        subjectDropdown.disabled = true;

        if (classId) {
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
