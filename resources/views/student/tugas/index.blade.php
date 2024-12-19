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
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <label for="hari" class="col-md-4 col-form-label">Mata Pelajaran<span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <form method="GET" action="{{ route('student.assignment') }}">
                                                @csrf
                                                <select class="form-select" id="subject" name="subject" aria-label="Default select example" required onchange="this.form.submit()">
                                                    <option value="">Pilih Mata Pelajaran</option>
                                                    @foreach($subjects as $subject)
                                                        <option value="{{ $subject->id }}" {{ request('subject') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                                    @endforeach
                                                </select>
                                            </form>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($assignments as $assignment)
                            <div class="col-md-6 mt-4">
                                <div class="card border-1">
                                    <div class="card-body p-3">
                                        <div class="card-title">
                                            <h5 class="card-title text-dark mb-4">{{ $assignment->title }}</h5>
                                            <p class="mb-4">{{ substr($assignment->description, 0, 150) . '...' }}</p>
                                        </div>
                                        <div class="mt-3">
                                            <p class="mb-2" id="deskripsi">Guru : {{ $assignment->teacher->name }}</p>
                                            <p class="mb-2" id="deskripsi">Mata Pelajaran : {{ $assignment->subject->name ?? 'Tidak Ada Subject' }}</p>
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
                                            @else
                                                <a href="{{ route('student.assignments.submit', $assignment->id) }}" class="btn btn-sm btn-outline-danger d-flex align-items-center">
                                                    <i class='bx bx-x me-2'></i> Belum Mengumpulkan
                                                </a>
                                            @endif
                                            <a href="{{ route('student.assignments.show', $assignment->id) }}" class="btn btn-sm btn-outline-primary d-flex align-items-center">
                                                Detail Tugas <i class='bx bx-right-arrow-alt ms-2'></i>
                                            </a>
                                        </div>
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