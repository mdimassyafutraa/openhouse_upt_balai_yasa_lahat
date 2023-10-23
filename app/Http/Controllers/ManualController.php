<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manual;
use Illuminate\Support\Facades\DB;

class ManualController extends Controller
{
       public function index()
    {
        $pengunjung = Manual::all();
        $countVisitorsData = $this->countVisitors(); // Panggil metode countVisitors
        return view('manual.index', compact('pengunjung', 'countVisitorsData'));
    }

    public function create()
    {
        return view('manual.create');
    }

public function store(Request $request)
{
    // Validasi data yang dikirimkan melalui formulir
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'umur' => 'required|integer',
        'no_hp' => 'required|string|max:15',
        'tanggal' => 'required|date',
        'waktu' => 'required|date_format:H:i', // Validasi format waktu (HH:mm)
    ]);

    // Cek apakah ada pengunjung dengan nama dan nomor HP yang sama
    $existingPengunjung = Manual::where('name', $validatedData['name'])
        ->where('no_hp', $validatedData['no_hp'])
         ->where('umur', $validatedData['umur'])
        ->first();

    if ($existingPengunjung) {
        // Jika ada data yang sama, kembalikan ke halaman create dengan pesan error
        return redirect()->route('manual.create')
            ->withInput() // Menampilkan data yang sudah diisi
             ->withErrors(['name' => 'Data pengunjung dengan nama, nomor HP, dan umur yang sama sudah tersimpan.']);
    }

    // Jika tidak ada data yang sama, simpan data ke dalam database menggunakan model Manual
    Manual::create($validatedData);

    // Redirect ke halaman yang sesuai atau lakukan tindakan lain setelah penyimpanan
    return redirect()->route('manual.index')->with('success', 'Data pengunjung berhasil disimpan.');
}



    public function show($id)
    {
        $pengunjung = Manual::findOrFail($id);
        return view('manual.show', compact('pengunjung'));
    }

    public function edit($id)
    {
        $pengunjung = Manual::findOrFail($id);
        return view('manual.edit', compact('pengunjung'));
    }


    public function update(Request $request, $id)
    {
        // Validasi data yang dikirimkan melalui formulir
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'umur' => 'required|integer',
            'no_hp' => 'required|string|max:15',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i', // Validasi format waktu (HH:mm)
        ]);

        // Temukan data pengunjung yang akan diperbarui
        $pengunjung = Manual::findOrFail($id);

        // Perbarui data pengunjung
        $pengunjung->update($validatedData);

        // Redirect ke halaman manual.index setelah berhasil diperbarui
        return redirect()->route('manual.index')->with('success', 'Data pengunjung berhasil diperbarui.');
    }


    public function destroy($id)
{
    // Temukan data pengunjung yang akan dihapus
    $pengunjung = Manual::findOrFail($id);

    // Hapus data pengunjung
    $pengunjung->delete();

    // Redirect ke halaman yang sesuai atau lakukan tindakan lain setelah penghapusan
    return redirect()->route('manual.index')->with('success', 'Data pengunjung berhasil dihapus.');
}

 public function countVisitors()
    {
        $countSeptember30 = Manual::whereDate('tanggal', '2023-09-30')->count();
        $countOctober1 = Manual::whereDate('tanggal', '2023-10-01')->count();

        // Mengembalikan data dalam bentuk array asosiatif
        return [
            'countSeptember30' => $countSeptember30,
            'countOctober1' => $countOctober1,
        ];
    }





}
