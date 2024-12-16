@extends('layouts.apps')

@section('content')

<section>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                @include('student.layouts.aside')
            </aside>
            <!-- Menu -->
    
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    @include('student.layouts.nav')
                </nav>
                <!-- / Navbar -->
    
                <!-- Content wrapper -->
                <div class="content-wrapper">
                <!-- Content -->
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
                        <div class="row my-0">
                            <div class="col-md-6">
                                <div class="card card-hov border-1 mb-3" style="height: auto; position: relative;">
                                    <div class="card-body p-3">
                                        <div class="card-title">
                                            <h4 class="card-title text-dark mb-5">{{ $subject->name }}</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 d-flex justify-content-start align-items-center">
                                                <h6 class="card-title text-dark mb-0">NIP</h6>
                                            </div>
                                            <div class="col-md-8 d-flex justify-content-start">
                                                <p class="mb-0">: 197505302003121001</p>
                                            </div>
                                            <div class="col-md-4 d-flex justify-content-start mt-3 align-items-center">
                                                <h6 class="card-title text-dark mb-0">Nama Guru</h6>
                                            </div>
                                            <div class="col-md-8 d-flex justify-content-start mt-3 align-items-center">
                                                <p class="mb-0">: {{ optional($subject->teacher)->name }}</p>
                                            </div>
                                        
                                            <div class="col-md-4 d-flex justify-content-start mt-3 align-items-center">
                                                <h6 class="card-title text-dark mb-0">Jadwal</h6>
                                            </div>
                                            <div class="col-md-8 d-flex justify-content-start mt-3">
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
                                            <div class="col-md-4 d-flex justify-content-start mt-5 align-items-center">
                                                <h6 class="card-title text-dark mb-0">Presensi Guru Terakhir</h6>
                                            </div>
                                            <div class="col-md-8 d-flex justify-content-start mt-5">
                                                <p class="mb-0">: {{ \Carbon\Carbon::parse($subject->created_at)->isoFormat('dddd, D MMMM YYYY - HH:mm:ss') }}</p>
                                            </div>
                                        </div>       
                                        <hr class="my-4">
                                        <form action="{{ route('attendance.mark', $subject->id) }}" method="POST">
                                        @csrf
                                            <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @if (!$attendance)
                                                        <button class="btn btn-sm w-100 btn-secondary d-flex align-items-center justify-content-center" disabled>
                                                            Presensi
                                                        </button>                                                    
                                                    @elseif (!$attendance->is_open)
                                                        <button class="btn btn-sm w-100 btn-secondary d-flex align-items-center justify-content-center" disabled>
                                                            Presensi
                                                        </button>
                                                    @elseif (!$attendance->is_online)
                                                        <button class="btn btn-sm w-100 btn-warning d-flex align-items-center justify-content-center">
                                                            Presensi
                                                        </button>
                                                    @else
                                                        <button class="btn btn-sm w-100 btn-primary d-flex align-items-center justify-content-center">
                                                            Presensi
                                                        </button>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="" class="btn btn-sm btn-info d-flex align-items-center justify-content-center">
                                                        Zoom
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                        {{-- <div class="d-flex justify-content-center mt-3">
                                            <a href="" class="btn btn-sm btn-warning d-flex align-items-center justify-content-center">
                                                Aturan Presensi
                                            </a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>   
                            <div class="col-md-6">
                                <h5 class="card-title text-dark">Riwayat Presensi</h5>
                                <div class="card card-hov border-1 mb-3" style="height: auto; position: relative;">
                                    <div class="card-body p-3">
                                        <div class="table-responsive" style="max-height: 290px; overflow-y: auto;">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Tanggal</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($history as $history )
                                                    <tbody class="table-border-bottom-0">
                                                        <tr>
                                                            <td>{{ $history->id }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($history->created_at)->locale('id')->translatedFormat('l, d F Y - H:i:s') }}</td>
                                                        </tr>
                                                    </tbody>
                                                @endforeach
                                            </table>
                                        </div>                                                               
                                    </div>
                                </div>
                                
                            </div>                            
                        </div>  
                        <div class="card border-1 my-4" style="height: auto; position: relative;">
                            <div class="card-body p-3">
                                <div class="card-title row">
                                    <div class="col-md-9">
                                        <h5 class="card-title text-dark mb-4">Peserta Pembelajaran</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-5 d-flex align-items-center">
                                                <h6 class="card-title text-dark mb-0">Laki-Laki</h6>
                                            </div>
                                            <div class="col-md-4">
                                                : {{ $totalMale }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 d-flex align-items-center">
                                                <h6 class="card-title text-dark mb-0">Perempuan</h6>
                                            </div>
                                            <div class="col-md-4">
                                                : {{ $totalFemale }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 d-flex align-items-center">
                                                <h6 class="card-title text-dark mb-0">Total</h6>
                                            </div>
                                            <div class="col-md-4">
                                                : {{ $students->count() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    @if($students->isEmpty())
                                        <p>Data Siswa Tidak Ada</p>
                                    @else
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Absen</th>
                                                    <th>Nama</th>
                                                    <th>Jenis Kelamin</th>
                                                </tr>
                                            </thead>
                                            @foreach ($students as $student)
                                                <tbody class="table-border-bottom-0">
                                                    <tr>
                                                        <td>{{ $student->absen }}</td>
                                                        <td>{{ $student->name }}</td>
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
@endsection