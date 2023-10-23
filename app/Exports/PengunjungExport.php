<?php

// namespace App\Exports;

// use App\Models\Pengunjung;
// use Maatwebsite\Excel\Concerns\FromCollection;

// class PengunjungExport implements FromCollection
// {
//     protected $startDate;
//     protected $endDate;

//     public function __construct($startDate, $endDate)
//     {
//         $this->startDate = $startDate;
//         $this->endDate = $endDate;
//     }

//     public function collection()
//     {
//         return Pengunjung::whereBetween('tanggal', [$this->startDate, $this->endDate])->get();
//     }
// }



namespace App\Exports;

use App\Models\Pengunjung;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use App\Pengunjung;

class PengunjungExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;
    protected $status;

    public function __construct($startDate, $endDate, $status)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = $status;
    }

    public function collection()
    {
        $query = Pengunjung::whereBetween('tanggal', [$this->startDate, $this->endDate]);

        // Filter berdasarkan status yang dipilih
        if ($this->status === 'sudah-hadir') {
            $query->where('status', 'Sudah Hadir');
        } elseif ($this->status === 'belum-hadir') {
            $query->where('status', 'Belum Hadir');
        }

        $pengunjung = $query->get(['name', 'alamat', 'no_telp', 'umur', 'tanggal', 'waktu', 'status']);

        return $pengunjung;
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Alamat',
            'No HP',
            'Umur',
            'Tanggal',
            'Waktu',
            'Status',
        ];
    }
}
