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
                        <div class="col-md-6">
                            <div class="card-body p-3">
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
                            </div>
                        </div>
                        <div class="col-md-6 p-3">
                            @if ($attendance==null)
                                <form action="{{ route('attendance.open', $subject->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                                    <input type="hidden" name="latitude" id="latitude">
                                    <input type="hidden" name="longitude" id="longitude">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="is_online" class="form-label">Jenis Presensi</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_online" id="is_online_online" value="1" required>
                                                    <label class="form-check-label" for="is_online_online">
                                                        Online
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_online" id="is_online_offline" value="0" required>
                                                    <label class="form-check-label" for="is_online_offline">
                                                        Offline
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 p-2">
                                                <button class="btn btn-sm w-100 btn-primary d-flex align-items-center justify-content-center">
                                                    Presensi
                                                </button>
                                                <button class="btn w-100 btn-sm btn-info d-flex align-items-center justify-content-center my-3">
                                                    Zoom
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    @else
                                        <form action="{{ route('attendance.close', $attendance->id) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="is_online" class="form-label">Jenis Presensi</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="is_online" id="is_online_online" value="1">
                                                        <label class="form-check-label" for="is_online_online">
                                                            Online
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="is_online" id="is_online_offline" value="0">
                                                        <label class="form-check-label" for="is_online_offline">
                                                            Offline
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 p-2">
                                                    <h6 class="card-title text-dark">Presensi Sudah Dibuka</h6>
                                                    <button type="submit" class="btn btn-sm w-100 btn-danger d-flex align-items-center justify-content-center">
                                                        Tutup Presensi
                                                    </button>
                                                    <button class="btn w-100 btn-sm btn-info d-flex align-items-center justify-content-center my-3">
                                                        Zoom
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                    <div class="row my-3">
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
@endsection