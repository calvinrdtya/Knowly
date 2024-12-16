@extends('layouts.master')

@section('page_title', 'Jadwal Kelas - '.$class->name)
@section('content')
<div class="container mt-4">
    <h1>Jadwal Kelas {{ $class->name }}</h1>
    <a href="{{ route('jadwal.create') }}" class="btn btn-success mb-3">Tambah Jadwal</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mata Pelajaran</th>
                <th>Guru</th>
                <th>Hari</th>
                <th>Waktu</th>
                <th>Ruang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->subject->name }}</td>
                    <td>{{ $schedule->teacher->name }}</td>
                    <td>{{ $schedule->hari }}</td>
                    <td>{{ \Carbon\Carbon::parse($schedule->jam_mulai)->isoFormat('HH:mm') }} - {{ \Carbon\Carbon::parse($schedule->jam-selesai)->isoFormat('HH:mm') }}</td>
                    <td>{{ $schedule->room}}</td>
                    <td>
                        <a href="{{ route('jadwal.edit', $schedule->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jadwal.destroy', $schedule->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
