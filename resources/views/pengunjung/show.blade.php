@extends('layout.app')
@section('title', 'Detail Pengunjung')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Detail Data Pengunjung</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered table">
                <tbody>
                    <tr>
                        <th>Nama:</th>
                        <td>{{ $pengunjung->name }}</td>
                    </tr>
                    <tr>
                        <th>Umur:</th>
                        <td>{{ $pengunjung->umur }}</td>
                    </tr>
                    <tr>
                        <th>Alamat:</th>
                        <td>{{ $pengunjung->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Profesi:</th>
                        <td>{{ $pengunjung->profesi }}</td>
                    </tr>
                    <tr>
                        <th>Instansi:</th>
                        <td>{{ $pengunjung->instansi }}</td>
                    </tr>
                    <tr>
                        <th>No Telepon:</th>
                        <td>{{ $pengunjung->no_telp }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal:</th>
                        <td>{{ $pengunjung->tanggal }}</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('pengunjung.index') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
@endsection
