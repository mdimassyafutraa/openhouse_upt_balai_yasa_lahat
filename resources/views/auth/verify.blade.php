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
<style>
    @media only screen and (max-width: 600px) {
        .veriff{
            font-size: 12px;
        }
}
</style>

<body class="bg-gradient-primary">

    <div class="container">
        {{-- Head Start --}}
        <div class="head text-center">
            <img src="{{ asset('assets/img/logo.png') }}" alt="" width="100">
            <h2 class="text-white TextFormInput" style="font-weight: 600">Selamat Datang Peserta Open House <span>UPT
                    Balai Yasa Lahat</span></h2>
        </div>
        {{-- End --}}

        {{-- Row Start --}}
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-lg-12 mb-3">
                    <div class="card shadow bg-gradient-light">
                        <div class="card-body">
                            <div class="p-3">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header text-center text-bold">{{ __('Link Verifikasi sudah dikirimkan ke Email anda, silahkan di cek kotak masuk / spam') }}</div>
                                            <div class="card-body">
                                                @if (session('resent'))
                                                    <div class="alert alert-success" role="alert">
                                                        <div class="text-center">
                                                            {{ __('Link verifikasi sudah dikirim ke Email anda') }}
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="text-center text-danger">
                                                   <h6> {{ __('Salin link yang di dapat dari email, dan tempelkan di browser') }}</h6>
                                                </div>
                                                <form class="mt-4" method="POST"
                                                    action="{{ route('verification.resend') }}">
                                                    @csrf
                                                    <button type="submit"
                                                        class="veriff btn btn-primary btn-block">{{ __('Kirim Ulang link verifikasi') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="text-center mb-4">
                                    <a href="{{ route('logout') }}">Logout</a>
                                </div>
                                <div class="text-center">
                                    <span>Copyright &copy; UPT Balai Yasa Lahat <?= date('Y') ?></span>
                                </div>
                            </div>
                        </div>
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
