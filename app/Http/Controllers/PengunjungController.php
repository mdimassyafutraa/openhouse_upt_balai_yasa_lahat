<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengunjung;
use App\Models\WaktuLevel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PengunjungController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function index()
{
    $pengunjung = Pengunjung::all();

    // Hitung jumlah pengunjung dengan status "Sudah Hadir" pada tanggal 30 September
    $sudahHadirCount30Sep = Pengunjung::where('status', 'Sudah Hadir')
        ->whereDate('tanggal', '2023-09-30')
        ->count();

    // Hitung jumlah pengunjung dengan status "Sudah Hadir" pada tanggal 1 Oktober
    $sudahHadirCount01Oct = Pengunjung::where('status', 'Sudah Hadir')
        ->whereDate('tanggal', '2023-10-01')
        ->count();

    return view('pengunjung.index', compact('pengunjung', 'sudahHadirCount30Sep', 'sudahHadirCount01Oct'));
}


    public function create()
{
    $waktuLevels = WaktuLevel::all();

    return view('pengunjung.create', compact('waktuLevels'));
}

public function store(Request $request)
{
    $userId = Auth::id();
    $customMessages = [
        'tanggal.in' => 'Anda hanya dapat memilih tanggal 30 September 2023 atau 01 Oktober 2023.',
        'name.unique' => 'Data anda sudah terdaftar, silahkan cek di bagian tiket',
        'data_exists' => 'Data sudah terdaftar.',
        'umur.regex' => 'Masukan Umur dengan benar, jika bayi, isi saja 1',
        'no_telp.regex' => 'Masukan No Telepon yang benar',

    ];

    $request->validate([
        // 'name' => 'required',
        // 'umur' => 'required',
        // 'alamat' => 'required',
        // 'profesi' => 'required',
        // 'instansi' => 'required',
        // 'no_telp' => 'required',
        // 'tanggal' => 'required|date_format:Y-m-d|in:2023-09-30,2023-10-01',
        // 'waktuLevels' => 'required', // Ubah 'waktu' menjadi 'waktuLevels'
        'name' => 'required|unique:pengunjungs,name,NULL,id,no_telp,' . $request->input('no_telp'),
        'umur' => 'required|regex:/[1-9]/',
        'alamat' => 'required',
        'profesi' => 'required',
        'instansi' => 'required',
        'no_telp' => ['required', 'regex:/[1-9]/', 'regex:/[0-9]{2,}/'],
        'tanggal' => 'required|date_format:Y-m-d|in:2023-09-30,2023-10-01',
        'waktuLevels' => 'required',
        'data_exists' => function ($attribute, $value, $fail) use ($request) {
            // Memeriksa apakah data yang sama sudah ada dalam database
            $existingData = Pengunjung::where('name', $request->input('name'))
                ->where('no_telp', $request->input('no_telp'))
                ->where('umur', $request->input('umur'))
                ->where('alamat', $request->input('alamat'))
                ->where('profesi', $request->input('profesi'))
                ->where('instansi', $request->input('instansi'))
                ->where('tanggal', $request->input('tanggal'))
                ->where('waktu', $request->input('waktuLevels'))
                ->count();

            if ($existingData > 0) {
                $fail('Data yang sama sudah ada dalam database.');
            }
        },
    ], $customMessages);

    $tanggalDipilih = $request->input('tanggal'); // Pindahkan ini ke sini

    $registeredCountPerDay = Pengunjung::whereDate('tanggal', $tanggalDipilih)->count();
    $registeredCountPerHour = Pengunjung::whereDate('tanggal', $tanggalDipilih)
    ->where('waktu', $request->input('waktuLevels')) // Ubah 'waktu' menjadi 'waktuLevels'
    ->count();
    $dailyLimitPerDay = 750;
    $dailyLimitPerHour = 95;

    if ($tanggalDipilih == '2023-09-30' || $tanggalDipilih == '2023-10-01') {
    // Cek apakah sudah mencapai batas per hari
    if ($registeredCountPerDay >= $dailyLimitPerDay) {
        return redirect()->back()->with('error', 'Maaf, kuota pengunjung per hari sudah terpenuhi.');
    }

    // Cek apakah sudah mencapai batas per jam
    if ($registeredCountPerHour >= $dailyLimitPerHour) {
        return redirect()->back()->with('error', 'Maaf, kuota pengunjung untuk jam ini sudah terpenuhi.');
    }
    } else {
    // Tanggal tidak valid
    return redirect()->back()->with('error', 'Anda hanya dapat memilih tanggal 30 September 2023 atau 01 Oktober 2023.');
    }


    $pengunjung = new Pengunjung();
    $pengunjung->qr_code = Str::random(20);
    $pengunjung->name = $request->input('name');
    $pengunjung->umur = $request->input('umur');
    $pengunjung->alamat = $request->input('alamat');
    $pengunjung->profesi = $request->input('profesi');
    $pengunjung->instansi = $request->input('instansi');
    $pengunjung->no_telp = $request->input('no_telp');
    $pengunjung->tanggal = $tanggalDipilih;

    // Set waktu kunjungan berdasarkan ID yang dipilih oleh pengguna
    $pengunjung->waktu = $request->input('waktuLevels'); // Ubah 'waktu' menjadi 'waktuLevels'

    // Set status kehadiran pengunjung sebagai "Belum Hadir" secara otomatis
    $pengunjung->status = 'Belum Hadir';

    $pengunjung->user_id = $userId;

    $pengunjung->save();
    session()->flash('success', 'Data Berhasil di Simpan');

    return redirect()->route('tiket');
}



public function editStatus($id)
{
    $pengunjung = Pengunjung::findOrFail($id);
    return view('pengunjung.edit-status', compact('pengunjung'));
}

public function updateStatus(Request $request, $id)
{
    $pengunjung = Pengunjung::findOrFail($id);

    $request->validate([
        'status' => 'required|in:Belum Hadir,Sudah Hadir',
    ]);

    $pengunjung->status = $request->input('status');
    $pengunjung->save();

    return redirect()->route('pengunjung.index')->with('message', 'Status Pengunjung Berhasil di Perbarui');
}

    public function show($id)
    {
    $pengunjung = Pengunjung::findOrFail($id);
    return view('pengunjung.show', compact('pengunjung'));
    }


    public function edit($id)
    {
        $pengunjung = Pengunjung::findOrFail($id);
        return view('pengunjung.edit', compact('pengunjung'));
    }

    public function update(Request $request, $id)
    {
        $pengunjung = Pengunjung::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'umur' => 'required',
            'alamat' => 'required',
            'profesi' => 'required',
            'instansi' => 'required',
            'no_telp' => 'required',
        ]);

        $pengunjung->name = $request->input('name');
        $pengunjung->umur = $request->input('umur');
        $pengunjung->profesi = $request->input('profesi');
        $pengunjung->instansi = $request->input('instansi');
        $pengunjung->alamat = $request->input('alamat');
        $pengunjung->no_telp = $request->input('no_telp');

        $pengunjung->save();
        return redirect()->route('pengunjung.index')->with('message', 'Data Pengunjung Berhasil di Update');
    }

    public function destroy($id)
    {
        $pengunjung = Pengunjung::findOrFail($id);
        $pengunjung->delete();

        return redirect()->route('pengunjung.index')->with('message', 'Data Pengunjung Berhasil dihapus');
    }

}
