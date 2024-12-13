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
                                        {{-- <div class="d-flex align-items-center justify-content-between">
                                            <h5 class="card-header mb-0">Data Kelas</h5>
                                            <div class="d-flex align-items-center">
                                                <button data-bs-toggle="modal" data-bs-target="#modalCenter" type="button" class="btn btn-sm btn-primary me-2">Buat Kelas Baru</button>
                                                <div class="navbar-nav align-items-center">
                                                    <div class="nav-item d-flex align-items-center">
                                                        <i class="bx bx-search fs-4 lh-0"></i>
                                                        <input type="text" class="form-control border-0 shadow-none" placeholder="Cari Kelas" aria-label="Search..." />
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="px-4 pt-4">
                                            <ul class="nav nav-tabs nav-tabs-highlight">
                                                <li class="nav-item"><a href="{{ route('mapel.index') }}" class="nav-link active" data-toggle="tab">Tambah Mata Pelajaran</a></li>
                                                <li class="nav-item dropdown">
                                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Mata Pelajaran</a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @foreach($my_classes as $c)
                                                            <a href="#c{{ $c->id }}" class="dropdown-item" data-bs-toggle="tab">{{ $c->name }}</a>
                                                        @endforeach
                                                    </div>
                                                </li>                                            
                                            </ul>
                                
                                            <div class="tab-content pt-0 pb-4">
                                                <hr class="my-4">
                                                <div class="tab-pane show active fade" id="new-subject">
                                                    <form class="ajax-store" method="post" action="{{ route('mapel.store') }}">
                                                        @csrf
                                                        <div class="row mt-5">
                                                            <div class="col-md-6">
                                                                <div class="mb-3 row">
                                                                    <label for="name" class="col-md-3 col-form-label">Mata Pelajaran<span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Bahasa Indonesia" required>
                                                                        @error('name')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label for="slug" class="col-md-3 col-form-label">Singkatan<span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control" type="text" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Contoh: B Indo" required>
                                                                        @error('slug')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="my_class_id" class="col-form-label col-md-3">Pilih Kelas<span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <select class="form-select" name="my_class_id" id="my_class_id" required>
                                                                            <option selected>Pilih Kelas</option>
                                                                            @foreach($my_classes as $c)
                                                                                <option value="{{ $c->id }}" {{ old('my_class_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('my_class_id')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="teacher_id" class="col-form-label col-md-3">Pilih Guru<span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <select name="teacher_id" class="form-select" required>
                                                                            <option selected>Pilih Guru</option>
                                                                            @foreach($teachers as $teacher)
                                                                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                                                                    {{ $teacher->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>                                                                        
                                                                        @error('teacher_id')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3 row">
                                                                    <label for="hari" class="col-md-3 col-form-label">Hari<span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <select class="form-select" id="hari" name="hari" aria-label="Default select example" required>
                                                                            <option selected>Pilih Hari</option>
                                                                            <option value="1" {{ old('hari') == '1' ? 'selected' : '' }}>Senin</option>
                                                                            <option value="2" {{ old('hari') == '2' ? 'selected' : '' }}>Selasa</option>
                                                                            <option value="3" {{ old('hari') == '3' ? 'selected' : '' }}>Rabu</option>
                                                                            <option value="4" {{ old('hari') == '4' ? 'selected' : '' }}>Kamis</option>
                                                                            <option value="5" {{ old('hari') == '5' ? 'selected' : '' }}>Jumat</option>
                                                                        </select>
                                                                        @error('hari')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label for="jam_mulai" class="col-md-3 col-form-label">Jam Mulai<span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control" type="time" name="jam_mulai" value="{{ old('jam_mulai') }}" required>
                                                                        @error('jam_mulai')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label for="jam_selesai" class="col-md-3 col-form-label">Jam Selesai<span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control" type="time" name="jam_selesai" value="{{ old('jam_selesai') }}" required>
                                                                        @error('jam_selesai')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                        </div>
                                                        <div class="col-md-12 d-flex justify-content-end mt-3">
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>                                                    
                                                </div>
                            
                                            @foreach($my_classes as $c)
                                                <div class="tab-pane fade" id="c{{ $c->id }}">
                                                        <table class="table table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>S/N</th>
                                                                <th>Mata pelajaran</th>
                                                                {{-- <th>Short Name</th> --}}
                                                                <th>Kelas</th>
                                                                <th>Guru</th>
                                                                <th>Hari</th>
                                                                <th>Jam</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($subjects->where('my_class.id', $c->id) as $s)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $s->name }} </td>
                                                                    {{-- <td>{{ $s->slug }} </td> --}}
                                                                    <td>{{ $s->my_class->name }}</td>
                                                                    <td>{{ $s->teacher->name }}</td>
                                                                    <td>{{ ['1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat'][$s->hari] }}</td>
                                                                    <td>{{ $s->jam }}</td>
                                                                    <td>
                                                                        @if(Qs::userIsTeamSA())
                                                                            <a href="{{ route('mapel.edit', $s->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                                                                <i class='bx bx-edit-alt'></i>
                                                                            </a>
                                                                        @endif
                                                                        {{--Delete--}}
                                                                        @if(Qs::userIsSuperAdmin())
                                                                            <a href="#" id="{{ $s->id }}"class="btn btn-sm btn-outline-danger me-2" onclick="event.preventDefault(); confirmDelete('{{ $s->id }}')">
                                                                                <i class='bx bx-trash'></i>
                                                                            </a>
                                                                            <form method="post" id="item-delete-{{ $s->id }}"" action="{{ route('mapel.destroy', $s->id) }}" style="display: none;">
                                                                                @csrf
                                                                                @method('delete')
                                                                            </form>
                                                                        @endif
                                                                        <div class="list-icons">
                                                                            <div class="dropdown">
                                                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                                                    <i class="icon-menu9"></i>
                                                                                </a>
                                
                                                                                <div class="dropdown-menu dropdown-menu-left">
                                                                                    {{--edit--}}
                                                                                    @if(Qs::userIsTeamSA())
                                                                                        <a href="{{ route('mapel.edit', $s->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                                                    @endif
                                                                                    {{--Delete--}}
                                                                                    @if(Qs::userIsSuperAdmin())
                                                                                        <a id="{{ $s->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                                                        <form method="post" id="item-delete-{{ $s->id }}" action="{{ route('mapel.destroy', $s->id) }}" class="hidden">@csrf @method('delete')</form>
                                                                                    @endif
                                
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endforeach
                                            </div>
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

     function showSubjects(classId) {
        // Sembunyikan semua tab-pane
        document.querySelectorAll('.tab-pane').forEach(tab => {
            tab.style.display = 'none';
        });

        // Tampilkan tab-pane yang sesuai dengan ID
        const selectedTab = document.getElementById(classId);
        if (selectedTab) {
            selectedTab.style.display = 'block';
        }
    }
</script>

{{-- Modal Tambah Kelas --}}
{{-- <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Tambah Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="ajax-store" method="post" action="{{ route('classes.store') }}">
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
</div> --}}
{{-- End Modal Tambah Kelas --}}

@endsection