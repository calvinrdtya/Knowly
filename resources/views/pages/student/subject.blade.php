@extends('layouts.master')
@section('page_title', 'My Subjects')

@section('content')
    <h2>WELCOME {{ Auth::user()->name }}. This is your SUBJECTS</h2>
    <div class="container">
        <div class="row">
            @foreach ($subjects as $subject)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $subject->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $subject->teacher->name }}</h6>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="badge bg-primary text-white" style="border-radius: 6px;">
                            {{ strtoupper(substr($subject->name, 0, 3)) }}
                        </div>
                        <a href="{{ route('student.subject.access', $subject->slug) }}" class="btn btn-link text-decoration-none">
                            Akses Kuliah <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endsection