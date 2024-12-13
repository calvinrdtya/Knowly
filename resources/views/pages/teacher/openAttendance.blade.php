@extends('layouts.master')

@section('page_title', 'Buka Presensi')
@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($error->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2>Buka Presensi - {{ $subject->name }}</h2>
        
            
            @if ($attendance==null)
            <form action="{{ route('attendance.open', $subject->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="is_online">Jenis Presensi</label>
                <select name="is_online" id="is_online" class="form-control" required>
                    <option value="1">Online</option>
                    <option value="0">Offline</option>
                </select>
            </div>
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <button type="submit" class="btn btn-primary">Buka Presensi</button>
        </form>

            @else
            <p>Presensi sudah dibuka.</p>
            <form action="{{ route('attendance.close', $attendance->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Tutup Presensi</button>
            </form>
            @endif
            
            

    </div>
    <script>
        navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
        });
    </script>
@endsection
