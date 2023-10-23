<?php

namespace App\Http\Controllers;
use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TiketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  public function index()
    {
    // Mendapatkan ID pengguna yang saat ini masuk
    $userId = Auth::id();

    // Mengambil data pengunjung yang terkait dengan ID pengguna saat ini dan status "belum hadir"
    $pengunjung = Pengunjung::where('user_id', $userId)->where('status', 'belum hadir')->get();

    return view('tiket', compact('pengunjung'));
    }



public function destroy($id)
{
    $pengunjung = Pengunjung::findOrFail($id);

    // Pastikan bahwa pengunjung yang akan dihapus adalah milik pengguna yang sedang login
    if ($pengunjung->user_id === auth()->id()) {
        $pengunjung->delete();
        return redirect()->route('tiket')->with('message', 'Data Pengunjung Berhasil dihapus');
    } else {
        return redirect()->route('tiket')->with('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
    }
}


}
