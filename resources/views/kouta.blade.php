<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Buku Pengunjung | BYLT</title>
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


</head>

<body class="bg-gradient-primary">
    <nav class="navbar navbar-expand-lg navbar-light bg-gradient-primary ">
        <div class="container">
            <a class="navbar-brand text-white font-weight-bold" href="{{ route('pengunjung.create') }}"><img
                    src="{{ asset('assets/img/logo.png') }}" alt="logo" width="50px"> BYLT
            </a>
            <button class="navbar-toggler text-white" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation" style="border: 1px solid white">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <div class="navbar-nav font-weight-bold">
                    <a class="nav-item nav-link text-white" href="{{ route('pengunjung.create') }}">Home <span
                            class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link text-white" href="{{ route('tiket') }}">Tiket <span
                            class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link text-white" href="{{ route('kouta') }}">Kouta <span
                            class="sr-only">(current)</span></a>

                </div>
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - User Information -->
                    @if (Auth::check())
                        @if (Auth::user()->role == 0 || Auth::user()->role == 1 || Auth::user()->role == 2)
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="{{ route('pengunjung.index') }}"
                                    id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    {{-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">Daftar Pengunjung</span> --}}
                                    <span
                                        class="mr-2 d-none d-lg-inline text-lg text-white">{{ Auth::user()->name }}</span>
                                    <i class="fas fa-sign-out-alt"></i>
                                    <!--<img class="img-profile rounded-circle" width="40px"-->
                                    <!--    src="{{ asset('template/img/undraw_profile.svg') }}">-->
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
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            </div>
        </div>
    </nav>
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-lg-6 mb-3">
                <div class="card shadow bg-gradient-light">
                    <div class="card-body">
                        <div class="p-3">
                            <div class="text-center">
                                <h4 class="headinput mb-4">Kouta Tanggal 30 September 2023</h4>
                                <p>Kuota Pengunjung Per Hari: {{ $dailyLimitPerDay }}</p>
                                <p>Jumlah Terdaftar (30-09-2023): {{ $registeredCountPerDay30 }}</p>
                                <p>Untuk jam 12.00 - 13.00 Kosong</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Jam</th>
                                                <th>Kouta</th>
                                                <th>Jumlah Terdaftar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($registeredCountPerHour30 as $hourRange => $count)
                                            <tr>
                                                <td>{{ $hourRange }}</td>
                                                <td>{{ $dailyLimitPerHour }}</td>
                                                <td>{{ $count }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 mb-3">
                <div class="card shadow bg-gradient-light">
                    <div class="card-body">
                        <div class="p-3">
                            <div class="text-center">
                                <h4 class="headinput mb-4">Kouta Tanggal 01 Oktober 2023</h4>
                                <p>Kuota Pengunjung Per Hari: {{ $dailyLimitPerDay }}</p>
                                <p>Jumlah Terdaftar (01-10-2023): {{ $registeredCountPerDay01 }}</p>
                                <p>Untuk jam 12.00 - 13.00 Kosong</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Jam</th>
                                                <th>Kouta</th>
                                                <th>Jumlah Terdaftar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($registeredCountPerHour01 as $hourRange => $count)
                                            <tr>
                                                <td>{{ $hourRange }}</td>
                                                <td>{{ $dailyLimitPerHour }}</td>
                                                <td>{{ $count }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container">
        <div class="row">
        </div>
    </div>



    {{-- End Row --}}
    @if (Auth::user()->role == 0 || Auth::user()->role == 1)
        <a href="{{ route('dashboard') }}" class="text-light"> ==> Tombol untuk masuk ke Halaman Admin</a>
    @endif

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



</body>

</html>
