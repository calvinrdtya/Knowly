@extends('layouts.master')

@section('page_title', 'Detail Tugas')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3>Detail Tugas</h3>
        </div>
        <div class="card-body">
            <!-- Judul Tugas -->
            <div class="mb-3">
                <h5 class="card-title">Judul</h5>
                <p class="card-text">{{ $assignment->title }}</p>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <h5 class="card-title">Deskripsi</h5>
                <p class="card-text">{{ $assignment->description ?? 'Tidak ada deskripsi.' }}</p>
            </div>

            <!-- Batas Waktu -->
            <div class="mb-3">
                <h5 class="card-title">Batas Waktu</h5>
                <p class="card-text">{{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y, H:i') }}</p>
            </div>

            <!-- Kelas -->
            <div class="mb-3">
                <h5 class="card-title">Kelas</h5>
                <p class="card-text">{{ $assignment->class->name }}</p>
            </div>

            <!-- Mata Pelajaran -->
            <div class="mb-3">
                <h5 class="card-title">Mata Pelajaran</h5>
                <p class="card-text">{{ $assignment->subject->name }}</p>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-end">
                <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-warning me-2">Edit</a>
                <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
