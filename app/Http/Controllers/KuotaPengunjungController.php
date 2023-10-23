<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengunjung;

class KuotaPengunjungController extends Controller
{
    public function index()
    {
        // Hitung kuota pengunjung per hari
        $dailyLimitPerDay = 750;

        // Hitung kuota pengunjung per jam
        $dailyLimitPerHour = 95;
        $registeredCountPerHour30 = [];
        $registeredCountPerHour01 = [];

        for ($i = 8; $i <= 16; $i++) {
            $startHour = sprintf('%02d:00', $i);
            $endHour = sprintf('%02d:00', $i + 1);

            // Hitung kouta pengunjung untuk rentang jam ini
            $countPerHour30 = Pengunjung::whereDate('tanggal', '2023-09-30')
                ->whereBetween('waktu', [$startHour, $endHour])
                ->count();

            $countPerHour01 = Pengunjung::whereDate('tanggal', '2023-10-01')
                ->whereBetween('waktu', [$startHour, $endHour])
                ->count();

            // Format rentang jam (misal: 08.00-09.00)
            $hourRange = sprintf('%02d:00-%02d:00', $i, $i + 1);

            // Tambahkan batasan per jam
            $registeredCountPerHour30[$hourRange] = min($countPerHour30, $dailyLimitPerHour);
            $registeredCountPerHour01[$hourRange] = min($countPerHour01, $dailyLimitPerHour);
        }

        // Batasan (limit) per hari
        $registeredCountPerDay30 = min($this->getRegisteredCountByDate('2023-09-30'), $dailyLimitPerDay);
        $registeredCountPerDay01 = min($this->getRegisteredCountByDate('2023-10-01'), $dailyLimitPerDay);

        return view('kouta', compact(
            'dailyLimitPerDay',
            'registeredCountPerDay30',
            'registeredCountPerDay01',
            'dailyLimitPerHour',
            'registeredCountPerHour30',
            'registeredCountPerHour01'
        ));
    }

    // Fungsi untuk menghitung jumlah pengunjung berdasarkan tanggal
    private function getRegisteredCountByDate($date)
    {
        return Pengunjung::whereDate('tanggal', $date)->count();
    }




}
