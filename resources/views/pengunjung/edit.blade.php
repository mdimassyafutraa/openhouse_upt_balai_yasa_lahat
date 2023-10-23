@extends('layout.app')
@section('title', 'Edit Pengunjung')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Edit Data Pengunjung</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('pengunjung.update', $pengunjung->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $pengunjung->name }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="umur">Umur:</label>
                    <input type="number" class="form-control" id="umur" name="umur" value="{{ $pengunjung->umur }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" class="form-control" id="alamat" name="alamat"
                        value="{{ $pengunjung->alamat }}" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Profesi:</label>
                    <input type="text" class="form-control" id="profesi" name="profesi"
                        value="{{ $pengunjung->profesi }}" required>
                </div>

                <div class="form-group">
                    <label for="instansi">Instansi:</label>
                    <input type="text" class="form-control" id="instansi" name="instansi"
                        value="{{ $pengunjung->instansi }}" required>
                </div>

                <div class="form-group">
                    <label for="no_telp">No Telepon:</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp"
                        value="{{ $pengunjung->no_telp }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
