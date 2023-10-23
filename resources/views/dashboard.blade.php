@extends('layout.app')
@section('title', 'Dashboard')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard {{ Auth::user()->name }}</h1>
    </div>

    {{-- Statistik Start --}}
    <div class="row">
        @if (Auth::user()->role == 0)
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pengunjung Hari Ini
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <i class="fas fa-users mr-2"></i>{{ $visitorCountToday }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pengunjung Kemarin
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <i class="fas fa-calendar-day mr-2"></i>{{ $visitorCountYesterday }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pengunjung Minggu Ini
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <i class="fas fa-calendar-day mr-2"></i>{{ $visitorCountOneWeek }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pengunjung Bulan Ini
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <i class="fas fa-calendar-week mr-2"></i>{{ $visitorCountThisMonth }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pengunjung Tahun Ini
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <i class="fas fa-calendar-week mr-2"></i>
                            @if (isset($yearlyStats['data']) && count($yearlyStats['data']) > 0)
                                {{ $yearlyStats['data'][count($yearlyStats['data']) - 1] }}
                            @else
                                Tidak ada data
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Keseluruhan Pengunjung
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <i class="fas fa-chart-bar mr-2"></i>{{ $visitorCountTotal }}
                        </div>
                    </div>
                </div>
            </div>
    </div>
    {{-- Statistik End --}}

    {{-- Grafik Start --}}


    <div class="row">
        <div class="col-xl-7 col-lg-8">
            <div class="card shadow mb-4">
                {{-- Dropdown Ganti Tampilan Grafik --}}
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Diagram Data Pengunjung</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="chartviewDropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="chartviewDropdown">
                            <h6 class="dropdown-header">Pilih Tampilan:</h6>
                            <a class="dropdown-item" onclick="changeChartView('weekly')">Mingguan</a>
                            <a class="dropdown-item" onclick="changeChartView('monthly')">Bulanan</a>
                            <a class="dropdown-item" onclick="changeChartView('yearly')">Tahunan</a>
                        </div>
                    </div>
                </div>

                {{-- Chart Start --}}
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="dashboardChart" class="chart"></canvas>
                    </div>
                </div>
                {{-- Chart End --}}
            </div>
        </div>
        {{-- Grafik End --}}

        <!-- Pie Chart -->
        <div class="col-xl-5 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Umur Pengunjung</h6>
                    <div class="dropdown no-arrow">
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        {{-- Pie End --}}
    </div>
    @endif

    {{-- @if (Auth::user()->role == 2)
        <div class="col-xl-3 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <a href="#" style="text-decoration: none">
                        <div class="row">
                            <div class="col-8 text-lg font-weight-bold text-primary text-uppercase mb-1">
                                Daftar Sebagai Peserta
                            </div>
                            <div class="col-4 h1 mb-0 font-weight-bold text-gray-800">
                                <i class="fas fa-users mr-2"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 mb-4">
            <div class="card border-left-danger shadow h-100">
                <div class="card-body">
                    <a href="#" style="text-decoration: none">
                    <div class="row">
                        <div class="col-8 text-lg font-weight-bold text-primary text-uppercase mb-1">
                            History Pendaftaran
                        </div>
                        <div class="col-4 h1 mb-0 font-weight-bold text-gray-800">
                            <i class="fas fa-calendar-day mr-2"></i>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    @endif --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Js Grafik --}}
    <script>
        // Data awal untuk chart (mingguan)
        var chartData = {
            labels: {!! json_encode($weeklyStats['labels']) !!},
            datasets: [{
                label: 'Pengunjung',
                data: {!! json_encode($weeklyStats['data']) !!},
                fill: false, // Menghapus pengisian area di bawah garis
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                pointBackgroundColor: 'rgba(75, 192, 192, 1)',
            }]
        };

        var chartCanvas = document.getElementById('dashboardChart').getContext('2d');
        var dashboardChart = new Chart(chartCanvas, {
            type: 'line', // Mengubah tipe grafik menjadi line
            data: chartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Fungsi untuk mengubah tampilan chart berdasarkan pilihan
        function changeChartView(view) {
            if (view === 'weekly') {
                chartData.labels = {!! json_encode($weeklyStats['labels']) !!};
                chartData.datasets[0].data = {!! json_encode($weeklyStats['data']) !!};
            } else if (view === 'monthly') {
                chartData.labels = {!! json_encode($monthlyStats['labels']) !!};
                chartData.datasets[0].data = {!! json_encode($monthlyStats['data']) !!};
            } else if (view === 'yearly') {
                chartData.labels = {!! json_encode($yearlyStats['labels']) !!};
                chartData.datasets[0].data = {!! json_encode($yearlyStats['data']) !!};
            }
            dashboardChart.update(); // Memperbarui tampilan chart
        }
    </script>

    {{-- JS Pie Chart --}}

    <script>
        // Data umurGroups
        var umurGroups = {
            labels: [
                'Dibawah 18 Tahun',
                '18-30 Tahun',
                '31-50 Tahun',
                '51-65 Tahun',
                'Diatas 65 Tahun'
            ],
            datasets: [{
                data: [
                    {{ $umurGroups['Dibawah 18 Tahun'] }},
                    {{ $umurGroups['18-30 Tahun'] }},
                    {{ $umurGroups['31-50 Tahun'] }},
                    {{ $umurGroups['51-65 Tahun'] }},
                    {{ $umurGroups['Diatas 65 Tahun'] }}
                ],
                backgroundColor: ['#AEC3AE', '#78D6C6', '#419197', '#12486B', '#0C356A', ],
                // Warna latar belakang setiap bagian pie chart
            }],
        };

        // Konfigurasi grafik pie chart
        var pieConfig = {
            type: 'pie',
            data: umurGroups,
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        };

        // Inisialisasi chart pada canvas dengan id "myPieChart"
        var ctx = document.getElementById('myPieChart').getContext('2d');
        new Chart(ctx, pieConfig);
    </script>

@endsection
