@extends('layout/master')

@section('title', 'Kelola '.$title)

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
              <div class="mb-2">
                <h4 class="m-t-0 header-title">Data {{$title}}</h4>
              </div>
            </div>
            <div class="col-auto">
              <a href="#tambah-modal" data-animation="sign" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-primary btn-sm mb-2">Pengajuan Baru</a>


            </div>
          </div>

          <p class="text-muted font-14 m-b-30">Sisa cuti tahunan anda: <code> {{$sisa_cuti->sisa}} Hari </code></p>

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
                <th>Lama Cuti</th>
                <th>Tanggal Cuti</th>
                <th>Alasan Cuti</th>
                <th>Tujuan Cuti</th>
                <th>Jenis</th>
                <th>Status</th>

              </tr>
            </thead>

            @foreach ($list_cuti as $index => $list)
            <tr>
              <td>{{$index+1}}</td>
              <td>{{$list->lama}} Hari</td>
              <td>
                <?php
                $tgl_list = $list->tanggal_cuti;
                $tgl = explode(',', $tgl_list);
                foreach ($tgl as $t) {
                  echo "<p>" . $t . "</p>";
                }
                ?>
              </td>

              <td>{{$list->alasan}}</td>
              <td>{{$list->tujuan}}</td>
              <td>{{$list->jenis}}</td>
              <td>

                @if($list->status == '1')
                <a class="btn btn-info btn-trans btn-rounded btn-sm">Menunggu (Kasubag)</a>
                @elseif($list->status == '2')
                <a class="btn btn-info btn-trans btn-rounded btn-sm">Menunggu (Kepala Dinas/Sekretaris)</a>
                @elseif($list->status == 'tolak')
                <a href="#detail-modal" data-animation="sign" data-plugin="custommodal" data-id='{{$list->pesan}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-danger btn-trans btn-rounded btn-sm lihat_pesan">Ditolak <i class="mdi mdi-eye"></i></a>

                @elseif($list->status == 'Selesai')
                <form target="_blank" class="form-horizontal m-t-20" action="{{'print'}}" method="POST">
                  {{csrf_field()}}
                  <input type="hidden" name="id_pengajuan" value="{{$list->id}}" id="">
                  <button " class=" btn btn-trans btn-rounded btn-success btn-sm print" type="submit"> Selesai <i class="mdi mdi-printer"></i></button>
                </form>
                @endif
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

<div id="detail-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Detail Penolakan</h4>
    </div>
    <div class="p-20">


      {{csrf_field()}}

      <div class="form-group">
        <div class="col-xs-12">
          <textarea id="textarea" disabled class="alasan form-control" maxlength="225" rows="2" placeholder="Pesan"></textarea>
        </div>
      </div>



    </div>
  </div>

</div>

<div id="tambah-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Pengajuan Cuti Baru</h4>
    </div>
    <div class="p-20">

      <form class="form-horizontal m-t-20" action="{{'tambah-cuti'}}" method="POST">
        {{csrf_field()}}
        <input class="form-control" type="hidden" name="jenis" required="" value="{{$title}}">
        <div class="form-group">
          <div class="col-xs-12">
            <textarea id="" required name="alasan" class="form-control" maxlength="225" rows="2" placeholder="Alasan Cuti"></textarea>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <textarea id="" required name="tujuan" class="form-control" maxlength="225" rows="2" placeholder="Tujuan Cuti"></textarea>
          </div>
        </div>

        <!-- <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="number" name="lama" required="" placeholder="Lama Cuti (Hari)">
          </div>
        </div> -->

        <div class="form-group">
          <div class="col-xs-12">
            <div class="input-group">
              
                <div class="input-daterange input-group" id="date-range">
                  <input type="text" placeholder="Dari (dd-M-yyyy)" autocomplete="off" class="form-control" name="start_date" />
                  <input type="text" placeholder="Sampai (dd-M-yyyy)" autocomplete="off" class="form-control" name="end_date" />
                </div>
            
              <!-- <input type="text" class="form-control" name="tanggal_cuti" placeholder="Tanggal Cuti (mm/dd/yyyy)" id="datepicker-multiple-date" autocomplete="off">
              <div class="input-group-append">
                <span class="input-group-text"><i class="ti-calendar"></i></span>
              </div> -->
            </div><!-- input-group -->
          </div>
        </div>


        <div class="form-group text-center m-t-30">
          <div class="col-xs-12">
            <button class="btn btn-success btn-bordred btn-block waves-effect waves-light" type="submit">Tambah</button>
          </div>
        </div>


      </form>

    </div>
  </div>

</div>

<div id="hapus-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Hapus Karyawan</h4>
    </div>
    <div class="p-20">

      <form class="form-horizontal m-t-20" action="{{'hapus-karyawan'}}" method="POST">
        {{csrf_field()}}

        <div>
          <input type=hidden id='nip' name='nip'>
          <h5 id="exampleModalLabel">Apakah anda yakin ingin mengapus karyawan ini?</h5>
        </div>



        <div class="form-group text-center m-t-30">
          <div class="col-xs-6">
            <button type="button" onclick="Custombox.close();" class="   btn btn-primary btn-bordred btn-block waves-effect waves-light">Tidak</button>
            <button class="btn btn-danger btn-bordred btn-block waves-effect waves-light" type="submit">Hapus</button>
          </div>
        </div>


      </form>

    </div>
  </div>

</div>


@endsection