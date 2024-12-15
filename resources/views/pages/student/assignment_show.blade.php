@extends('layouts.master')

@section('page_title', 'Tugas - '.$assignment->title)

@section('content')
<div class="container mt-4">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        
    @endif
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">{{ $assignment->title }}</h1>
        </div>
        <div class="card-body">
            <p class="mb-3"><strong>Deskripsi:</strong> {{ $assignment->description }}</p>
            <p class="mb-3 text-danger"><strong>Batas Waktu:</strong> 
                {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y, H:i') }}
            </p>

            <form action="{{ $isSubmitted ? route('student.assignments.update', $submission->id) : route('student.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @if ($isSubmitted)
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="notes" class="form-label"><strong>Catatan</strong></label>
                    <textarea 
                        name="notes" 
                        id="notes" 
                        class="form-control" 
                        rows="4" 
                        placeholder="Tambahkan catatan untuk tugas ini..." 
                        {{ $isSubmitted && !$isEditing ? 'disabled' : '' }}
                        required
                    >{{ $isSubmitted ? $submission->notes : '' }}</textarea>
                    <div class="invalid-feedback">
                        Catatan tidak boleh kosong.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label"><strong>Lampiran</strong> (opsional)</label>
                    <input 
                        type="file" 
                        name="file" 
                        id="file" 
                        class="form-control" 
                        {{ $isSubmitted && !$isEditing ? 'disabled' : '' }}
                    >
                    @if ($isSubmitted && $submission->file)
                        <p class="mt-2">Lampiran saat ini: 
                            <a href="{{ asset('storage/' . $submission->file) }}" target="_blank">Download</a>
                        </p>
                    @endif
                </div>

                @if ($isSubmitted)
                    @if ($isEditing)
                        <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                    @else
                        <a href="{{ route('student.assignments.edit', $submission->id) }}" class="btn btn-warning w-100">Edit Tugas</a>
                    @endif
                @else
                    <button type="submit" class="btn btn-success w-100">Kumpulkan Tugas</button>
                @endif
            </form>
        </div>
    </div>
</div>

<script>
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
    })();
</script>
@endsection
