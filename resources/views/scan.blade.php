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
            <a class="navbar-brand text-white font-weight-bold" href="{{ route('scan') }}"><img
                    src="{{ asset('assets/img/logo.png') }}" alt="logo" width="50px"> BYLT
            </a>
            <button class="navbar-toggler text-white" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation" style="border: 1px solid white">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a href="{{ route('dashboard') }}" class="text-light"><i class="fas fa-home">Dashboard</i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        {{-- Head Start --}}
        <div class="head text-center">
            <img src="{{ asset('assets/img/logo.png') }}" alt="" width="100">
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
                                    <h4 class="headinput mb-4">Scan QR Code</h4>
                                </div>
                                <div id="reader" style="width: 100%;"></div>
                                @if (isset($pengunjung))
                                    <div class="alert alert-info">
                                        <p>Data Pengunjung:</p>
                                        <p>Nama: {{ $pengunjung->name }}</p>
                                        {{-- <p>Alamat: {{ $pengunjung->alamat }}</p> --}}
                                        <p>Tanggal: {{ $pengunjung->tanggal }}</p>
                                        <p>Waktu: {{ $pengunjung->waktu }}</p>
                                    </div>
                                @endif
                                <form action="{{ route('scanResult') }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="decodedText" name="decodedText" value="">
                                    <!-- Tombol Submit QR Code -->
                                    <button type="submit" class="btn btn-primary btn-block mt-4">Submit QR
                                        Code</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- End Row --}}
    </div>

    {{-- Scan QR Code --}}
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        // function onScanSuccess(decodedText, decodedResult) {
        //     // Mengisi nilai input dengan hasil scan QR code
        //     document.getElementById('decodedText').value = decodedText;
        //     // handle the scanned code as you like
        //     console.log(`Code matched = ${decodedText}`, decodedResult);
        // }

        // function onScanFailure(error) {
        //     // handle scan failure, usually better to ignore and keep scanning
        //     // for example:
        //     // console.warn(`Code scan error = ${error}`);
        // }


        // let html5QrcodeScanner = new Html5QrcodeScanner(
        //     "reader", {
        //         fps: 10,
        //         qrbox: {
        //             width: 250,
        //             height: 250
        //         }
        //     },
        //     /* verbose= */
        //     false);
        // html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        
        // =================================================
        
        function onScanSuccess(decodedText, decodedResult) {
            // Mengisi nilai input dengan hasil scan QR code
            document.getElementById('decodedText').value = decodedText;
            // handle the scanned code as you like
            console.log(`Code matched = ${decodedText}`, decodedResult);
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning
            // for example:
            // console.warn(`Code scan error = ${error}`);
        }


        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>

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
