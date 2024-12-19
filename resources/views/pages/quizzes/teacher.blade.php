@extends('layouts.master')

@section('page_title', 'Daftar Subjects')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Subjects</h1>
    <a href="{{ route('quiz.create') }}" class="btn btn-primary">Tambah Quiz</a>
    <div class="row mt-4">
        @foreach($subjects as $subject)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $subject->name }}</h5>
                    <p class="card-text">{{ $subject->description }}</p>
                    <p>{{$subject->my_class->name}}</p>
                    <a href="{{ route('teachers.quizzes.show', $subject) }}" class="btn btn-primary">Lihat Quiz</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
