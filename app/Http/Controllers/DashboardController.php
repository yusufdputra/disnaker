<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Session::get('status_login')) {
            return redirect('/')->with('alert', 'Kamu harus login!');
        }else{
            return view('layout/dashboard');
        }
    }
}
