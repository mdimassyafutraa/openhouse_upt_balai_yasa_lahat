<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Balai Yasa | @yield('title')</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    {{-- My Css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- Css Template --}}
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon ">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="logo kai" width="60">
                </div>
                <div class="sidebar-brand-text mx-3">BYLT</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            @if (Auth::check())
                <!-- Nav Item - Dashboard -->
                @if (Auth::user()->role == 0 || Auth::user()->role == 1 || Auth::user()->role == 2)
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>
                    <!-- Divider -->
                    <hr class="sidebar-divider">
                @endif
                @if (Auth::user()->role == 0)
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('pengunjung.index') }}">
                            <i class="fas fa-users"></i>
                            <span>Daftar Pengunjung</span></a>
                    </li>
                    <!-- Divider -->
                    <hr class="sidebar-divider">
                @endif
                @if (Auth::user()->role == 0 || Auth::user()->role == 1)
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('scan') }}">
                            <i class="fas fa-users"></i>
                            <span>Scan</span></a>
                    </li>
                    <hr class="sidebar-divider">
                @endif

                @if (Auth::user()->role == 0)
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('pengunjung.create') }}">
                            <i class="fas fa-user-plus"></i>
                            <span>Daftar</span></a>
                    </li>
                    <!-- Divider -->
                    <hr class="sidebar-divider">
                @endif

                @if ((Auth::check() && Auth::user()->role == 0) || Auth::user()->role == 1)
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('manual.index') }}">
                            <i class="fas fa-book"></i>
                            <span>Daftar Manual</span>
                        </a>
                    </li>
                    <!-- Divider -->

                    <hr class="sidebar-divider">
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>
                @endif

            @endif
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav">
                        <li class="nav-item d-none d-sm-inline-block">
                            <span class="nav-link">@yield('title')</span>
                        </li>
                    </ul>

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        @if (Auth::check())
                            @if (Auth::user()->role == 0 || Auth::user()->role == 1 || Auth::user()->role == 2)
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="{{ route('pengunjung.index') }}"
                                        id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">Daftar Pengunjung</span> --}}
                                        <span
                                            class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                        {{-- <i class="fas fa-users"></i> --}}
                                        <img class="img-profile rounded-circle"
                                            src="{{ asset('template/img/undraw_profile.svg') }}">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="userDropdown">
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Logout
                                        </a>
                                    </div>
                                </li>

                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">john</span> --}}
                                        {{-- <img class="img-profile rounded-circle"
                                    src="{{ asset('template/img/undraw_profile.svg') }}"> --}}
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    {{-- <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div> --}}
                                </li>
                            @endif
                        @endif
                    </ul>

                </nav>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; UPT Balai Yasa Lahat <?= date('Y') ?></span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Anda yakin akan keluar dari aplikasi?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Pilih Logout untuk keluar</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" href={{ route('logout') }}>Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>

        {{-- JavaScript Chart --}}

</body>

</html>
