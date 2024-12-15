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
                    <div class="card mb-4">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <label for="hari" class="col-md-3 col-form-label">Tahun Ajaran<span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-select" id="hari" name="hari" aria-label="Default select example" required>
                                                <option selected>Tahun Ajaran</option>
                                                <option value="1">2024/2025</option>
                                                <option value="1">2023/2024</option>
                                                <option value="1">2022/2023</option>
                                                <option value="1">2021/2022</option>
                                                <option value="1">2020/2021</option>
                                            </select>
                                            @error('hari')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <label for="hari" class="col-md-2 col-form-label">Semester<span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-select" id="hari" name="hari" aria-label="Default select example" required>
                                                <option selected>Semester</option>
                                                <option value="1">Ganjil</option>
                                                <option value="1">Genap</option>
                                            </select>
                                            @error('hari')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($subjects as $subject)
                            <div class="col-lg-4 col-md-12 col-6 mb-4">
                                <div class="card" style="height: 100%; position: relative;">
                                    <div class="card-body" style="position: relative; height: 100%;">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-0">
                                            <h5 class="card-title text-dark">{{ $subject->name }}</h5>
                                            <span class="badge bg-label-warning rounded-pill">{{ $subject->slug }}</span>
                                        </div>
                                        <span class="fw-semibold d-block mb-3">{{ optional($subject->teacher)->name }}</span>
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
                                        <p class="mb-2">{{ $dayName }}, {{ \Carbon\Carbon::parse($subject->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($subject->jam_selesai)->format('H:i') }}</p>
                                        <a href="{{ route('attendance.mark.view', ['subject_id' => $subject->id]) }}" class="btn btn-sm btn-info" style="position: absolute; bottom: 16px; right: 16px;">
                                            Akses
                                         </a>                                                                                                                                              
                                    </div>
                                </div>
                            </div>          
                        @endforeach              
                    </div>
                </div>
                <!-- Footer -->
                @include('teacher.layouts.footer')  
                <!-- / Footer -->
        
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