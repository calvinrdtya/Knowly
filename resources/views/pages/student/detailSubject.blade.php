@extends('layouts.master')
@section('page_title', 'My Subjects')

@section('content')
    <h2>WELCOME {{ Auth::user()->name }}. This is your DASHBOARD</h2>
    <div class="container my-4">
        <div class="row g-4">

            <!-- Informasi Kuliah -->
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h3>{{$subject->name}}</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th>Kode Guru</th>
                                <td>: {{$teacher->code}}</td>
                            </tr>
                            <tr>
                                <th>Nama Dosen</th>
                                <td>: {{$teacher->name}}</td>
                            </tr>
                            <tr>
                                <th>Presensi terakhir</th>
                                <td>: Senin, 02 Desember 2024 - 13:55:27</td>
                            </tr>
                        </table>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" disabled>Presensi</button>
                            <button class="btn btn-outline-danger">Aturan Presensi</button>
                            <a href="{{route('meeting.index', [$teacher->code])}}" class="btn btn-success" target="_blank">Conference
                                ETHOL</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- History Presensi -->
            <div class="col-md-6">
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
                            <tbody>
                                <tr>
                                    <td>3055145</td>
                                    <td>Rabu, 20 November 2024 - 19:28:06</td>
                                </tr>
                                <tr>
                                    <td>3094099</td>
                                    <td>Senin, 02 Desember 2024 - 13:58:21</td>
                                </tr>
                                <tr>
                                    <td>2748952</td>
                                    <td>Senin, 02 September 2024 - 13:05:21</td>
                                </tr>
                                <tr>
                                    <td>2986881</td>
                                    <td>Senin, 04 November 2024 - 13:49:45</td>
                                </tr>
                                <tr>
                                    <td>2877878</td>
                                    <td>Senin, 07 Oktober 2024 - 13:07:36</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peserta Kuliah -->
        <div class="card shadow mt-4">
            <div class="card-header">
                <h5>Peserta Kuliah</h5>
            </div>
            <div class="card-body">
                <div class="row align-items-center mb-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Cari...">
                    </div>
                    <div class="col-md-6 text-end">
                        <table class="table table-borderless">
                            <tr>
                                <th>Laki-laki</th>
                                <td>: 76</td>
                            </tr>
                            <tr>
                                <th>Perempuan</th>
                                <td>: 13</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>: 89</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>NRP</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>3224600001</td>
                            <td>Ahmad Haekal Badzan</td>
                            <td>L</td>
                        </tr>
                        <tr>
                            <td>3224600002</td>
                            <td>Tasya Sabila Ghaniyan</td>
                            <td>P</td>
                        </tr>
                        <tr>
                            <td>3224600003</td>
                            <td>Aiman Wicaksono</td>
                            <td>L</td>
                        </tr>
                        <!-- Tambahkan data lain -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
