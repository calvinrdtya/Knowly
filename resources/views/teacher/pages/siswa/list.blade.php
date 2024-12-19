@extends('layouts.apps')

@section('content')

<section>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                @include('teacher.layouts.aside')
            </aside>
            <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    @include('teacher.layouts.nav')
                </nav>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="fw-bold">Informasi Siswa</h4>
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
                                                <li class="nav-item dropdown">
                                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Mata Pelajaran</a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @foreach(App\Models\MyClass::orderBy('name')->get() as $c)
                                                            <a href="{{ route('students.list', $c->id) }}" class="dropdown-item" data-bs-toggle="tab">{{ $c->name }}</a>
                                                        @endforeach
                                                    </div>
                                                </li>                                            
                                            </ul>
                                
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="all-students">
                                                    <table class="table datatable-button-html5-columns">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Photo</th>
                                                            <th>Name</th>
                                                            <th>ADM_No</th>
                                                            <th>Section</th>
                                                            <th>Email</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($students as $s)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $s->user->photo }}" alt="photo"></td>
                                                                <td>{{ $s->user->name }}</td>
                                                                <td>{{ $s->adm_no }}</td>
                                                                <td>{{ $my_class->name.' '.$s->section->name }}</td>
                                                                <td>{{ $s->user->email }}</td>
                                                                <td class="text-center">
                                                                    <div class="list-icons">
                                                                        <div class="dropdown">
                                                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                                                <i class="icon-menu9"></i>
                                                                            </a>
                                
                                                                            <div class="dropdown-menu dropdown-menu-left">
                                                                                <a href="{{ route('students.show', Qs::hash($s->id)) }}" class="dropdown-item"><i class="icon-eye"></i> View Profile</a>
                                                                                @if(Qs::userIsTeamSA())
                                                                                    <a href="{{ route('students.edit', Qs::hash($s->id)) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                                                    <a href="{{ route('st.reset_pass', Qs::hash($s->user->id)) }}" class="dropdown-item"><i class="icon-lock"></i> Reset password</a>
                                                                                @endif
                                                                                <a target="_blank" href="{{ route('marks.year_selector', Qs::hash($s->user->id)) }}" class="dropdown-item"><i class="icon-check"></i> Marksheet</a>
                                
                                                                                {{--Delete--}}
                                                                                @if(Qs::userIsSuperAdmin())
                                                                                    <a id="{{ Qs::hash($s->user->id) }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                                                    <form method="post" id="item-delete-{{ Qs::hash($s->user->id) }}" action="{{ route('students.destroy', Qs::hash($s->user->id)) }}" class="hidden">@csrf @method('delete')</form>
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
                                
                                                @foreach($sections as $se)
                                                    <div class="tab-pane fade" id="s{{$se->id}}">                         <table class="table datatable-button-html5-columns">
                                                            <thead>
                                                            <tr>
                                                                <th>S/N</th>
                                                                <th>Photo</th>
                                                                <th>Name</th>
                                                                <th>ADM_No</th>
                                                                <th>Email</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($students->where('section_id', $se->id) as $sr)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $sr->user->photo }}" alt="photo"></td>
                                                                    <td>{{ $sr->user->name }}</td>
                                                                    <td>{{ $sr->adm_no }}</td>
                                                                    <td>{{ $sr->user->email }}</td>
                                                                    <td class="text-center">
                                                                        <div class="list-icons">
                                                                            <div class="dropdown">
                                                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                                                    <i class="icon-menu9"></i>
                                                                                </a>
                                
                                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                                    <a href="{{ route('students.show', Qs::hash($sr->id)) }}" class="dropdown-item"><i class="icon-eye"></i> View Info</a>
                                                                                    @if(Qs::userIsTeamSA())
                                                                                        <a href="{{ route('students.edit', Qs::hash($sr->id)) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                                                        <a href="{{ route('st.reset_pass', Qs::hash($sr->user->id)) }}" class="dropdown-item"><i class="icon-lock"></i> Reset password</a>
                                                                                    @endif
                                                                                    <a href="#" class="dropdown-item"><i class="icon-check"></i> Marksheet</a>
                                
                                                                                    {{--Delete--}}
                                                                                    @if(Qs::userIsSuperAdmin())
                                                                                        <a id="{{ Qs::hash($sr->user->id) }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                                                        <form method="post" id="item-delete-{{ Qs::hash($sr->user->id) }}" action="{{ route('students.destroy', Qs::hash($sr->user->id)) }}" class="hidden">@csrf @method('delete')</form>
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

@endsection