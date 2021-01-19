<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\StaffModel;

class StaffController extends Controller
{
    public function index()
    {
        if (!Session::get('status_login')) {
            return redirect('/')->with('alert', 'Kamu harus login!');
        } else {
            $data_staff = StaffModel::whereNotNull('alamat')->get();
            return view('admin/staff', ['list_staff' => $data_staff]);
        }
    }

    public function tambah_staff(Request $request)
    {
        $nip = $request->nip;
        $nama = $request->nama;
        $golongan = $request->golongan;
        $jabatan = $request->jabatan;
        $alamat = $request->alamat;
        $password = $request->password;
        $jenis_kelamin = $request->jenis_kelamin;
        $no_hp = $request->no_hp;

        $data =  StaffModel::where('nip', $nip)->first();

        if (!$data) {
            $data =  new StaffModel();
            $data->nip = $nip;
            $data->nama = $nama;
            $data->jabatan = $jabatan;
            $data->golongan = $golongan;
            $data->jenis_kelamin = $jenis_kelamin;
            $data->alamat = $alamat;
            $data->no_hp = $no_hp;
            $data->password = bcrypt($password);
            $data->save();
            return redirect('staff')->with('success', 'Berhasil menambah Staff');
        } else {
            return redirect('staff')->with('alert', 'NIP sudah terdaftar');
        }
    }

    public function hapus_staff(Request $request)
    {
        $nip = $request->nip;
        
        StaffModel::where('nip', $nip)->delete();
        
        return redirect('staff')->with('success', 'Berhasil menghapus Staff');

    }
}
