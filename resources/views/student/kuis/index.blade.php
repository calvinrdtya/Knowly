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
                        <div class="card-body p-0">
                            <div class="card-header">
                                <h4 class="card-title text-dark mb-0">Kuis</h4>
                            </div>
                        </div>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <div class="row">
                        @foreach($quizzes as $quiz)
                            <div class="col-lg-4 col-md-12 col-12 mb-4">
                                <div class="card" style="height: 100%; position: relative;">
                                    <div class="card-body" style="position: relative; height: 100%;">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-0">
                                            <h5 class="card-title text-dark">{{ $quiz->title }}</h5>
                                        </div>
                                        <span class="fw-semibold d-block mb-4">{{ $quiz->description }}</span>
                                        <a href="{{ route('student.quizzes.show', $quiz->id) }}" class="btn btn-sm btn-info" style="position: absolute; bottom: 16px; right: 16px;">
                                            Kerjakan Kuis
                                         </a>                                                                                                                                              
                                    </div>
                                </div>
                            </div>          
                        @endforeach              
                    </div>
                </div>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
          <!-- / Layout page -->
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
</section>
@endsection