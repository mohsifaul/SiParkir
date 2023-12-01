<!DOCTYPE html>
<html lang="en">
<head>
@vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets-admin/images/favicon/favicon.ico')}}">

    <!-- Libs CSS -->
    {{-- <link href="./assets-admin/css/bootstrap-icons.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="{{ asset('assets-admin/css/dropzone.css') }}"  rel="stylesheet">
    <link href="{{ asset('assets-admin/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-admin/css/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-admin/css/prism-okaidia.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-admin/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-admin/css/simplebar.min.css')}}" rel="stylesheet">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('assets-admin/css/theme.css')}}">
    <script src="{{ asset('assets-admin/js/bootstrap.bundle.min.js') }}"></script>
    <title>Dashboard | SiParkir</title>
</head>
<body class="bg-light">
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <!-- Sidebar -->
        @include('admin/layout/sidebar')
        <!-- Page content -->
        <div id="page-content">
            <div class="header @@classList">
                <!-- navbar -->
                @include('admin/layout/navbar')
            </div>
            <!-- Container fluid -->
            <div class="bg-primary pt-10 pb-21"></div>
            <div class="container-fluid mt-n23 px-6">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <!-- Libs JS -->
    <script src="{{ asset('assets-admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/prism.js') }}"></script>
    <script src="{{ asset('assets-admin/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/prism-toolbar.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/prism-copy-to-clipboard.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/theme.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/datatable.js') }}"></script>
    <script src="{{ asset('assets-admin/js/sweetalert2.all.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@12"></script> --}}

</body>
</html>