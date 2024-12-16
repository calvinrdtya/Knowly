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
                    <div class="card p-4">
                        <div class="row">
                            <div class="card-title mb-0">
                                <h4 class="card-title text-dark mb-0">{{ $assignment->title }}</h4>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="my-2">
                                            <h6 class="card-title text-dark mb-1">Deskripsi</h6>
                                            <p class="mb-0">{{ $assignment->description }}</p>
                                        </div>
                                        <div class="my-2">
                                            <h6 class="card-title text-dark mb-1">Batas Waktu</h6>
                                            <p class="mb-0">{{ \Carbon\Carbon::parse($assignment->due_date)->isoFormat('dddd, D MMMM YYYY - HH:mm') }}</p>
                                        </div>
                                        <div class="my-2">
                                            <h6 class="card-title text-dark mb-1">Mengumpulkan</h6>
                                            <p class="mb-0">Kosong</p>
                                        </div>
                                        <div class="my-2">
                                            <h6 class="card-title text-dark mb-1">Lampiran</h6>
                                            <p class="mb-0"></p>
                                        </div>
                                    </div>       
                                </div>
                            </div>
                            <div class="col-md-5">
                                <form action="{{ $isSubmitted ? route('student.assignments.update', $submission->id) : route('student.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                    @csrf
                                    @if ($isSubmitted)
                                        @method('PUT')
                                    @endif
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="my-2">
                                                <h6 class="card-title text-dark mb-2">Catatan</h6>
                                                <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Tambahkan catatan untuk tugas ini..." {{ $isSubmitted && !$isEditing ? 'disabled' : '' }} required>{{ $isSubmitted ? $submission->notes : '' }}</textarea>
                                                <div class="invalid-feedback">
                                                    Catatan tidak boleh kosong.
                                                </div>
                                            </div>
                                            <div class="my-2">
                                                <h6 class="card-title text-dark mb-3">Lampiran</h6>
                                                <input type="file" name="file" id="file" class="form-control" {{ $isSubmitted && !$isEditing ? 'disabled' : '' }}>
                                                @if ($isSubmitted && $submission->file)
                                                    <p class="mt-2">Lampiran saat ini: 
                                                        <a href="{{ asset('storage/' . $submission->file) }}" target="_blank">Download</a>
                                                    </p>
                                                @endif
                                            </div>
                                            @if ($isSubmitted)
                                                @if ($isEditing)
                                                    <div class="my-3">
                                                        <button type="submit" class="btn btn-warning w-100">Edit Tugas</button>
                                                    </div>
                                                @else
                                                    <a href="{{ route('student.assignments.edit', $submission->id) }}" class="btn btn-warning w-100">Edit Tugas</a>
                                                @endif
                                            @else
                                                <div class="my-3">
                                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                                </div>
                                            @endif
                                        </div>       
                                    </div>
                                </form>
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

<script>
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
    })();
</script>

@endsection