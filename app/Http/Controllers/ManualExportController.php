<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manual;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ManualExport; // Ubah dari ExportManual menjadi ManualExport

class ManualExportController extends Controller
{
    public function export(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        return Excel::download(new ManualExport($startDate, $endDate), 'manual.xlsx');
    }
}
