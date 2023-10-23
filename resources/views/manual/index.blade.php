@extends('layout.app')

@section('content')

  <div class="container">
        <h2>Jumlah Pengunjung</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jumlah Pengunjung</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>30 September 2023</td>
                    <td>{{ $countVisitorsData['countSeptember30'] }}</td>
                </tr>
                <tr>
                    <td>01 Oktober 2023</td>
                    <td>{{ $countVisitorsData['countOctober1'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    

<form method="POST" action="{{ route('manual.export') }}">

    @csrf
    <div class="form-group">
        <label for="startDate">Tanggal Mulai:</label>
        <input type="date" name="startDate" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="endDate">Tanggal Akhir:</label>
        <input type="date" name="endDate" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Ekspor ke Excel</button>
</form>
    <h1>Daftar Data Pengunjung</h1>

    <a href="{{ route('manual.create') }}" class="btn btn-primary">Tambah Data Pengunjung</a>

  <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class= "text-center">
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Umur</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengunjung as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->alamat }}</td>
                    <td>{{ $data->no_hp }}</td>
                    <td>{{ $data->umur }}</td>
                    <td>{{ $data->tanggal }}</td>
                    <td>{{ $data->waktu }}</td>
                    <td>
                        <a href="{{ route('manual.show', $data->id) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('manual.edit', $data->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('manual.destroy', $data->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
       </div>
            </div>
@endsection
