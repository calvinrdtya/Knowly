@extends('layouts.home')

@section('content')

    {{-- Header Section --}}
    <section class="header">
        <div class="main-banner" id="top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="owl-carousel owl-banner">
                            <div class="item item-1">
                                <div class="header-text">
                                    <span class="category">Online Learning</span>
                                    <h2>Auto Summarize KNOWLY</h2>
                                    <p>
                                        KNOWLY hadir dengan fitur Speech to Text canggih yang memudahkan pencatatan otomatis, 
                                        mendukung berbagai bahasa, dan memberikan akurasi tinggi
                                    </p>
                                    <div class="buttons">
                                        <div class="main-button">
                                            <a href="#">Coba Sekarang</a>
                                        </div>
                                    </div>
                                </div>
                            </div>                           
                            <div class="item item-2">
                                <div class="header-text">
                                    <span class="category">Hasil Terbaik</span>
                                    <h2>Raih Prestasi Gemilang Bersama KNOWLY</h2>
                                    <p>
                                        Kami menghadirkan platform pembelajaran yang dirancang untuk membantu siswa mencapai potensi terbaiknya melalui fitur interaktif, 
                                        materi berkualitas, dan evaluasi yang mendalam.
                                    </p>
                                    <div class="buttons">
                                        <div class="main-button">
                                            <a href="#">Coba Sekarang</a>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="item item-3">
                                <div class="header-text">
                                    <span class="category">Belajar Lebih Mudah</span>
                                    <h2>Bersama KNOWLY, Jadi Lebih Unggul</h2>
                                    <p>
                                        Platform Learning Management System (LMS) yang dirancang khusus untuk mendukung
                                        belajar efektif, interaktif, dan terorganisir kapan saja dan di mana saja.
                                    </p>
                                    <div class="buttons">
                                        <div class="main-button">
                                            <a href="#">Mulai Sekarang</a>
                                        </div>
                                    </div>
                                </div>
                            </div>                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Header Section --}}

    {{-- Fitur Section --}}
    <section class="mvp">
        <div class="services section" id="services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="icon">
                                <img src="{{ asset('home/assets/images/fitur-1.png') }}" alt="">
                            </div>
                            <div class="main-content">
                                <h4>Ringkasan Materi Otomatis</h4>
                                <p>
                                    Membuat ringkasan materi secara otomatis melalui teknologi Text to Speech
                                </p>  
                            </div>
                        </div>
                    </div>                    
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="icon">
                                <img src="{{ asset('home/assets/images/fitur-2.png') }}" alt="">
                            </div>
                            <div class="main-content">
                                <h4>Presensi Akurat</h4>
                                <p>
                                    Fitur presensi Knowly memastikan kehadiran siswa terdeteksi dengan akurat, baik saat pembelajaran offline maupun online.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="icon">
                                <img src="{{ asset('home/assets/images/fitur-3.png') }}" alt="zoom versi Knowly">
                            </div>
                            <div class="main-content">
                                <h4>Zoom Versi Knowly</h4>
                                <p>
                                    Dengan teknologi video conferencing Knowly, siswa dapat berinteraksi lebih maksimal selama pembelajaran jarak jauh.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Fitur Section --}}

    {{-- Testimonials Section --}}
    <section class="section testimonials">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="owl-carousel owl-testimonials">
                        <div class="item">
                            <p>“Knowly memberikan dampak positif dalam proses pembelajaran. Dengan fitur Text to Speech, saya dapat merangkum hanya dengan suara”</p>
                            <div class="author">
                                <img src="assets/images/testimonial-author-2.jpg" alt="">
                                <span class="category">Learning Strategist</span>
                                <h4>Daniel Thompson</h4>
                            </div>
                        </div>                        
                        <div class="item">
                            <p>“Knowly memberikan pengalaman belajar yang benar-benar berbeda. Dengan sistem manajemen pembelajaran yang terintegrasi, proses belajar menjadi lebih interaktif dan efisien.”</p>
                            <div class="author">
                                <img src="assets/images/testimonial-author-1.jpg" alt="">
                                <span class="category">EdTech Innovator</span>
                                <h4>Samantha Lee</h4>
                            </div>
                        </div>
                    </div>                                   
                </div>
                <div class="col-lg-5 align-self-center">
                    <div class="section-heading">
                        <h6>TESTIMONIALS</h6>
                        <h2>Apa Kata Pengguna Kami</h2>
                        <p>Temukan bagaimana Knowly telah merevolusi pengalaman belajar, memberikan kesempatan kepada siswa dan pendidik untuk menciptakan solusi pendidikan yang lebih menarik, interaktif, dan efisien.</p>
                    </div>
                </div>                
            </div>
        </div>
    </section>    
    {{-- End Testimonials Section --}}

    {{-- Team Section --}}
    <section class="team section" id="team">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="team-member">
                        <div class="main-content">
                            <img src="{{ asset('home/assets/images/member-3.png') }}" alt="">
                            <span class="category">Backend Developer</span>
                            <h4>Tirta Afandi</h4>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="team-member">
                        <div class="main-content">
                            <img src="{{ asset('home/assets/images/member-1.png') }}" alt="">
                            <span class="category">Frontend Developer</span>
                            <h4>Calvin Raditya Sandy Winarto</h4>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="team-member">
                        <div class="main-content">
                            <img src="{{ asset('home/assets/images/member-2.jpg') }}" alt="">
                            <span class="category">Editod Bekentod, Pengedar Sabu, Pemabok</span>
                            <h4>Thariq Kemal Choiruddin</h4>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Team Section --}}
    
    {{-- Footer --}}
    <footer>
        <div class="container">
            <div class="col-lg-12">
                <p>Copyright ©2024 Knowly • Knowledge Network for Online Web-based Learning and Yield. All rights reserved. </p>
            </div>
        </div>
    </footer>
    {{-- End Footer --}}

@endsection