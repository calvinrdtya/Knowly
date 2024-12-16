<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/all/assets/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Knowly • Knowledge Network for Online Web-based Learning and Yield</title>
    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="{{ asset('all/assets/img/favicon/favicon.ico') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('all/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('all/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('all/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('all/assets/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('all/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('all/assets/vendor/libs/apex-charts/apex-charts.css') }}">
    <link rel="stylesheet" href="{{ asset('all/assets/vendor/css/pages/page-auth.css') }}">

    <script src="{{ asset('all/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('all/assets/js/config.js') }}"></script>

    <style>
    .card-menu {
      transition: background-color 0.3s ease, transform 0.3s ease;
      border-radius: 30px;   
    }
    .card-menu:hover {
      background-color: #e9f9ff;
      transform: scale(1.05);
    }
    .card-menu img {
      transition: transform 0.3s ease;
    }
    .card-menu:hover img {
      transform: scale(1.1);
    }
    .card-hov {
      transition: all 0.3s ease-in-out;
      box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
    }
    .card-hov:hover {
      box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.1); 
    }
    </style>
  </head>
<body>

    @yield('content')

    <script src="{{ asset('all/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('all/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('all/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('all/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('all/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('all/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('all/assets/js/main.js') }}"></script>
    <script src="{{ asset('all/assets/js/dashboards-analytics.js') }}"></script>

    <script src="{{ asset('global_assets/js/plugins/ui/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_pages/fullcalendar_basic.js') }}"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>