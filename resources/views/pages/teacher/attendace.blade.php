@extends('layouts.master')
@section('page_title', 'My Classes')

@section('content')
    <h2>WELCOME {{ Auth::user()->name }}. This is your TEACHER DASHBOARD</h2>
    <div class="container my-4">
        <div class="row g-4">

            <!-- Informasi Mata Pelajaran -->
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h3>{{$subject->name}}</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th>Kode Mata Pelajaran</th>
                                <td>: {{$subject->code}}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Peserta</th>
                                <td>: {{ $students->count() }}</td>
                            </tr>
                            <tr>
                                <th>Presensi terakhir</th>
                                <td>: {{ $lastAttendance ? $lastAttendance->date->format('l, d F Y - H:i:s') : 'Belum ada' }}</td>
                            </tr>
                        </table>
                        <div class="d-grid gap-2">
                            <form action="{{ route('attendance.open', $subject->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Buka Presensi</button>
                            </form>
                            <button class="btn btn-outline-danger">Aturan Presensi</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- History Presensi -->
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Riwayat Presensi</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($attendances as $attendance)
                                    <tr>
                                        <td>{{ $attendance->id }}</td>
                                        <td>{{ $attendance->date->format('l, d F Y - H:i:s') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">Belum ada data presensi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peserta Kuliah -->
        <div class="card shadow mt-4">
            <div class="card-header">
                <h5>Peserta Kuliah</h5>
            </div>
            <div class="card-body">
                <div class="row align-items-center mb-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Cari...">
                    </div>
                    <div class="col-md-6 text-end">
                        <table class="table table-borderless">
                            <tr>
                                <th>Laki-laki</th>
                                <td>: {{ $maleStudents }}</td>
                            </tr>
                            <tr>
                                <th>Perempuan</th>
                                <td>: {{ $femaleStudents }}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>: {{ $students->count() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>NRP</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $student->nrp }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->gender == 'M' ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Belum ada peserta kuliah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection