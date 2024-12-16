@extends('layouts.master')

@section('page_title', 'Daftar Kelas')

@section('content')
<div class="container mt-4">
    <h1>Daftar Kelas</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        @foreach($classes as $class)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $class->name }}</h5>
                        <a href="{{ route('jadwal.show', $class->id) }}" class="btn btn-primary">Lihat Jadwal</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
