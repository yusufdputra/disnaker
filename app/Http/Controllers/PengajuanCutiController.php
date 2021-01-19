<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\CutiModel;
use App\Models\SisaCutiModel;
use App\Models\StaffModel;
use Cuti;

class PengajuanCutiController extends Controller
{
    public function index()
    {
        if (!Session::get('status_login')) {
            return redirect('/')->with('alert', 'Kamu harus login!');
        } else {

            $jabatan = Session::get('jabatan');
            if ($jabatan == 'Kepala Dinas' || $jabatan == 'Sekretaris') {
                $status = 2;
            } else if ($jabatan == 'Kasubag') {
                $status = 1;
            }

            $data_cuti = CutiModel::select('users.*','cuti.*', 'cuti.id AS id_pengajuan_cuti','jabatan.nama AS nama_bagian')
                ->join('users', 'cuti.nip', '=', 'users.nip')
                ->join('sisa_cuti', 'cuti.nip', '=', 'sisa_cuti.nip')
                ->join('jabatan', 'users.bagian', '=', 'jabatan.id')
                ->where('cuti.status', $status)
                ->latest('cuti.created_at')
                ->get();

            return view('staff/pengajuan_cuti', ['list_cuti' => $data_cuti]);
        }
    }

    public function terima(Request $request)
    {
        $id_pengajuan = $request->id_pengajuan;
        $jabatan = Session::get('jabatan');

        $nip_user = Session::get('nip');
        // get nama staff
        // $nama_penyetuju = StaffModel::select('nama')->where('nip', $nip_user)->first();

        if ($jabatan == 'Kasubag') {
            $status = 2;
        } else if ($jabatan == 'Kepala Dinas' || $jabatan == 'Sekretaris') {
            $status = 'Selesai';
            $jenis = CutiModel::select('jenis')->where('id', $id_pengajuan)->first();
            //get sisa cuti
            $sisa = SisaCutiModel::select('sisa')
                ->join('cuti', 'sisa_cuti.nip', '=', 'cuti.nip')
                ->where('cuti.id', $id_pengajuan)->first();

            if ($jenis->jenis == 'Cuti Tahunan') {
                // kurangi jatah cuti
                // get lama pengajuan
                $lama = CutiModel::select('lama')->where('id', $id_pengajuan)->first();
                $hasil = ($sisa->sisa) - ($lama->lama);
            } else {
                $hasil = $sisa->sisa;
            }

            SisaCutiModel::where('cuti.id', $id_pengajuan)
                ->join('cuti', 'cuti.nip', '=', 'sisa_cuti.nip')
                ->update(['sisa_cuti.sisa' => $hasil]);
        }

        CutiModel::where('id', $id_pengajuan)->update(['status' => $status, 'penyetuju' => $nip_user]);
        return redirect('pengajuan-cuti')->with('success', 'Berhasil menyetujui permohonan');
    }

    public function tolak(Request $request)
    {
        $id_pengajuan = $request->id_pengajuan;
        $pesan = $request->pesan;

        $nip_user = Session::get('nip');
        // get nama staff
        $nama_penyetuju = StaffModel::select('nama')->where('nip', $nip_user)->first();

        CutiModel::where('id', $id_pengajuan)->update(['status' => 'tolak', 'penyetuju' => $nip_user, 'pesan' => $pesan]);
        return redirect('pengajuan-cuti')->with('success', 'Berhasil menolak permohonan');
    }
}
