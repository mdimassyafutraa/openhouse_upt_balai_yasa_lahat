<?php
// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\PengunjungExport;

// class ExportController extends Controller
// {
//     public function export(Request $request)
//     {
//         $startDate = $request->input('startDate');
//         $endDate = $request->input('endDate');

//         return Excel::download(new PengunjungExport($startDate, $endDate), 'pengunjung.xlsx');
//     }
// }


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengunjungExport;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $status = $request->input('status'); // Menambahkan parameter status

        return Excel::download(new PengunjungExport($startDate, $endDate, $status), 'pengunjung.xlsx');
    }
}
