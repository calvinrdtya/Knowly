@extends('layouts.master')

@section('page_title', 'Presensi')

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2>Presensi - {{ $subject->name }}</h2>
        <form action="{{ route('attendance.mark', $subject->id) }}" method="POST">
            @csrf
            <input type="hidden" name="subject_id" value="{{ $subject->id }}">
            {{-- @if (!$attendance->is_online)
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            @else
                <p>Presensi dilakukan secara online. Anda hanya perlu menekan tombol "Presensi".</p>
            @endif
            <button type="submit" class="btn btn-primary">Presensi</button> --}}
            @if (!$attendance)
                <button type="submit" class="btn btn-primary" id="attendance-btn" disabled>Presensi</button>
                <p>Presensi belum dibuka.</p>
            @elseif (!$attendance->is_open)
                <button type="submit" class="btn btn-primary" id="attendance-btn" disabled>Presensi</button>
            @elseif (!$attendance->is_online)
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
                <button type="submit" class="btn btn-primary" id="attendance-btn">Presensi</button>
            @else
                <button type="submit" class="btn btn-primary" id="attendance-btn">Presensi</button>
            @endif
        </form>

        <div class="mt-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5>History Presensi</h5>
                </div>
                <div class="card-body">

                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        @foreach ($history as $history )
                        <tbody>
                            <tr>
                                <td>{{ $history->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($history->created_at)->locale('id')->translatedFormat('l, d F Y - H:i:s') }}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
    <script>
        navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
        });
    </script>
@endsection
