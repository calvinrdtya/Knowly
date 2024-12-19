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
    
                <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        @forelse ($schedules as $hari => $jadwals)
                            <div class="col-md-4 col-12 mb-3">
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h5 class="text-white mb-0">{{ $hari }}</h5>
                                    </div>
                                    @foreach ($jadwals as $schedule)
                                        <div class="card-body pt-2">
                                            <div class="mt-2">
                                                <h5 class="card-title text-dark">{{ $schedule->subject->name }}</h5>
                                            </div>
                                            <div class="d-flex align-items-center my-1">
                                                <i class='bx bxs-window-alt'></i>
                                                <p class="mb-0 ms-2">{{ $schedule->class->name }}</p>
                                            </div>
                                            <div class="d-flex align-items-center my-1">
                                                <i class='bx bxs-time-five'></i>
                                                <p class="mb-0 ms-2">
                                                    {{ \Carbon\Carbon::parse($schedule->jam_mulai)->isoFormat('HH:mm') }} - 
                                                    {{ \Carbon\Carbon::parse($schedule->jam_selesai)->isoFormat('HH:mm') }}
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center my-1">
                                                <i class='bx bxs-home-circle'></i>
                                                <p class="mb-0 ms-2">{{ $schedule->room }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center">Tidak ada jadwal yang tersedia.</p>
                            </div>
                        @endforelse
                    </div>
                    <!-- / Content -->
        
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