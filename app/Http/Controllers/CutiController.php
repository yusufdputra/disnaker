<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\CutiModel;
use App\Models\JabatanModel;
use App\Models\KaryawanModel;
use App\Models\SisaCutiModel;
use DateTime;
use PhpParser\Node\Expr\BinaryOp\Equal;

class CutiController extends Controller
{
    public function cuti_tahun()
    {

        if (!Session::get('status_login')) {
            return redirect('/')->with('alert', 'Kamu harus login!');
        } else {
            $nip = Session::get('nip');

            $data_cuti = CutiModel::select('cuti.*')
                ->where([['cuti.nip', $nip], ['cuti.jenis', 'Cuti Tahunan']])
              
                ->latest()
                ->get();

            $sisa_cuti = SisaCutiModel::select('sisa')->where('nip', $nip)->first();

            $title = "Cuti Tahunan";

            return view('karyawan/cuti_tahun', ['list_cuti' => $data_cuti, 'sisa_cuti' => $sisa_cuti, 'title' => $title]);
        }
    }

    public function cuti_melahirkan()
    {

        if (!Session::get('status_login')) {
            return redirect('/')->with('alert', 'Kamu harus login!');
        } else {
            $nip = Session::get('nip');

            $data_cuti = CutiModel::select('cuti.*')
                ->where([['cuti.nip', $nip], ['cuti.jenis', 'Cuti Melahirkan']])
                
                ->latest()
                ->get();

            $sisa_cuti = SisaCutiModel::select('sisa')->where('nip', $nip)->first();

            $title = "Cuti Melahirkan";

            return view('karyawan/cuti_melahirkan', ['list_cuti' => $data_cuti, 'sisa_cuti' => $sisa_cuti, 'title' => $title]);
        }
    }

    public function sisa_cuti()
    {

        if (!Session::get('status_login')) {
            return redirect('/')->with('alert', 'Kamu harus login!');
        } else {

            $sisa_cuti = SisaCutiModel::select('sisa_cuti.*', 'users.nama')
                ->join('users', 'sisa_cuti.nip', '=', 'users.nip')
                ->get();

            return view('staff/sisa_cuti', ['sisa_cuti' => $sisa_cuti]);
        }
    }

    public function limit()
    {
        if (!Session::get('status_login')) {
            return redirect('/')->with('alert', 'Kamu harus login!');
        } else {

            $jabatan = JabatanModel::select('*')->get();

            $pegawai = CutiModel::select('users.*','cuti.*', 'cuti.id AS id_pengajuan_cuti','jabatan.nama AS nama_bagian')
            ->join('users', 'cuti.nip', '=', 'users.nip')
            ->join('sisa_cuti', 'cuti.nip', '=', 'sisa_cuti.nip')
            ->join('jabatan', 'users.bagian', '=', 'jabatan.id')
            ->where('cuti.status', 'Selesai')
            ->latest('cuti.created_at')
            ->get();

            return view('staff/limit', ['jabatan' => $jabatan, 'pegawai' => $pegawai]);
        }
    }

    public function tambah_cuti(Request $request)
    {
        $nip = Session::get('nip');
        $jenis = $request->jenis;
        $alasan = $request->alasan;
        $tujuan = $request->tujuan;


        if ($jenis == 'Cuti Tahunan') {
            // check tanggal merah
            date_default_timezone_set("Asia/Jakarta");


            $date_awal = strtotime($request->start_date);
            $date_akhir = strtotime($request->end_date);

            


            $dates = array();
            $format = 'Ymd';
            $step = '+1 day';

            while ($date_awal <= $date_akhir) {
                $dates[] = date($format, $date_awal);
                $date_awal = strtotime($step, $date_awal);
            }

            ////fungsi check tanggal merah
            $array = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/Json-Indonesia-holidays/master/calendar.json"), true);
         
            foreach ($dates as $key => $value) {
                //check tanggal merah berdasarkan libur nasional 
                //check tanggal merah berdasarkan hari sab / minggu 
                if (isset($array[$value]) || date("D", strtotime($value)) === "Sun" || date("D", strtotime($value)) === "Sat") {
                    continue;
                    // var_dump("tanggal merah " . $array[$value]["deskripsi"]);

                } else { // bukan tanggal merah
                    $myDateTime = DateTime::createFromFormat('Ymd', $value);
                    $dates_acc[] = $myDateTime->format('d/M/Y');
                   
                }
            }
            
            $lama = collect($dates_acc)->count();


            $sisa_cuti = SisaCutiModel::select('sisa')
                ->where([
                    ['nip', $nip],
                    ['sisa', '>=', $lama]
                ])->first();
            if ($sisa_cuti) {

                //

                $data = new CutiModel();
                $data->nip = $nip;
                $data->alasan = $alasan;
                $data->tujuan = $tujuan;
                $data->lama = $lama;
                $data->tanggal_cuti = implode(",",$dates_acc);;
                $data->jenis = $jenis;
                $data->status = "1";
                $data->save();
                return redirect('cuti-tahun')->with('success', 'Berhasil mengajukan permohonan');
            } else {
                return redirect('cuti-tahun')->with('alert', 'Jumlah cuti yang diajukan telah melampaui batas yang tersedia!');
            }
        } else {
            $date_awal = ($request->tanggal_cuti_start);
            $date_akhir = Date('d/M/Y', strtotime($date_awal . '+30 day'));

            // $date_akhir = ($request->tanggal_cuti_end);

            // $lama_ = (strtotime($date_akhir) - strtotime($date_awal));
            // $lama = round($lama_ / (60 * 60 * 24))+1;
            $myDateTime = DateTime::createFromFormat('d-M-Y', $date_awal);
            $date_awal_now= $myDateTime->format('d/M/Y');

            try {
                $data = new CutiModel();
                $data->nip = $nip;
                $data->alasan = $alasan;
                $data->tujuan = $tujuan;
                $data->lama = 30;
                $data->tanggal_cuti = $date_awal_now . ',-,' . $date_akhir;
                $data->jenis = $jenis;
                $data->status = "1";
                $data->save();
                return redirect('cuti-melahirkan')->with('success', 'Berhasil mengajukan permohonan');
            } catch (\Throwable $th) {
                return redirect('cuti-melahirkan')->with('alert', 'Gagal mengajukan permohonan!');
            }
        }
    }



    public function refresh()
    {
        if (!Session::get('status_login')) {
            return redirect('/')->with('alert', 'Kamu harus login!');
        } else {

            $sisa_cuti = SisaCutiModel::select('sisa_cuti.*', 'users.nama')
                ->join('users', 'sisa_cuti.nip', '=', 'users.nip')
                ->get();
            //refresh
            foreach ($sisa_cuti as $key => $value) {
                $jatah = 12;
                // tahun baru
                if ($value->tahun != date('Y')) {
                    $cuti_tambah = $value->sisa + $jatah;
                } else {
                    $cuti_tambah = $value->sisa;
                }

                SisaCutiModel::where('nip', $value->nip)->update(['sisa' => $cuti_tambah, 'tahun' => date('Y')]);
            }

            return view('staff/sisa_cuti', ['sisa_cuti' => $sisa_cuti]);
        }
    }
}
