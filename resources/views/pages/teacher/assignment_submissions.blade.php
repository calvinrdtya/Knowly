@extends('layouts.master')

@section('page_title', 'Daftar Pengumpulan Tugas - ' . $assignment->title)

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">Daftar Pengumpulan Tugas: {{ $assignment->title }}</h1>
        </div>
        <div class="card-body">
            @if($submissions->isEmpty())
                <p>Tidak ada siswa yang mengumpulkan tugas ini.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Siswa</th>
                                <th>Catatan</th>
                                <th>Lampiran</th>
                                <th>Tanggal Pengumpulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($submissions as $index => $submission)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $submission->student->name }}</td>
                                    <td>{{ $submission->notes }}</td>
                                    <td>
                                        @if($submission->file_path)
                                            <a href="{{ asset($submission->file_path) }}" target="_blank">Lihat Lampiran</a>
                                        @else
                                            Tidak ada lampiran
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($submission->created_at)->format('d M Y, H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
