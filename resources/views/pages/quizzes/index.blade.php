@extends('layouts.master')

@section('page_title', 'Daftar Kuis')

@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Daftar Kuis</h1>
        </div>
    </div>

    <div class="row">
        @foreach($quizzes as $quiz)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $quiz->title }}</h5>
                        <p class="card-text">{{ $quiz->description }}</p>
                        <a href="{{ route('quizzes.show', $quiz) }}" class="btn btn-primary w-100">Mulai Kuis</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($quizzes->isEmpty())
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info text-center" role="alert">
                    Belum ada kuis yang tersedia.
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
