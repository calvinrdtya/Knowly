@extends('layouts.master')

@section('page_title', 'Jadwal Mengajar')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Jadwal Mengajar</h2>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Ruang</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schedules as $key => $schedule)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $schedule->class->name }}</td>
                    <td>{{ $schedule->subject->name }}</td>
                    <td>{{ $schedule->jam_mulai }}</td>
                    <td>{{ $schedule->jam_selesai }}</td>
                    <td>{{ $schedule->room }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Jadwal Mengajar Tidak Tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
