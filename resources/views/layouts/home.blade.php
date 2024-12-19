<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Knowly • Online Knowledge Maintenance, Learning & Results</title>

    <link href="{{ asset('home/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('home/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('home/assets/css/section.css') }}">
    <link rel="stylesheet" href="{{ asset('home/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('home/assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">

  </head>
<body>

    @include('layouts.partials.navbar')

    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
        <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    @yield('content')

    <script src="{{ asset('home/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('home/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('home/assets/js/counter.js') }}"></script>
    <script src="{{ asset('home/assets/js/custom.js') }}"></script>
  </body>
</html>