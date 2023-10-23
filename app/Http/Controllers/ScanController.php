<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengunjung;
// use QrCode;

class ScanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function scan()
    {
        return view('scan');
    }

    public function scanResult(Request $request)
    {
        // Mendapatkan data QR code yang berhasil dipindai dari request
        $qrCodeData = $request->input('decodedText');

        // Mencari pengunjung berdasarkan QR code yang sesuai
        $pengunjung = Pengunjung::where('qr_code', $qrCodeData)->first();

        // Jika pengunjung ditemukan, maka ubah statusnya menjadi "Sudah Hadir"
        if ($pengunjung) {
            $pengunjung->status = 'Sudah Hadir';
            $pengunjung->save();

            // Hapus data pemindaian QR code setelah berhasil diproses
            $request->session()->forget('decodedText');
            return view('scan', ['pengunjung' => $pengunjung])
            ->with('success', 'Selamat, Anda sudah berhasil scan QR code dan status Anda telah diubah menjadi "Sudah Hadir".');

            return redirect()->route('scan')->with('success', 'Selamat, Anda sudah berhasil scan QR code dan status Anda telah diubah menjadi "Sudah Hadir".');
        }

        // Jika QR code tidak cocok dengan data pengunjung, berikan pesan kesalahan
        return redirect()->route('scan')->with('error', 'QR code tidak valid atau tidak sesuai dengan data pengunjung.');
    }
}
