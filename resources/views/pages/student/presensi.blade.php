@extends('layouts.master')
@section('page_title', 'My Presensi')

@section('content')
    <h2>WELCOME {{ Auth::user()->name }}. This is your DASHBOARD</h2>
    @foreach($subjects as $sub)
        <div class="card">
            <div class="card-header">
                <h6 class="card-title font-weight-bold">Presensi</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject_id" class="col-form-label font-weight-bold">Subject:</label>
                                    <p>Matematika</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject_id" class="col-form-label font-weight-bold">Date:</label>
                                    <p>23</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject_id" class="col-form-label font-weight-bold">Status:</label>
                                    <p>hasid</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject_id" class="col-form-label font-weight-bold">Time:</label>
                                    <p>12</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endsection
