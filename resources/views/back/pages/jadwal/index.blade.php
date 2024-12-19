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
                        @foreach($classes as $class)
                            <div class="col-lg-4 col-md-12 col-6 mb-4">
                                <div class="card" style="height: 100%; position: relative;">
                                    <div class="card-body" style="position: relative; height: 100%;">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <h5 class="card-title text-dark">{{ $class->name }}</h5>
                                        </div> 
                                        <a href="{{ route('jadwal.show', $class->id) }}" class="btn btn-sm btn-info" style="position: absolute; bottom: 14px; right: 14px;">
                                            Buat Jadwal
                                        </a>                                        
                                        {{-- <a href="{{ route('assignments.create') }}" class="btn btn-primary mb-3">Buat Tugas Baru</a>                                   --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
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