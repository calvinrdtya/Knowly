
@extends('layouts.master')

@section('content')
<div class="container">
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
    <h1 class="mb-4">Daftar Tugas</h1>
    <div class="row">
        @forelse($assignments as $assignment)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $assignment->title }}</h5>
                        <p class="card-text text-muted">
                            <strong>Deskripsi:</strong> {{ substr($assignment->description, 0, 100) . '...' }}
                        </p>
                        <p class="card-text">
                            <strong>Batas Waktu:</strong> 
                            {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y, H:i') }}
                        </p>
                        <p class="card-text">
                            <strong>Status:</strong> 
                            @php
                                $submission = $assignment->submissions->where('student_id', auth()->id())->first();
                            @endphp
                            @if ($submission)
                                <span class="text-success">Sudah Dikumpulkan</span> pada 
                                {{ \Carbon\Carbon::parse($submission->created_at)->format('d M Y, H:i') }}
                            @else
                                <span class="text-danger">Belum Dikumpulkan</span>
                            @endif
                        </p>
                        <a href="{{ route('student.assignments.show', $assignment->id) }}" class="btn btn-primary">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Tidak ada tugas yang tersedia saat ini.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
