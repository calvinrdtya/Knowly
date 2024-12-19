@extends('layouts.apps')

@section('content')

<section>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                @include('teacher.layouts.aside')
            </aside>
            <!-- Menu -->
    
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    @include('teacher.layouts.nav')
                </nav>
                <!-- / Navbar -->
    
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
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
                        <div class="card p-4">
                            <div class="row">
                                <div class="card-title">
                                    <h4 class="card-title text-dark mb-">{{ $subject->name }}</h4>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-md-3 d-flex justify-content-start align-items-center">
                                                <h6 class="card-title text-dark mb-0">NIP</h6>
                                            </div>
                                            <div class="col-md-9 d-flex justify-content-start">
                                                <p class="mb-0">: 197505302003121001</p>
                                            </div>
                                            <div class="col-md-3 d-flex justify-content-start mt-3 align-items-center">
                                                <h6 class="card-title text-dark mb-0">Nama Guru</h6>
                                            </div>
                                            <div class="col-md-9 d-flex justify-content-start mt-3 align-items-center">
                                                <p class="mb-0">: {{ optional($subject->teacher)->name }}</p>
                                            </div>
                                            <div class="col-md-3 d-flex justify-content-start mt-3 align-items-center">
                                                <h6 class="card-title text-dark mb-0">Jadwal</h6>
                                            </div>
                                            <div class="col-md-9 d-flex justify-content-start mt-3">
                                                @php
                                                    $days = [
                                                        1 => 'Senin',
                                                        2 => 'Selasa',
                                                        3 => 'Rabu',
                                                        4 => 'Kamis',
                                                        5 => 'Jumat',
                                                        6 => 'Sabtu',
                                                        7 => 'Minggu',
                                                    ];
                                                    $dayName = $days[$subject->hari] ?? 'Unknown';
                                                @endphp
                                                <p class="mb-0">: {{ $dayName }}, {{ \Carbon\Carbon::parse($subject->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($subject->jam_selesai)->format('H:i') }}</p>
                                            </div>
                                        </div>       
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-md-4 d-flex justify-content-start align-items-center">
                                                <h6 class="card-title text-dark mb-0">Laki-Laki</h6>
                                            </div>
                                            <div class="col-md-8 d-flex justify-content-start">
                                                <p class="mb-0">: {{ $totalMale }}</p>
                                            </div>
                                            <div class="col-md-4 d-flex justify-content-start mt-3 align-items-center">
                                                <h6 class="card-title text-dark mb-0">Perempuan</h6>
                                            </div>
                                            <div class="col-md-8 d-flex justify-content-start mt-3 align-items-center">
                                                <p class="mb-0">: {{ $totalFemale }}</p>
                                            </div>
                                            <div class="col-md-4 d-flex justify-content-start mt-3 align-items-center">
                                                <h6 class="card-title text-dark mb-0">Total</h6>
                                            </div>
                                            <div class="col-md-8 d-flex justify-content-start mt-3 align-items-center">
                                                <p class="mb-0">: {{ $students->count() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="card border-1 mt-4">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center justify-content-between my-3">
                                            <h5 class="card-title text-dark mb-0">Daftar Siswa</h5>
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                                    Buat Tugas
                                                </button>      
                                            </div>
                                        </div>
                                        <div class="table-responsive text-nowrap">
                                            @if($students->isEmpty())
                                                <p>Belum ada siswa yang mengumpulkan</p>
                                            @else
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Absen</th>
                                                            <th>Nama</th>
                                                            <th>Kelas</th>
                                                            <th>Presensi</th>
                                                        </tr>
                                                    </thead>
                                                    @foreach ($students as $student)
                                                        <tbody class="table-border-bottom-0">
                                                            <tr>
                                                                <td>{{ $student->absen }}</td>
                                                                <td>{{ $student->name }}</td>
                                                                <td>{{ $student->gender }}</td>
                                                                <td>{{ $student->gender }}</td>
                                                            </tr>
                                                        </tbody>
                                                    @endforeach
                                                </table>
                                            @endif
                                        </div>                                   
                                        <hr class="my-4">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                @forelse($assignments as $assignment)
                                    <div class="card border-1 my-4">
                                        <div class="card-body p-3">
                                            <div class="card-title">
                                                <h5 class="card-title text-dark mb-4">{{ $assignment->title }}</h5>
                                                <p class="mb-4">{{ $assignment->description }}</p>
                                            </div>
                                            <div class="mt-3">
                                                @php
                                                    $myClass = \App\Models\MyClass::find($subject->my_class_id);
                                                @endphp
                                                <p class="mb-2">Kelas : {{ $myClass ? $myClass->name : 'Kelas Tidak Ditemukan' }}</p>
                                                <p class="mb-2">Deadline : {{ \Carbon\Carbon::parse($assignment->due_date)->isoFormat('dddd, D MMMM YYYY - HH:mm') }}</p>
                                            </div>
                                            <hr class="my-3">
                                            <div class="d-flex justify-content-end">
                                                {{-- <a href="" class="btn btn-sm btn-outline-danger d-flex align-items-center">
                                                    Hapus Tugas 
                                                </a>                                                                                         --}}
                                                <a href="{{ route('teacher.assignments.show', $assignment->subject_id) }}" class="btn btn-sm btn-outline-primary d-flex align-items-center ms-2">
                                                    Detail Tugas <i class='bx bx-right-arrow-alt ms-2'></i>
                                                </a>                                                                                        
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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

<script>
    navigator.geolocation.getCurrentPosition(function(position) {
        document.getElementById('latitude').value = position.coords.latitude;
        document.getElementById('longitude').value = position.coords.longitude;
    });
</script>

<!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Buat Tugas Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('assignments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="class_id" value="{{ $subject->my_class_id }}">
                    <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                
                    <div class="modal-body">
                        <div class="row">
                            <div class="my-1">
                                <label for="defaultFormControlInput" class="form-label">Judul</label>
                                <input type="text" name="title" class="form-control" id="defaultFormControlInput" placeholder="masukkan judul tugas" required/>
                            </div>
                            <div class="my-1">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control" rows="3" placeholder="masukkan deskripsi tugas" required></textarea>
                            </div>
                            <div class="my-1">
                                <label for="due_date" class="form-label">Deadline</label>
                                <input type="datetime-local" name="due_date" id="due_date" class="form-control" required>
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