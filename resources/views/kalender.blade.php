@extends('layouts.apps')

@section('content')

<section>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                @include('teacher.layouts.aside')
            </aside>
            <!-- Menu -->
    
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    @include('teacher.layouts.nav')
                </nav>
                <!-- / Navbar -->
    
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card p-4">
                            <div class="card-header">
                                <h5>Kalender Akademik 2024/2025</h5>
                            </div>
                            <div class="fullcalendar-basic"></div>   
                        </div>
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h5 class="card-title">School Events Calendar</h5>
                             {!! Qs::getPanelOptions() !!}
                            </div>
                            <div class="card-body">
                                <div class="fullcalendar-basic"></div>
                            </div>
                        </div>
                    <div class="content-backdrop fade"></div>
                    </div> 
                    <!-- Content wrapper -->
                </div>
            <!-- / Layout page -->
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
</section>
@endsection