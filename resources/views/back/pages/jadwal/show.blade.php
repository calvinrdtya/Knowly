@extends('layouts.apps')

@section('content')

<section>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                @include('back.layouts.aside')
            </aside>
            <!-- Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    @include('back.layouts.nav')
                </nav>
                <!-- / Navbar -->
    
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold">Jadwal Pelajaran</h4>
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card border-1 my-4">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between my-3">
                                    <h5 class="card-title text-dark">{{ $kelas->name }}</h5>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-sm btn-primary me-3" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                            Buat Jadwal
                                        </button>      
                                    </div>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    @if($schedules->isEmpty())
                                        <p class="text-center mt-3 mb-0">Jadwal Belum dibuat</p>
                                    @else
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Mata Pelajaran</th>
                                                    <th>Guru</th>
                                                    <th>Hari</th>
                                                    <th>Waktu</th>
                                                    <th>Ruang</th>
                                                    {{-- <th>Aksi</th> --}}
                                                </tr>
                                            </thead>
                                            @foreach ($schedules as $schedule)
                                                <tbody class="table-border-bottom-0">
                                                    <tr>
                                                        <td>{{ $schedule->subject->name }}</td>
                                                        <td>{{ $schedule->teacher->name }}</td>
                                                        <td>{{ $schedule->hari }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($schedule->jam_mulai)->isoFormat('HH:mm') }} - {{ \Carbon\Carbon::parse($schedule->jam_selesai)->isoFormat('HH:mm') }}</td>
                                                        <td>{{ $schedule->room}}</td>
                                                        {{-- <td>
                                                            <a href="{{ route('jadwal.edit', $schedule->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                                            <form action="{{ route('jadwal.destroy', $schedule->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                            </form>
                                                        </td> --}}
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                        </table>
                                    @endif
                                </div>                                   
                                <hr class="my-4">
                            </div>
                        </div>
                    <div class="content-backdrop fade"></div>
                    </div> 
                    <!-- Content wrapper -->
                </div>
            <!-- / Layout page -->
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Buat Jadwal Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf
                    <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                    <input type="hidden" name="class_id" value="{{ $subject->my_class_id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group my-2">
                            <label for="room_id">Ruangan</label>
                            <input type="text" name="room" class="form-control" placeholder="Misalkan A.101">
                        </div>
                        <div class="form-group my-2">
                            <label for="teacher_id">Pilih Guru</label>
                            <select id="teacher_id" class="form-control" name="teacher_id">
                                <option value="">Pilih Guru</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group my-2">
                            <label for="day">Hari</label>
                            <select name="day" id="day" class="form-control">
                                <option value="">Pilih Hari</option>
                                @foreach($days as $day)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group my-2">
                            <label for="start_time">Waktu Mulai</label>
                            <input type="time" name="start_time" class="form-control">
                        </div>
                        <div class="form-group my-2">
                            <label for="end_time">Waktu Selesai</label>
                            <input type="time" name="end_time" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection