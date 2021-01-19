<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\CutiModel;
use App\Models\KaryawanModel;
use App\Models\SisaCutiModel;
use App\Models\StaffModel;
use Barryvdh\DomPDF\Facade as PDF;
use printPDF;

class RiwayatController extends Controller
{
    public function index()
    {
        if (!Session::get('status_login')) {
            return redirect('/')->with('alert', 'Kamu harus login!');
        } else {

            $jabatan = Session::get('jabatan');
            if ($jabatan == 'Kepala Dinas' || $jabatan == 'Sekretaris' || $jabatan == 'Kasubag' || $jabatan == 'Admin') {
                $data_cuti = CutiModel::select('users.*','cuti.*', 'cuti.id AS id_pengajuan_cuti','jabatan.nama AS nama_bagian')
                    ->join('users', 'cuti.nip', '=', 'users.nip')
                    ->join('sisa_cuti', 'cuti.nip', '=', 'sisa_cuti.nip')
                    ->join('jabatan', 'users.bagian', '=', 'jabatan.id')
                    ->where('cuti.status', 'Selesai')
                    ->latest('cuti.created_at')
                    ->get();
                return view('public/riwayat', ['list_cuti' => $data_cuti]);
            } else {
                return view('layout/dashboard');
            }
        }
    }

    public function printPDF(Request $request)
    {
        $id_pengajuan = $request->id_pengajuan;

        $data = CutiModel::select('users.*','cuti.*','jabatan.nama AS nama_bagian')
            ->join('users', 'cuti.nip', '=', 'users.nip')
            ->join('sisa_cuti', 'cuti.nip', '=', 'sisa_cuti.nip')
            ->join('jabatan', 'users.bagian', '=', 'jabatan.id')
            ->where('cuti.id', $id_pengajuan)
            ->first();

        $kasubag = KaryawanModel::select('*')->where('nip', $data['penyetuju'])->first();
        
        $pdf = PDF::loadview('public/pengajuanPdf', ['data' => $data, 'kasubag' => $kasubag])->setPaper('a4', 'potrait');

        return $pdf->stream();
    }
}
