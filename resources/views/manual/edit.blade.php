@extends('layout.app')

@section('content')
    <h1>Edit Data Pengunjung</h1>

    <form method="POST" action="{{ route('manual.update', $pengunjung->id) }}">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" name="name" class="form-control" value="{{ $pengunjung->name }}" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" class="form-control" value="{{ $pengunjung->alamat }}" required>
        </div>
        <div class="form-group">
            <label for="no_hp">No HP:</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $pengunjung->no_hp }}" required>
        </div>
        <div class="form-group">
            <label for="umur">Umur:</label>
            <input type="number" name="umur" class="form-control" value="{{ $pengunjung->umur }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $pengunjung->tanggal }}" required>
        </div>
        <div class="form-group">
            <label for="waktu">Waktu:</label>
            <input type="time" name="waktu" class="form-control" value="{{ $pengunjung->waktu }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
@endsection
