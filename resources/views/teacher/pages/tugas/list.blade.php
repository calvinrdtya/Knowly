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

                    <div class="row">
                        <div class="col-md-5">
                            <div class="card p-4">
                                <div class="row">
                                    <div class="card-title mb-0">
                                        <h4 class="card-title text-dark mb-0">{{ $assignment->title }}</h4>
                                    </div>
                                    <div class="card-body p-4 pb-0">
                                        <div class="row">
                                            <div class="my-3">
                                                <h6 class="card-title text-dark mb-1">Deskripsi</h6>
                                                <p class="mb-0">{{ $assignment->description }}</p>
                                            </div>
                                            <div class="my-3">
                                                <h6 class="card-title text-dark mb-1">Batas Waktu</h6>
                                                <p class="mb-0">{{ \Carbon\Carbon::parse($assignment->due_date)->isoFormat('dddd, D MMMM YYYY - HH:mm') }}</p>
                                            </div>
                                            <div class="my-3">
                                                <h6 class="card-title text-dark mb-1">Mengumpulkan</h6>
                                                <p class="mb-0">Kosong</p>
                                            </div>
                                            <div class="my-3">
                                                <h6 class="card-title text-dark mb-1">Lampiran</h6>
                                                <p class="mb-0">-</p>
                                            </div>
                                        </div>       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between my-3">
                                        <h5 class="card-title text-dark mb-0">Yang sudah mengumpulkan</h5>
                                    </div>
                                    <div class="table-responsive text-nowrap">
                                        {{-- @if($students->isEmpty()) --}}
                                            <p>Belum ada siswa yang mengumpulkan</p>
                                        {{-- @else --}}
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Absen</th>
                                                        <th>Nama</th>
                                                        <th>Kelas</th>
                                                    </tr>
                                                </thead>
                                                {{-- @foreach ($students as $student)
                                                    <tbody class="table-border-bottom-0">
                                                        <tr>
                                                            <td>{{ $student->absen }}</td>
                                                            <td>{{ $student->name }}</td>
                                                            <td>{{ $student->gender }}</td>
                                                            <td>{{ $student->gender }}</td>
                                                        </tr>
                                                    </tbody>
                                                @endforeach --}}
                                            </table>
                                        {{-- @endif --}}
                                    </div>
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