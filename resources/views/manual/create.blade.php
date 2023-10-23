@extends('layout.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <h1>Tambah Data Pengunjung</h1>

    <form method="POST" action="{{ route('manual.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="no_hp">No HP:</label>
            <input type="text" name="no_hp" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="umur">Umur:</label>
            <input type="number" name="umur" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="waktu">Waktu:</label>
            <input type="time" name="waktu" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Data Pengunjung</button>
    </form>
@endsection
