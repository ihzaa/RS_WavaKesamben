<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin {{ env('APP_NAME') }} | @yield('page_title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css_before')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/adminlte.min.css">
    @yield('css_after')
</head>

<body class="hold-transition sidebar-mini">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <div>
            <img class="animation__shake" src="{{ asset('images/default/logo-hijau.png') }}" alt="AdminLTELogo"
                height="60">
        </div>
    </div>
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('admin.template.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
                {{-- <img src="{{ asset('admin') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
                <i class="fas fa-clinic-medical img-circle ml-3" style="fotn-size: 3rem"></i>
                <span class="brand-text font-weight-light">Wava Husada Kesamben</span>
            </a>

            <!-- Sidebar -->
            @include('admin.template.sidebar')
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('page_title')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                @yield('breadcrumb')
                                {{-- Contoh breadcrumb --}}
                                {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                {{ env('APP_NAME') }}
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @yield('js_before')
    <!-- jQuery -->
    <script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin') }}/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{asset('admin')}}/dist/js/demo.js"></script> --}}
    <script>
        function showLoader() {
            $('.preloader').css('height', '100%');
            $('.preloader').children().show();
        }

    </script>
    @yield('js_after')
    @if (Session::get('icon'))
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            Swal.fire({
                icon: "{{ Session::get('icon') }}",
                title: "{{ Session::get('title') }}",
                text: "{{ Session::get('text') }}",
            });
        </script>
    @endif

</body>

</html>
