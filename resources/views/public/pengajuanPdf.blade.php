<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Pengajuan</title>
  
</head>

<body style="margin: 1.5cm;">

  <div style="text-align: center;">
    <span style="font-size: 14px; ">PEMERINTAH KABUPATEN INDRAGIRI HULU</span> <br>
    <span style="font-size: 20px; ">DINAS TENAGA KERJA</span><br>
    <span style="font-size: 14px; ">Jalan Baru Canai Pematang Rebah – Rengat Barat 29351</span><br>
    <span style="font-size: 14px; ">RENGAT</span><br>
    <hr>
  </div>
  <div class="text-left" style="font-size: 12px;">
    <span>
      Rengat, {{date("d-M-Y")}} <br> <br>
      Perihal : Permohonan Cuti Melahirkan/Tahunan <br>
      Kepada Yth, <br>
      Bapak/Ibu Pimpinan <br>
      Dinas Tenaga Kerja <br>
      di Tempat <br> <br>
      Dengan hormat, <br>
      Yang bertanda tangan di bawah ini:
    </span>
  </div>
  <?php
      $tgl_arr = explode(',', $data['tanggal_cuti']);
      $awal = reset($tgl_arr);
      $akhir = end($tgl_arr);
      ?>

  <div style="font-size: 12px; margin-left: 30px;">
    <table style="border: 1px;">
      <thead></thead>
      <tbody>
        <tr>
          <td>Nama</td>
          <td style="padding-left: 50px;">:</td>
          <td>{{$data['nama']}}</td>
        </tr>

        <tr>
          <td>NIP</td>
          <td style="padding-left: 50px;">:</td>
          <td>{{$data['nip']}}</td>
        </tr>

        <tr>
          <td>Tanggal Cuti</td>
          <td style="padding-left: 50px;">:</td>
          <td>{{$awal}} s/d {{$akhir}}</td>
        </tr>

        <tr>
          <td>Jabatan</td>
          <td style="padding-left: 50px;">:</td>
          <td>{{$data['jabatan']}} {{$data['nama_bagian']}}</td>
        </tr>

        <tr>
          <td>Jenis Cuti</td>
          <td style="padding-left: 50px;">:</td>
          <td>{{$data['jenis']}}</td>
        </tr>

      </tbody>
      </td>
    </table>


  </div>

  <div style="font-size: 12px; text-align: justify;">
    <span>
      <br>
      
      Dengan surat ini saya mengajukan {{strtolower($data['jenis'])}} selama {{$data['lama']}} hari. Terhitung mulai dari tanggal {{$awal}} hingga {{$akhir}}. Sehubungan dengan datangnya surat ini, maka pekerjaan saya akan dialihkan kepada rekan kerja saya. <br><br>

      Demikian surat permohonan ini saya ajukan untuk menjadi pertimbangan bagi Bapak/Ibu pimpinan. Atas perhatiannya saya ucapkan terima kasih.
      <br><br>

    </span>
  </div>

  <div style="font-size: 12px;">
    <table style="width: 100%; ">
      <thead></thead>
      <tbody>
        <tr>
          <td>Mengetahui/Menyetujui</td>

        </tr>
        <tr>
          <td>Kepala dinas</td>
          <td style="text-align: center;">Hormat Saya</td>
        </tr>
        <tr><td><br></td></tr>
        <tr><td>   
          <u><b>{{$kasubag['nama']}}</b></u></td>
          <td style="text-align: center;"><u><b>{{$data['nama']}}</b></u></td>
        </tr>
        <tr>
          <td><b>{{$kasubag['nip']}}</b></td>
        </tr>
      </tbody>
    </table>
  </div>



</body>

</html>