@extends('layout/master')

@section('title', 'Riwayat Pengajuan Cuti')

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
                <h4 class="m-t-0 header-title">Riwayat Pengajuan Cuti</h4>
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
                <form target="_blank" class="form-horizontal m-t-20" action="{{'print'}}" method="POST">
                {{csrf_field()}}
                  <input type="hidden" name="id_pengajuan" value="{{$list->id_pengajuan_cuti}}" id="">
                  <button " class="btn btn-rounded btn-success btn-sm print" type="submit"><i class="mdi mdi-printer"></i></button>
                </form>

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



@endsection