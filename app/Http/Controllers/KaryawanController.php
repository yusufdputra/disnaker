<?php

namespace App\Http\Controllers;

use App\Models\JabatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\KaryawanModel;
use App\Models\SisaCutiModel;


class KaryawanController extends Controller
{
    public function index()
    {
        if (!Session::get('status_login')) {
            return redirect('/')->with('alert', 'Kamu harus login!');
        } else {
            $data_karyawan = KaryawanModel::select('users.*','jabatan.nama AS nama_bagian')
            ->join('jabatan', 'users.bagian', '=', 'jabatan.id')
            ->whereNotNull('status')->get();

            $data_jab = JabatanModel::select('*')->get();
            return view('admin/karyawan', ['list_karyawan' => $data_karyawan, 'data_jab' => $data_jab]);
        }
    }

    public function tambah_karyawan(Request $request)
    {
        $nip = $request->nip;

        $data =  KaryawanModel::where('nip', $nip)->first();

        if (!$data) {

            $nama = $request->nama;
            $golongan = $request->golongan;
            $jabatan = $request->head_jabatan;
            $bagian = $request->body_jabatan;
            $status = $request->status;
            $password = $request->password;
            $jenis_kelamin = $request->jenis_kelamin;

            $data =  new KaryawanModel();
            $data->nip = $nip;
            $data->nama = $nama;
            $data->jabatan = $jabatan;
            $data->bagian = $bagian;
            $data->golongan = $golongan;
            $data->jenis_kelamin = $jenis_kelamin;
            $data->status = $status;
            $data->password = bcrypt($password);
            $data->save();

            // set untuk jatah cuti pertahun default
            $data2 = new SisaCutiModel();
            $data2->nip = $nip;
            $data2->sisa = 12;
            $data2->tahun = date('Y');
            $data2->save();

            return redirect('pegawai')->with('success', 'Berhasil menambah karyawan');
        } else {
            return redirect('pegawai')->with('alert', 'NIP sudah terdaftar');
        }
    }

    public function hapus_karyawan(Request $request)
    {
        $nip = $request->nip;

        KaryawanModel::where('nip', $nip)->delete();

        return redirect('pegawai')->with('success', 'Berhasil menghapus karyawan');
    }
}
