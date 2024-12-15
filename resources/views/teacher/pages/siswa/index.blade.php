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
                    @include('back.layouts.nav')
                </nav>
                <!-- / Navbar -->
    
                <!-- Content wrapper -->
                <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-lg-8 mb-4">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-7">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">Informasi kelas akan muncul disini</h5>
                                            <p>Lihat jadwal Anda hari ini</p>
                                            <a href="" class="btn btn-sm btn-outline-primary">Lihat Jadwal</a>
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
                                            <h5 class="card-title text-dark">{{ $subject->name }}</h5>  <!-- Pastikan $subject adalah objek -->
                                            @php
                                                $colors = ['bg-label-primary', 'bg-label-secondary', 'bg-label-success', 'bg-label-danger', 'bg-label-info', 'bg-label-warning'];
                                                $randomColor = $colors[array_rand($colors)];
                                            @endphp
                                            
                                            <span class="badge {{ $randomColor }} rounded-pill">{{ $subject->slug }}</span>
                                        </div>

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
                                        <span class="fw-semibold d-block mb-3">
                                            {{ $dayName }},
                                            {{ \Carbon\Carbon::parse($subject->jam_mulai)->format('H:i') }} - 
                                            {{ \Carbon\Carbon::parse($subject->jam_selesai)->format('H:i') }}
                                        </span>

                                        @php
                                            // Ambil data kelas berdasarkan my_class_id yang terkait dengan subject
                                            $myClass = \App\Models\MyClass::find($subject->my_class_id);
                                        @endphp
                                        <p class="mb-3">{{ $myClass ? $myClass->name : 'Kelas Tidak Ditemukan' }}</p>

                                        <!-- Link untuk mengakses siswa dalam kelas yang diajar oleh guru yang login -->
                                        <a href="{{ route('teacher.schedule') }}" class="btn btn-sm btn-info" style="position: absolute; bottom: 16px; right: 16px;">
                                            Akses Jadwal
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                    <!-- / Content -->
        
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