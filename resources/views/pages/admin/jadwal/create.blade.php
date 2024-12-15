@extends('layouts.master')

@section('page_title', 'Tambah Jadwal')

@section('content')
<div class="container mt-4">
    <h2>Tambah Jadwal</h2>
    <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf
        <!-- Dropdown Kelas -->
        <div class="form-group">
            <label for="class_id">Pilih Kelas</label>
            <select id="class_id" class="form-control" name="class_id">
                <option value="">Pilih Kelas</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>

        

        <!-- Dropdown Mata Pelajaran -->
        <div class="form-group">
            <label for="subject_id">Pilih Mata Pelajaran</label>
            <select id="subject_id" class="form-control" name="subject_id" disabled>
                <option value="">Pilih Mata Pelajaran</option>
            </select>
        </div>

        <div class="form-group">
            <label for="room_id">Pilih Ruangan</label>
            <input type="text" name="room" class="form-control" placeholder="Misalkan A.101">
        </div>

        <!-- Dropdown Guru -->
        <div class="form-group">
            <label for="teacher_id">Pilih Guru</label>
            <select id="teacher_id" class="form-control" name="teacher_id" disabled>
                <option value="">Pilih Guru</option>
            </select>
        </div>

        {{-- Waktu --}}
        <div class="form-group">
            <label for="day">Hari</label>
            <select name="day" id="day" class="form-control">
                <option value="">Pilih Hari</option>
                @foreach($days as $day)
                    <option value="{{ $day }}">{{ $day }}</option>
                @endforeach
            </select>

        </div>
        <div class="form-group">
            <label for="start_time">Waktu Mulai</label>
            <input type="time" name="start_time" class="form-control">
        </div>

        <div class="form-group">
            <label for="end_time">Waktu Selesai</label>
            <input type="time" name="end_time" class="form-control">
        </div>


        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Ambil Mata Pelajaran berdasarkan Kelas
        $('#class_id').on('change', function() {
            let classId = $(this).val();
            $('#subject_id').empty().append('<option value="">Pilih Mata Pelajaran</option>');
            $('#teacher_id').empty().append('<option value="">Pilih Guru</option>').prop('disabled', true);

            if (classId) {
                $.ajax({
                    url: '/get-subjects/' + classId,
                    type: 'GET',
                    success: function(data) {
                        $.each(data, function(index, subject) {
                            $('#subject_id').append('<option value="' + subject.id + '">' + subject.name + '</option>');
                        });
                        $('#subject_id').prop('disabled', false);
                    }
                });
            }
        });

        // Ambil Guru berdasarkan Mata Pelajaran
        $('#subject_id').on('change', function() {
            let subjectId = $(this).val();
            $('#teacher_id').empty().append('<option value="">Pilih Guru</option>');

            if (subjectId) {
                $.ajax({
                    url: '/get-teacher/' + subjectId,
                    type: 'GET',
                    success: function(data) {
                        $('#teacher_id').append('<option value="' + data.id + '">' + data.name + '</option>');
                        $('#teacher_id').prop('disabled', false);
                    }
                });
            }
        });
    });
</script>

@endsection
