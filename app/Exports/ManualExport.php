<?php

namespace App\Exports;

use App\Models\Manual;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ManualExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Manual::whereBetween('tanggal', [$this->startDate, $this->endDate])
            ->select('name', 'alamat', 'umur', 'no_hp', 'tanggal', 'waktu')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Alamat',
            'Umur',
            'No HP',
            'Tanggal',
            'Waktu',
        ];
    }
}
