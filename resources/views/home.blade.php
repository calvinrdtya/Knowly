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
                                    <span class="category">Kuis Online</span>
                                    <h2>Fitur Kuis Interaktif KNOWLY</h2>
                                    <p>
                                        KNOWLY hadir dengan fitur kuis interaktif yang membantu meningkatkan pemahaman dan evaluasi pembelajaran. 
                                        Dapat disesuaikan dengan berbagai materi, mendukung format soal beragam, serta memberikan hasil secara real-time.
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
                                <img src="{{ asset('home/assets/images/fitur-1.png') }}" alt="Kuis Interaktif">
                            </div>
                            <div class="main-content">
                                <h4>Interactive Quiz</h4>
                                <p>
                                    Uji pemahaman Anda dengan kuis interaktif yang menyenangkan dan edukatif melalui platform Knowly.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="icon">
                                <img src="{{ asset('home/assets/images/fitur-2.png') }}" alt="Presensi Akurat">
                            </div>
                            <div class="main-content">
                                <h4>Smart Attendance</h4>
                                <p>
                                    Fitur presensi Knowly memastikan kehadiran siswa terdeteksi dengan akurat, baik saat pembelajaran offline maupun online.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 row-cuy col-md-6">
                        <div class="service-item">
                            <div class="icon">
                                <img src="{{ asset('home/assets/images/fitur-3.png') }}" alt="Personalized Dashboard Knowly">
                            </div>
                            <div class="main-content">
                                <h4>Task Master</h4>
                                <p>
                                    Kelola tugas dengan lebih efektif dan efisien melalui fitur manajemen tugas Knowly.
                                </p>
                            </div>
                        </div>                        
                    </div>
                </div>                
            </div>
        </div>
    </section>
    {{-- End Fitur Section --}}

    {{-- About Section --}}
    <div class="section about-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-1">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Apa yang harus dilakukan jika tidak bisa login ke Knowly karena lupa email dan password ?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Silahkan menghubungi petugas IT Jaringan dan Komputer, Akses kredensial siswa tidak ditangani oleh Tim Knowly.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Bagaimana jika mata pelajaran saya di semester ini tidak muncul ?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Silahkan mengecek status daftar ulang di Knowly menu Administrasi dan pastikan anda sudah melakukan daftar ulang dengan cara klik Tombol Daftar Ulang yang ada di Knowly menu Administrasi. Setelah anda melakukan klik pada tombol tersebut mata pelajaran anda akan muncul di Knowly satu hari setelahnya. Harap menunggu.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Bagaimana jika saya tidak dapat melakukan klik pada tombol Presensi saat akan mengikuti perkuliahan online ?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Harap dipastikan guru pengampu mata pelajaran sudah membuka presensi dengan cara menghubungi guru pengampu melalui Ketua Kelas anda. Jika teman anda sudah berhasil melakukan presensi namun tombol Presensi yang tampil di browser anda sedang dalam posisi tidak dapat di klik, maka guru sudah menutup presensi tersebut dan anda dianggap terlambat mengikuti pelajaran dan presensi anda berstatus Alpha.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 align-self-center">
                    <div class="section-heading">
                        <h6>Frequently Asked Questions</h6>
                        <h2>Yang Sering Ditanyakan</h2>
                        <p>Jika Anda mengalami kesulitan atau memiliki pertanyaan seputar layanan kami, jangan ragu untuk mencari jawaban di sini.</p>
                    </div>                
                </div>
            </div>
        </div>
    </div>
    {{-- End About Section --}}

    {{-- Testimonials Section --}}
    <section class="section testimonials pt-5">
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