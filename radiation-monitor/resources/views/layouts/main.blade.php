<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="api-key" content="{{ config('app.api_key') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel = "icon" href = "{{ asset('assets/img/LogoGram_1.png') }}" type = "image/x-icon">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendor/bootstrap-5.3.0/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/sb-admin-2/css/sb-admin-2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <title>Monitor Area Radiasi | {{ $title }}</title>
</head>
<body id="page-top">
    <div class="toast mt-4 bg-danger" style="position: absolute; top: 0; right: 0; z-index: 1; opacity:0.8">
        <div class="toast-body text-light">
          Peringatan: Laju dosis lebih.
        </div>
    </div>
    <div id="wrapper">
        @include('partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('partials.topbar')
                @yield('content')
            </div>
            @include('partials.footer')
        </div> 
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-5.3.0/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/sb-admin-2/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/sb-admin-2/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('js/dashboard/chart.js') }}"></script>
    <script src="{{ asset('js/dashboard/ajax.js') }}"></script>
    <script src="{{ asset('js/outdoor-monitor/chart.js') }}"></script>
    <script src="{{ asset('js/outdoor-monitor/ajax.js') }}"></script>
    <script src="{{ asset('js/indoor-monitor/chart.js') }}"></script>
    <script src="{{ asset('js/indoor-monitor/ajax.js') }}"></script>
</body>
</html>