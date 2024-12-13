@extends('layouts.home')

@section('content')

<body class="pt-lg-5" style="background-image: url({{ asset('home/assets/images/banner-bg.jpg') }});">
    <div class="contact-us section" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center my-3">
                    <div class="section-heading">
                        <a href="{{ url('/') }}"><h6>Knowly Unlock Your Learning Potential</h6></a>
                        <h2>Selamat Datang <br> Kembali</h2>
                        <p>Silakan masuk untuk melanjutkan. Jika Anda belum memiliki akun, Anda dapat mendaftar di sini.</p>
                    </div>
                </div>
                <div class="col-lg-6 d-flex justify-content-center my-3">
                    <div class="contact-us-content" style="width: 85% !important">
                        <form id="contact-form" method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <fieldset>
                                        <input type="name" name="identity" value="{{ old('identity') }}" placeholder="Masukkan Email" autocomplete="on" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <input type="text" name="password" placeholder="Masukkan Password" required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="orange-button w-100">Login</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection