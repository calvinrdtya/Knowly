@extends('layouts.apps')

@section('content')

<section>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                @include('back.layouts.aside')
            </aside>
            <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    @include('back.layouts.nav')
                </nav>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                    <li class="nav-item">
                                        <a href="{{ route('kelas.index') }}" class="nav-link {{ request()->routeIs('kelas.index') ? 'active' : '' }}">Kelas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('mapel.index') }}" class="nav-link {{ request()->routeIs('mapel.index') ? 'active' : '' }}">Mata Pelajaran</a>
                                    </li>
                                </ul>
                                @if (Session::has('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if(Session::has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="card mb-4">
                                    <div class="card-body p-1">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h5 class="card-header mb-0">Data Kelas</h5>
                                            <div class="d-flex align-items-center">
                                                <button data-bs-toggle="modal" data-bs-target="#modalAdd" type="button" class="btn btn-sm btn-primary me-2">Buat Kelas Baru</button>
                                                <div class="navbar-nav align-items-center">
                                                    <div class="nav-item d-flex align-items-center">
                                                        <i class="bx bx-search fs-4 lh-0"></i>
                                                        <input type="text" class="form-control border-0 shadow-none" placeholder="Cari Kelas" aria-label="Search..." />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Nomer</th>
                                                        <th>Nama Kelas</th>
                                                        <th>Kelas</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    @foreach ($my_classes as $class)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $class->name }}</td>
                                                            <td>{{ $class->class_type?->name }}</td>
                                                            <td>
                                                                <button data-bs-toggle="modal" data-bs-target="#modalEdit{{ $class->id }}" type="button" class="btn btn-sm btn-outline-primary me-2">
                                                                    <span class="bx bx-edit-alt"></span>&nbsp; Edit
                                                                </button>
                                                                <a href="#" class="btn btn-sm btn-outline-danger me-2" onclick="event.preventDefault(); confirmDelete('{{ $class->id }}')">
                                                                    <i class='bx bx-trash'></i>
                                                                </a>
                                                                <form method="post" id="item-delete-{{ $class->id }}" action="{{ route('kelas.destroy', $class->id) }}" style="display: none;">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        @include('back.layouts.footer')
                        <div class="content-backdrop fade"></div>
                    </div>
                </div>
            </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
</section>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apa Anda Yakin?',
            text: "Jika sudah dihapus Anda tidak bisa memulihkannya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('item-delete-' + id).submit();
            }
        });
    }
</script>

{{-- Modal Tambah Kelas --}}
<div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddTitle">Tambah Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="ajax-store" method="post" action="{{ route('kelas.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="col mb-3">
                        <label for="name" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Tingkat</label>
                        <select required data-placeholder="Select Class Type" class="form-control select form-control-md" name="class_type_id" id="class_type_id">
                            @foreach($class_types as $ct)
                                <option {{ old('class_type_id') == $ct->id ? 'selected' : '' }} value="{{ $ct->id }}">{{ $ct->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal Tambah Kelas --}}

{{-- Modal Edit Kelas --}}
@foreach($my_classes as $class)
    <div class="modal fade" id="modalEdit{{ $class->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $class->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle{{ $class->id }}">Edit Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="ajax-update" data-reload="#page-header" method="post" action="{{ route('kelas.update', $class->id) }}">
                    @csrf @method('PUT')
                    <div class="modal-body">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Nama Kelas</label>
                            <input name="name" value="{{ $class->name }}" required type="text" class="form-control">
                        </div>
                        <div class="col mb-3">
                            <label for="name" class="form-label">Nama Kelas</label>
                            <input class="form-control" disabled="disabled" value="{{ $class->class_type->name }}" title="Class Type" type="text">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
{{-- End Modal Edit Kelas --}}

@endsection