@extends('layouts.master')
@section('page_title', 'Daftar Quis')
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
    <a href="{{ route('quiz.create') }}" class="btn btn-primary mb-3">Buat Qiz Baru</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quizzes as $index => $quiz)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $quiz->title }}</td>
                    <td>{{ $quiz->description }}</td>
                    <td>{{ $quiz->subject->name }}</td>
                    <td>{{ $quiz->myClass->name }}</td>
                    <td>
                        <a href="{{ route('quiz.submissions', $quiz->id) }}" class="btn btn-warning">Lihat Pengumpulan</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
