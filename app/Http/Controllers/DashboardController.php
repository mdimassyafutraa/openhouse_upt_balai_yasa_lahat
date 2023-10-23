<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use App\Models\User;
use App\Models\WaktuLevel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        // if (!auth()->user()->hasRole('admin')) {
        //     return redirect()->route('unauthorized');
        // }

        // if (Session::has('id')){
        //     $name = User::where('id', Session::get('id'))->first();
        //     Session::put('id', $name->id);
        //     Session::put('name', $name->name);
        //

        $umurGroups = [
            'Dibawah 18 Tahun' => Pengunjung::where('umur', '<', 18)->count(),
            '18-30 Tahun' => Pengunjung::whereBetween('umur', [18, 30])->count(),
            '31-50 Tahun' => Pengunjung::whereBetween('umur', [31, 50])->count(),
            '51-65 Tahun' => Pengunjung::whereBetween('umur', [51, 65])->count(),
            'Diatas 65 Tahun' => Pengunjung::where('umur', '>', 65)->count(),
        ];

        $pengunjung = Pengunjung::whereDate('tanggal', now())->get();

        // Membuat objek instansi Carbon
        $carbon = new Carbon();

        // Mengatur zona waktu pada objek instansi Carbon
        $carbon->setTimeZone('Asia/Jakarta');

        // Hitung statistik pengunjung
        $today = Carbon::today();
        $yesterday = Carbon::today()->subDay();
        $firstDayOfMonth = Carbon::now()->firstOfMonth();
        $lastDayOfMonth = Carbon::now()->lastOfMonth();
        $oneWeekAgo = Carbon::today()->subWeek(); // Satu minggu yang lalu
        $now = Carbon::now(); // Waktu saat ini

        $visitorCountToday = Pengunjung::whereDate('created_at', $today)->count();
        $visitorCountYesterday = Pengunjung::whereDate('created_at', $yesterday)->count();
        $visitorCountOneWeek = Pengunjung::whereBetween('created_at', [$oneWeekAgo, $now])->count();

        // Hitung jumlah pengunjung mulai dari tanggal 1 hingga saat ini
        $visitorCountThisMonth = Pengunjung::whereBetween('created_at', [$firstDayOfMonth, $now])->count();

        $visitorCountTotal = Pengunjung::count();

        // Menghitung data statistik pengunjung per minggu, per bulan, dan per tahun
        $weeklyStats = $this->calculateWeeklyStats();
        $monthlyStats = $this->calculateMonthlyStats();
        $yearlyStats = $this->calculateYearlyStats();
        // if (Auth::check()) {

            $waktuLevels = WaktuLevel::all();
            if (auth()->user()->role == 0 || auth()->user()->role == 1 ) {
                return view('dashboard', compact(
                    'pengunjung',
                    'visitorCountToday',
                    'visitorCountYesterday',
                    'visitorCountOneWeek',
                    'visitorCountThisMonth',
                    'visitorCountTotal',
                    'weeklyStats',
                    'monthlyStats',
                    'yearlyStats',
                    'umurGroups',
                    'waktuLevels'
                ));
            }
            else if (auth()->user()->role == 2) {
                return view('pengunjung.create', compact('waktuLevels'));
            }
            else {
                return redirect('/login');
            }
        // }
    }

    public function calculateWeeklyStats()
    {
        $weeklyStats = [];
        $labels = [];
        $data = [];

        // Hitung data pengunjung per minggu selama 4 minggu terakhir
        for ($i = 3; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();

            // Hitung jumlah pengunjung dalam rentang waktu ini
            $visitorCount = Pengunjung::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();

            // Format label minggu
            $labels[] = $startOfWeek->format('M d') . ' - ' . $endOfWeek->format('M d');
            $data[] = $visitorCount;
        }

        $weeklyStats['labels'] = $labels;
        $weeklyStats['data'] = $data;

        return $weeklyStats;
    }

    public function calculateMonthlyStats()
    {
        $monthlyStats = [];
        $labels = [];
        $data = [];

        // Hitung data pengunjung per bulan selama 6 bulan terakhir
        for ($i = 5; $i >= 0; $i--) {
            $startOfMonth = Carbon::now()->subMonths($i)->firstOfMonth();
            $endOfMonth = Carbon::now()->subMonths($i)->lastOfMonth();

            // Hitung jumlah pengunjung dalam rentang waktu ini
            $visitorCount = Pengunjung::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

            // Format label bulan
            $labels[] = $startOfMonth->format('M Y');
            $data[] = $visitorCount;
        }

        $monthlyStats['labels'] = $labels;
        $monthlyStats['data'] = $data;

        return $monthlyStats;
    }

    public function calculateYearlyStats()
    {
        $yearlyStats = [];
        $labels = [];
        $data = [];

        // Hitung data pengunjung per tahun selama 5 tahun terakhir
        for ($i = 4; $i >= 0; $i--) {
            $startOfYear = Carbon::now()->subYears($i)->firstOfYear();
            $endOfYear = Carbon::now()->subYears($i)->lastOfYear();

            // Hitung jumlah pengunjung dalam rentang waktu ini
            $visitorCount = Pengunjung::whereBetween('created_at', [$startOfYear, $endOfYear])->count();

            // Format label tahun
            $labels[] = $startOfYear->format('Y');
            $data[] = $visitorCount;
        }

        $yearlyStats['labels'] = $labels;
        $yearlyStats['data'] = $data;

        return $yearlyStats;
    }
}
