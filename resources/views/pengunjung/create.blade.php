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

    <style>
        @media (max-width: 768px) {
            #waktuLevels {
                width: 100%;
                font-size: 14px;
            }
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <nav class="navbar navbar-expand-lg navbar-light bg-gradient-primary ">
        <div class="container">
            <a class="navbar-brand text-white font-weight-bold" href="{{ route('pengunjung.create') }}"><img src="{{asset('assets/img/logo.png')}}" alt="logo" width="50px"> BYLT
            </a>
            <button class="navbar-toggler text-white" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation" style="border: 1px solid white">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive" >
                <div class="navbar-nav font-weight-bold">
                    <a class="nav-item nav-link text-white" href="{{ route('pengunjung.create') }}">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link text-white" href="{{ route('tiket') }}">Tiket <span class="sr-only">(current)</span></a>
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

    <div class="container">
        {{-- Head Start --}}
        <div class="head text-center">
            <!--<img src="{{ asset('assets/img/logo.png') }}" alt="" width="100">-->
                        <img src="{{ asset('assets/img/openhouse.png') }}" alt="" width="200">
            <h2 class="text-white TextFormInput" style="font-weight: 600">Selamat Datang Peserta Open House <br> UPT
                Balai Yasa Lahat
            </h2>
        </div>
        {{-- End --}}
        {{-- Row Start --}}
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-lg-6 mb-3">
                    <div class="card shadow bg-gradient-light">
                        <div class="card-body">
                            <div class="p-3">
                                <div class="text-center">
                                    <h4 class="headinput mb-4">Silahkan Daftar Terlebih Dahulu</h4>
                                    <p style="font-size: 14px;" class="text-gray">Acara Dimulai Tanggal 30 September dan 1 Oktober 2023</p>
                                </div>
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form class="user" method="POST" action="{{ route('pengunjung.store') }}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input type="date" class="form-control form-control-user" name="tanggal"
                                                id="tanggal" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <select name="waktuLevels" id="waktuLevels" class="form-control" required>
                                                <option value="" disabled selected>Waktu Kunjungan</option>
                                                @foreach ($waktuLevels as $waktuLevel)
                                                    <option value="{{ $waktuLevel->waktu }}">{{ $waktuLevel->waktu }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control form-control-user" name="name"
                                                placeholder="Nama sesuai KTP" value="{{ old('name') }}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control form-control-user" name="alamat"
                                                placeholder="Alamat sesuai KTP" value="{{ old('alamat') }}" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="number" class="form-control form-control-user" name="umur"
                                                placeholder="Umur" value="{{ old('umur') }}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control form-control-user" name="profesi"
                                                placeholder="Profesi" value="{{ old('profesi') }}" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control form-control-user" name="instansi"
                                                placeholder="Instansi" value="{{ old('instansi') }}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="number" class="form-control form-control-user" name="no_telp"
                                                placeholder="Nomor Telepon" value="{{ old('no_telp') }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-user btn-block"
                                            onclick="return confirm('Apakah Sudah Benar Data Anda?')">Simpan
                                        </button>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <span>Copyright &copy; UPT Balai Yasa Lahat <?= date('Y') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Row --}}
        @if (Auth::user()->role == 0 || Auth::user()->role == 1)

        <a href="{{ route('dashboard') }}" class="text-light"> ==> Tombol untuk masuk ke Halaman {{ Auth::user()->name }}</a>
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
