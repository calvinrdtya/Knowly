@extends('layouts.master')
@section('page_title', 'Daftar Tugas')
@section('content')
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
    <h1>Daftar Tugas</h1>
    <a href="{{ route('assignments.create') }}" class="btn btn-primary mb-3">Buat Tugas Baru</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
                <th>Batas Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assignments as $index => $assignment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $assignment->title }}</td>
                    <td>{{ $assignment->subject->name }}</td>
                    <td>{{ $assignment->class->name }}</td>
                    <td>{{ $assignment->due_date }}</td>
                    <td>
                        <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('assignments.submissions', $assignment->id) }}" class="btn btn-warning">Lihat Pengumpulan</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
