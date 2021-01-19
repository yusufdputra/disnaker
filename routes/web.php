<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PengajuanCutiController;

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

// Route::get('layout/', function () {
//     return view('master');
// });

Route::get('/', [LoginController::class, 'index']);

// Route::get('/register', [LoginController::class, 'register']);

Route::post('loginPost', [LoginController::class, 'do_login']);

Route::post('tambah-karyawan', [KaryawanController::class, 'tambah_karyawan']);

Route::post('hapus-karyawan', [KaryawanController::class, 'hapus_karyawan']);

Route::get('logout', [LoginController::class, 'logout']);

Route::get('dashboard', [DashboardController::class, 'index']);

Route::get('pegawai', [KaryawanController::class, 'index']);

Route::get('staff', [StaffController::class, 'index']);

Route::post('tambah-staff', [StaffController::class, 'tambah_staff']);

Route::post('hapus-staff', [StaffController::class, 'hapus_staff']);

Route::get('sisa-cuti', [CutiController::class, 'sisa_cuti']);

Route::get('refresh-cuti', [CutiController::class, 'refresh']);

Route::get('limit', [CutiController::class, 'limit']);

Route::get('cuti-tahun', [CutiController::class, 'cuti_tahun']);

Route::get('cuti-melahirkan', [CutiController::class, 'cuti_melahirkan']);

Route::post('tambah-cuti', [CutiController::class, 'tambah_cuti']);

Route::get('pengajuan-cuti', [PengajuanCutiController::class, 'index']);

Route::post('terima-pengajuan', [PengajuanCutiController::class, 'terima']);

Route::post('tolak-pengajuan', [PengajuanCutiController::class, 'tolak']);

Route::get('riwayat', [RiwayatController::class, 'index']);

Route::post('print', [RiwayatController::class, 'printPDF']);