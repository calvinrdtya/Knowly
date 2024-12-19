@extends('layouts.master') 

@section('page_title', 'Jadwal')
@section('content')
    <h1>Jadwal untuk Kelas: {{ $class->name ?? 'Tidak Diketahui' }}</h1>

    <!-- Tombol Tambah Jadwal -->
    <div class="mb-3">
        <a href="{{ route('jadwal.create', ['class_id' => $class->id ?? 0]) }}" class="btn btn-primary">
            Tambah Jadwal
        </a>
    </div>

    @if ($schedules->isEmpty())
        <div class="alert alert-warning">
            <p>Tidak ada jadwal untuk kelas ini.</p>
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
<<<<<<< HEAD
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
=======
                    <th>#</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Nama Guru</th>
                    <th>Hari</th>
                    <th>Jam</th>
>>>>>>> 63c74110c599f77ca817e6105181777e5c647940
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $schedule->subject->name }}</td>
                        <td>{{ $schedule->teacher->name }}</td>
                        <td>{{ $schedule->day }}</td>
                        <td>{{ $schedule->time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
