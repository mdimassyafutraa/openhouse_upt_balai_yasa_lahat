<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\TiketController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KuotaPengunjungController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\ManualExportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes([

//     'register' => true, // Register Route
//     'reset' => false, // Reset Password Route
//     'verify' => false, // Email Verification Route

// ])

// route baru
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/auth', [AuthController::class, 'index'])->name('auth');
    Route::get('unauthorized', [App\Http\Controllers\HomeController::class, 'unauthorized'])->name('unauthorized');
    Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
});

// Route Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route Pengunjung
Route::resource('pengunjung', PengunjungController::class);
Route::get('/pengunjung/{id}/edit-status', [PengunjungController::class, 'editStatus'])->name('pengunjung.edit-status');
Route::put('/pengunjung/{id}/update-status', [PengunjungController::class, 'updateStatus'])->name('pengunjung.update-status');
Route::get('/tiket', [TiketController::class, 'index'])->name('tiket');


// Route Scan Qr-code
Route::get('/scan', [ScanController::class, 'scan'])->name('scan')->middleware('notPetugas');
Route::post('/scanResult', [ScanController::class, 'scanResult'])->name('scanResult');
Route::get('/getPengunjung', [PengunjungController::class, 'getPengunjungByQRCode'])->name('getPengunjung');


Route::delete('/tiket/{id}', [TiketController::class, 'destroy'])->name('tiket.destroy');


Route::post('/scan-result', [ScanController::class, 'scanResult'])->name('scan-result');

// Route::post('/scan-result', 'PengunjungController@scanResult')->name('scan-result');


Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/export-pengunjung', 'App\Http\Controllers\ExportController@export')->name('export-pengunjung');

Route::get('/kouta-pengunjung', [KuotaPengunjungController::class, 'index'])->name('kouta');

Route::resource('manual', ManualController::class);
Route::get('/manual/export', [ManualExportController::class, 'exportForm'])->name('manual.export.form');
Route::post('/manual/export', [ManualExportController::class, 'export'])->name('manual.export');

Route::get('/count-visitors', 'ManualController@countVisitors')->name('manual.countVisitors');
