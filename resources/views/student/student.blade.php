@extends('layouts.apps')

@section('content')

<style>
    .card-menu {
        transition: background-color 0.3s ease, transform 0.3s ease;
        border-radius: 30px;   
    }
    .card-menu:hover {
        background-color: #e9f9ff;
        transform: scale(1.05);
    }
    .card-menu img {
        transition: transform 0.3s ease;
    }
    .card-menu:hover img {
        transform: scale(1.1);
    }
    .card-hov {
        transition: all 0.3s ease-in-out;
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
    }
    .card-hov:hover {
        box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.1); 
    }
</style>


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
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-lg-5 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row p-3">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">Kuliah Semester Ganjil Tahun Ajaran 2024</h5>
                                            <p class="mb-2">
                                                Knowledge Network for Online Web-based Learning and Yield
                                            </p>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <li class="d-flex mb-3 pb-1">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="User" class="rounded" />
                                                </div>
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h5 class="card-title text-dark mb-0">Total Tugas</h5>
                                                    </div>
                                                </div>
                                            </li>
                                        </div>
                                        <h2 class="card-title mb-1">2</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-3" style="height: auto; position: relative;">
                                    <div class="card-body p-4">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-0">
                                            <h5 class="card-title text-dark">Basis Data</h5>
                                            <span class="badge bg-label-warning rounded-pill">BD</span>
                                        </div>
                                        <span class="fw-semibold d-block mb-2">Nailussa`ada S.ST., M.Tr.Kom</span>
                                        <p class="mb-2">Kamis (08:00 - 09:40)</p>
                                        <a href="javascript:;" class="btn btn-sm btn-info" style="position: absolute; bottom: 16px; right: 16px;">
                                            Akses Kelas
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card p-4 mb-4">
                            <h5 class="card-title text-dark">Menu</h5>
                            <div class="row my-0">
                                <div class="col-lg-2 col-md-2 col-2 mb-3">
                                    <a href="">
                                        <div class="card d-flex align-items-center justify-content-center card-menu border-1 shadow-none">
                                            <div class="card-body">
                                                <img src="{{ asset('home/assets/images/kelas-virtual.png') }}" alt="">
                                                <h6 class="card-title text-dark text-center my-2">Kelas Virtual</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>                                                                                                  
                                <div class="col-lg-2 col-md-2 col-2 mb-3">
                                    <a href="">
                                        <div class="card d-flex align-items-center justify-content-center card-menu border-1 shadow-none">
                                            <div class="card-body">
                                                <img src="{{ asset('home/assets/images/materi.png') }}" alt="" width="100">
                                                <h6 class="card-title text-dark text-center my-2">Materi</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-2 col-2 mb-3">
                                    <a href="">
                                        <div class="card d-flex align-items-center justify-content-center card-menu border-1 shadow-none">
                                            <div class="card-body">
                                                <img src="{{ asset('home/assets/images/virtual-lab.png') }}" alt="" width="100">
                                                <h6 class="card-title text-dark text-center my-2">Lab Virtual</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-2 col-2 mb-3">
                                    <a href="">
                                        <div class="card d-flex align-items-center justify-content-center card-menu border-1 shadow-none">
                                            <div class="card-body">
                                                <img src="{{ asset('home/assets/images/praktikum.png') }}" alt="" width="100">
                                                <h6 class="card-title text-dark text-center my-2">Praktikum</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-2 col-2 mb-3">
                                    <a href="">
                                        <div class="card d-flex align-items-center justify-content-center card-menu border-1 shadow-none">
                                            <div class="card-body">
                                                <img src="{{ asset('home/assets/images/administrasi.png') }}" alt="" width="100">
                                                <h6 class="card-title text-dark text-center my-2">Administrasi</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-2 col-2 mb-3">
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

                        <div class="card p-4">
                            <div class="row my-0">
                                <div class="col-md-6">
                                    <h5 class="card-title text-dark">Tugas Terbaru</h5>
                                        @foreach($assignments as $assignment)
                                            <div class="card border-1 my-4">
                                                <div class="card-body p-3">
                                                    <div class="card-title">
                                                        <h5 class="card-title text-dark mb-4">{{ $assignment->title }}</h5>
                                                        <p class="mb-4">{{ substr($assignment->description, 0, 150) . '...' }}</p>
                                                    </div>
                                                    <div class="mt-3">
                                                        <p class="mb-2" id="deskripsi">Guru : {{ $assignment->teacher->name }}</p>
                                                        <p class="mb-2" id="deskripsi">Deadline : {{ \Carbon\Carbon::parse($assignment->due_date)->isoFormat('dddd, D MMMM YYYY - HH:mm') }}</p>
                                                    </div>
                                                    <hr class="my-3">
                                                    <div class="d-flex justify-content-between">
                                                        @php
                                                            $submission = $assignment->submissions->where('student_id', auth()->id())->first();
                                                        @endphp
                                                        @if ($submission)
                                                            <button class="btn btn-sm btn-outline-success d-flex align-items-center">
                                                                <i class='bx bx-check me-2'></i> Sudah Mengumpulkan
                                                            </button>
                                                            {{-- <span class="text-success">Sudah Dikumpulkan</span> pada 
                                                            {{ \Carbon\Carbon::parse($submission->created_at)->format('d M Y, H:i') }} --}}
                                                        @else
                                                            <a href="" class="btn btn-sm btn-outline-danger d-flex align-items-center">
                                                                <i class='bx bx-x me-2'></i> Belum Mengumpulkan
                                                            </a>
                                                        @endif
                                                    <a href="{{ route('student.assignments.show', $assignment->id) }}" class="btn btn-sm btn-outline-primary d-flex align-items-center">
                                                        Detail Tugas <i class='bx bx-right-arrow-alt ms-2'></i>
                                                    </a>                                            
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>                
                                <div class="col-md-1">
                                    </div>            
                                <div class="col-md-5">
                                    <h5 class="card-title text-dark">Pengumuman</h5>
                                    <div class="card card-hov border-1 mb-3" style="height: auto; position: relative;">
                                        <div class="card-body p-3">
                                            <div class="card-title">
                                                <h5 class="card-title text-dark mb-1">Formulir Kelulusan PENS 2024</h5>
                                                <p class="mb-4" id="deskripsi">
                                                    Daftar Nama Kelulusan PENS Maret 2024    
                                                </p>
                                            </div>
                                            <div class="mt-3">
                                                <p class="mb-0">Dibuat Oleh BK</p>
                                                <p class="mb-2">Sabtu, 14 Desember 2024 - 10:53</p>
                                            </div>
                                            <a href="#" class="text-decoration-none text-reset">
                                                <div class="card border-1 shadow-none">
                                                    <div class="d-flex align-items-center justify-content-between p-2">
                                                        <img src="{{ asset('home/assets/images/docs/pdf.png') }}" alt="User" width="50" class="rounded me-3" />
                                                        <div class="flex-grow-1 text-start">
                                                            <p class="mb-0">Dibuat Oleh BK</p>
                                                            <p class="mb-0">Sabtu, 14 Desember 2024 - 10:53</p>
                                                        </div>
                                                        <i class='bx bx-download' style="font-size: 24px; cursor: pointer;"></i>
                                                    </div>
                                                </div>
                                            </a>                                                                            
                                        </div>
                                    </div>
                                    
                                    {{-- <div class="card card-hov border-1 mb-3" style="height: auto; position: relative;">
                                        <div class="card-body p-3">
                                            <div class="card-title">
                                                <h5 class="card-title text-dark mb-1">Formulir Kelulusan PENS 2024</h5>
                                                <p class="mb-4" id="deskripsi">
                                                    Daftar Nama Kelulusan PENS Maret 2024    
                                                </p>
                                            </div>
                                            <div class="mt-3">
                                                <p class="mb-0">Dibuat Oleh BK</p>
                                                <p class="mb-2">Sabtu, 14 Desember 2024 - 10:53</p>
                                            </div>
                                            <a href="#" class="text-decoration-none text-reset">
                                                <div class="card border-1 shadow-none">
                                                    <div class="d-flex align-items-center justify-content-between p-2">
                                                        <img src="{{ asset('home/assets/images/docs/pdf.png') }}" alt="User" width="50" class="rounded me-3" />
                                                        <div class="flex-grow-1 text-start">
                                                            <p class="mb-0">Dibuat Oleh BK</p>
                                                            <p class="mb-0">Sabtu, 14 Desember 2024 - 10:53</p>
                                                        </div>
                                                        <i class='bx bx-download' style="font-size: 24px; cursor: pointer;"></i>
                                                    </div>
                                                </div>
                                            </a>                                                                            
                                        </div>
                                    </div> --}}
                                </div>                            
                            </div>  
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

<script>
    function truncateText(selector, maxLength) {
        const element = document.querySelector(selector);
        const text = element.textContent;

        if (text.length > maxLength) {
            const truncatedText = text.substring(0, maxLength) + "...";
            element.textContent = truncatedText;
        }
    }
    truncateText("#deskripsi", 250);
</script>

@endsection