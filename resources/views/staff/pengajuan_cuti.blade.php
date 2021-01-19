@extends('layout/master')

@section('title', 'Kelola Pengajuan Cuti')

@section('container')

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<!-- Start content -->
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="card-box table-responsive">

          <div class="form-row align-items-center">
            <div class="col-auto">
              <div class="mb-5">
                <h4 class="m-t-0 header-title">Data Pengajuan Cuti</h4>
              </div>
            </div>

          </div>

          @if(\Session::has('alert'))
          <div class="alert alert-danger">
            <div>{{Session::get('alert')}}</div>
          </div>
          @endif

          @if(\Session::has('success'))
          <div class="alert alert-success">
            <div>{{Session::get('success')}}</div>
          </div>
          @endif


          <table id="datatable" class="table table-bordered text-center">
            <thead>
              <tr>
                <th>No.</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Golongan</th>
                <th>Lama Cuti</th>
               
                <th>Jenis Cuti</th>
                <th>Tanggal Cuti</th>
                <th>Alasan Cuti</th>
                <th>Tujuan Cuti</th>
                <th>Aksi</th>

              </tr>
            </thead>

            @foreach ($list_cuti as $index => $list)
            <tr>
              <td>{{$index+1}}</td>
              <td>{{$list->nip}}</td>
              <td>{{$list->nama}}</td>
              <td>{{$list->jabatan}} {{$list->nama_bagian}}</td>
              <td>{{$list->golongan}}</td>
              <td>{{$list->lama}} Hari</td>
              
              <td>{{$list->jenis}}</td>
              <td>
                <?php
                  $tgl_list = $list->tanggal_cuti;
                  $tgl = explode(',', $tgl_list);
                  foreach ($tgl as $t){
                    echo "<p>".$t."</p>";
                  }
                ?>
              </td>
              <td>{{$list->alasan}}</td>
              <td>{{$list->tujuan}}</td>
              
              <td>

                <a href="#terima-modal" data-animation="sign" data-plugin="custommodal" data-id='{{$list->id_pengajuan_cuti}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-rounded btn-success btn-sm pengajuan_aksi"><i class="mdi mdi-check"></i></a>
                
                <a href="#tolak-modal" data-animation="sign" data-plugin="custommodal" data-id='{{$list->id_pengajuan_cuti}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-rounded btn-danger btn-sm pengajuan_aksi"><i class="mdi mdi-close"></i></a>
               
              </td>
            </tr>
            @endforeach
            <tbody>

            </tbody>

          </table>
        </div>
      </div>
    </div> <!-- end row -->




  </div> <!-- container -->

</div> <!-- content -->


<div id="terima-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Terima Pengajuan Cuti</h4>
    </div>
    <div class="p-20">

      <form class="form-horizontal m-t-20" action="{{'terima-pengajuan'}}" method="POST">
        {{csrf_field()}}

        <div>
          <input type=hidden class='id_pengajuan' name='id_pengajuan'>
          <p id="exampleModalLabel">Apakah anda yakin ingin menerima pengajuan ini? </p>
          <p>Pengajuan akan dilanjutkan ke Kepala Dinas / Sekretaris</p>
        </div>



        <div class="form-group text-center m-t-30">
          <div class="col-xs-6">
            <button type="button" onclick="Custombox.close();" class="   btn btn-primary btn-bordred btn-block waves-effect waves-light">Tidak</button>
            <button class="btn btn-success btn-bordred btn-block waves-effect waves-light" type="submit">Terima</button>
          </div>
        </div>


      </form>

    </div>
  </div>

</div>

<div id="tolak-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Tolak Pengajuan Cuti</h4>
    </div>
    <div class="p-20">

      <form class="form-horizontal m-t-20" action="{{'tolak-pengajuan'}}" method="POST">
        {{csrf_field()}}

        <div>
          <input type=hidden class="id_pengajuan" name='id_pengajuan'>
          <p id="exampleModalLabel">Apakah anda yakin ingin menolak pengajuan ini? </p>
          <p>Pengajuan akan dikembalikan</p>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <textarea  name="pesan" class="form-control" maxlength="225" required rows="2" placeholder="Pesan Penolakan"></textarea>
          </div>
        </div>

        <div class="form-group text-center m-t-30">
          <div class="col-xs-6">
            <button type="button" onclick="Custombox.close();" class="   btn btn-primary btn-bordred btn-block waves-effect waves-light">Tidak</button>
            <button class="btn btn-success btn-bordred btn-block waves-effect waves-light" type="submit">Tolak</button>
          </div>
        </div>


      </form>

    </div>
  </div>

</div>

@endsection