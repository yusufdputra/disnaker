<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        if (!Session::get('status_login')) {
            return view('layout/login')->with('alert', 'Kamu harus login!');
        }else{
            return view('layout/dashboard');
        }
    }

    public function do_login(Request $request)
    {
     
        $nip = $request->nip_login;
        $pass = $request->pass_login;

        $data =  LoginModel::where('nip', $nip)->first();

        if ($data) {
            if(Hash::check($pass, $data->password)){
                Session::put('nip', $nip);
                Session::put('jabatan', $data->jabatan);
                Session::put('jenis_kelamin', $data->jenis_kelamin);
                Session::put('status_login', TRUE);

                return redirect('dashboard');
            }else{
                return redirect('/')->with('alert', 'Password atau email salah!');
            }
        } else{
            return redirect('/')->with('alert', 'Anda tidak terdaftar dalam sistem!');
        }

    }

    public function logout(){
        Session::flush();
        return redirect('/')->with('alert','Anda sudah logout');
    }

    public function register(){
        $data =  new LoginModel();
        $data->nip = '11651100046';
        $data->password = bcrypt('1234');
        $data->save();
        return redirect('/')->with('alert-success','Kamu berhasil Register');
    }
}
