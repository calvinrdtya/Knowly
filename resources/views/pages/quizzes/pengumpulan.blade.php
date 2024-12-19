@extends('layouts.master')

@section('page_title', 'Daftar Pengumpulan ')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">Daftar Pengumpulan Tugas: Quiz</h1>
        </div>
        <div class="card-body">
            {{-- @if($submissions->isEmpty())
                <p>Tidak ada siswa yang mengumpulkan tugas ini.</p>
            @else --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Siswa</th>
                                <th>Score</th>
                                <th>Tanggal Pengumpulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $index => $submission)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $submission->user->name }}</td>
                                    <td>{{ $submission->total_score }}</td>
                                    <td>{{ \Carbon\Carbon::parse($submission->latest_submission_date)->format('d M Y, H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            {{-- @endif --}}
        </div>
    </div>
</div>
@endsection
