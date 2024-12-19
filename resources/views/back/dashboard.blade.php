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
            <!-- / Menu -->

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
                            <div class="col-lg-8 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-sm-7">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary">Selamat Datang di Knowly</h5>
                                                <p class="mb-2">
                                                    Knowledge Network for Online Web-based Learning and Yield
                                                </p>
                                                <a href="javascript:;" class="btn btn-sm btn-outline-primary">Administrasi</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class="menu-icon bx bx-user bx-md"></i>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                            <a class="dropdown-item" href="javascript:void(0);">Lihat</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Siswa</span>
                                                <h3 class="card-title mb-2">{{ $totalStudents }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class="menu-icon bx bx-user bx-md"></i>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                            <a class="dropdown-item" href="javascript:void(0);">Lihat</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Guru</span>
                                                <h3 class="card-title mb-2">{{ $totalTeachers }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="card p-4 mb-4">
                                    <h5 class="card-title text-dark">Menu</h5>
                                    <div class="row my-0">
                                        <div class="col-lg-2 col-md-2 col-6 mb-3">
                                            <a href="">
                                                <div class="card d-flex align-items-center justify-content-center card-menu border-1 shadow-none">
                                                    <div class="card-body">
                                                        <img src="{{ asset('home/assets/images/kelas-virtual.png') }}" alt="">
                                                        <h6 class="card-title text-dark text-center my-2">Kelas Virtual</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-6 mb-3">
                                            <a href="">
                                                <div class="card d-flex align-items-center justify-content-center card-menu border-1 shadow-none">
                                                    <div class="card-body">
                                                        <img src="{{ asset('home/assets/images/materi.png') }}" alt="" width="100">
                                                        <h6 class="card-title text-dark text-center my-2">Materi</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-6 mb-3">
                                            <a href="">
                                                <div class="card d-flex align-items-center justify-content-center card-menu border-1 shadow-none">
                                                    <div class="card-body">
                                                        <img src="{{ asset('home/assets/images/virtual-lab.png') }}" alt="" width="100">
                                                        <h6 class="card-title text-dark text-center my-2">Lab Virtual</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-6 mb-3">
                                            <a href="">
                                                <div class="card d-flex align-items-center justify-content-center card-menu border-1 shadow-none">
                                                    <div class="card-body">
                                                        <img src="{{ asset('home/assets/images/praktikum.png') }}" alt="" width="100">
                                                        <h6 class="card-title text-dark text-center my-2">Praktikum</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-6 mb-3">
                                            <a href="">
                                                <div class="card d-flex align-items-center justify-content-center card-menu border-1 shadow-none">
                                                    <div class="card-body">
                                                        <img src="{{ asset('home/assets/images/administrasi.png') }}" alt="" width="100">
                                                        <h6 class="card-title text-dark text-center my-2">Administrasi</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-6 mb-3">
                                            <a href="">
                                                <div class="card d-flex align-items-center justify-content-center card-menu border-1 shadow-none">
                                                    <div class="card-body">
                                                        <img src="{{ asset('home/assets/images/ujian-online.png') }}" alt="" width="100">
                                                        <h6 class="card-title text-dark text-center my-2">Ujian Online</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
</section>

@endsection
