@extends('layout.app')

@section('content')
    <h1>Detail Data Pengunjung</h1>

    <table class="table">
        <tr>
            <th>Nama:</th>
            <td>{{ $pengunjung->name }}</td>
        </tr>
        <tr>
            <th>Alamat:</th>
            <td>{{ $pengunjung->alamat }}</td>
        </tr>
        <tr>
            <th>No HP:</th>
            <td>{{ $pengunjung->no_hp }}</td>
        </tr>
        <tr>
            <th>Umur:</th>
            <td>{{ $pengunjung->umur }}</td>
        </tr>
        <tr>
            <th>Tanggal:</th>
            <td>{{ $pengunjung->tanggal }}</td>
        </tr>
        <tr>
            <th>Waktu:</th>
            <td>{{ $pengunjung->waktu }}</td>
        </tr>
    </table>

    <a href="{{ route('manual.index') }}" class="btn btn-primary">Kembali</a>
@endsection
