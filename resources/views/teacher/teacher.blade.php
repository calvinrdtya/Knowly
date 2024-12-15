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
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-lg-8 mb-4 order-0">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-7">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">Selamat Datang {{ Auth::user()->name }} di Knowly</h5>
                                            <p class="mb-2">
                                                Knowledge Network for Online Web-based Learning and Yield
                                            </p>
                                            <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-6 mb-4">
                            <div class="card" style="height: 100%; position: relative;">
                                <div class="card-body" style="position: relative; height: 100%;">
                                    <div class="card-title d-flex align-items-start justify-content-between mb-0">
                                        <h5 class="card-title text-dark">Basis Data</h5>
                                        <span class="badge bg-label-warning rounded-pill">BD</span>
                                    </div>
                                    <span class="fw-semibold d-block mb-3">Nailussa`ada S.ST., M.Tr.Kom</span>
                                    <p class="mb-2">Kamis (08:00 - 09:40)</p>
                                    <!-- Tombol -->
                                    <a href="javascript:;" class="btn btn-sm btn-info" style="position: absolute; bottom: 16px; right: 16px;">
                                        Akses Kelas
                                    </a>
                                </div>
                            </div>
                        </div>                        
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