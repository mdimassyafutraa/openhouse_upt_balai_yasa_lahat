@extends('layout.app')
@section('title', 'Daftar Pengunjung')
@section('content')
    @if (auth()->user()->role == 0 || auth()->user()->role == 1)
        <h1 class="h3 mb-2 text-gray-800">Daftar Data Pengunjung</h1>
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-6">
                <!-- Tampilkan jumlah pengunjung yang sudah hadir pada tanggal 30 September -->
                <p>Jumlah Pengunjung Sudah Hadir (30 September): {{ $sudahHadirCount30Sep }}</p>
            </div>
            <div class="col-md-6">
                <!-- Tampilkan jumlah pengunjung yang sudah hadir pada tanggal 1 Oktober -->
                <p>Jumlah Pengunjung Sudah Hadir (01 Oktober): {{ $sudahHadirCount01Oct }}</p>
            </div>
                    <div class="col-md-6">
                        <a href="{{ route('pengunjung.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Pengunjung</a>
                    </div>
                    <div class="col-md-6">
                        <!--<form action="{{ route('export-pengunjung') }}" method="POST" class="d-inline">-->
                        <!--    @csrf-->
                        <!--    <div class="form-group row">-->
                        <!--        <div class="col-md-6">-->
                        <!--            <label for="startDate">Start Date</label>-->
                        <!--            <input type="date" name="startDate" id="startDate" class="form-control" required>-->
                        <!--        </div>-->
                        <!--        <div class="col-md-6">-->
                        <!--            <label for="endDate">End Date</label>-->
                        <!--            <input type="date" name="endDate" id="endDate" class="form-control" required>-->
                        <!--        </div>-->
                        <!--        <div class="col-md-12 mt-4">-->
                        <!--            <button type="submit" class="btn btn-success btn-sm btn-block"><i class="fas fa-file-excel"></i> Export to Excel</button>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</form>-->
                        
                         <form action="{{ route('export-pengunjung') }}" method="POST" class="d-inline">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="startDate">Start Date</label>
                            <input type="date" name="startDate" id="startDate" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="endDate">End Date</label>
                            <input type="date" name="endDate" id="endDate" class="form-control" required>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label>Status</label><br>
                            <input type="radio" name="status" value="sudah-hadir"> Sudah Hadir
                            <input type="radio" name="status" value="belum-hadir"> Belum Hadir
                            <input type="radio" name="status" value="keduanya" checked> Keduanya
                        </div>
                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn btn-success btn-sm btn-block"><i class="fas fa-file-excel"></i> Export to Excel</button>
                        </div>
                    </div>
                </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>QR Code</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Alamat</th>
                                <th>Profesi</th>
                                <th>Instansi</th>
                                <th>No Telepon</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($pengunjung as $key => $visit)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{!! QrCode::size(100)->generate($visit->qr_code) !!}</td>
                                    <td>{{ $visit->name }}</td>
                                    <td>{{ $visit->umur }}</td>
                                    <td style="word-break: break-all">{{ $visit->alamat }}</td>
                                    <td>{{ $visit->profesi }}</td>
                                    <td>{{ $visit->instansi }}</td>
                                    <td>{{ $visit->no_telp }}</td>
                                    <td>{{ $visit->tanggal }}</td>
                                    <td>{{ $visit->waktu }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('pengunjung.update-status', $visit->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="btn-group">
                                                <button type="button"
                                                    class="btn btn-{{ $visit->status === 'Belum Hadir' ? 'danger' : 'success' }} dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{ $visit->status }}
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button class="dropdown-item" type="submit" name="status"
                                                        value="Belum Hadir">Belum Hadir</button>
                                                    <button class="dropdown-item" type="submit" name="status"
                                                        value="Sudah Hadir">Sudah Hadir</button>
                                                </div>
                                            </div>
                                        </form>

                                    </td>
                                    <td>
                                        <a href="{{ route('pengunjung.show', $visit->id) }}"
                                            class="btn btn-primary btn-sm m-2">
                                            <i class="fas fa-search"></i>
                                        </a>
                                        <a href="{{ route('pengunjung.edit', $visit->id) }}"
                                            class="btn btn-warning btn-sm m-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('pengunjung.destroy', $visit->id) }}" method="POST"
                                            style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm m-2"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @elseif(auth()->user()->role == 2)
        <h2 class="text-center">Halaman ini hanya bisa diakses petugas</h2>
    @endif

@endsection
