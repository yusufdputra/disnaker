@extends('layout/master')

@section('title', 'Kelola Data Staff')

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
                <h4 class="m-t-0 header-title">Data Staff</h4>
              </div>
            </div>
            <div class="col-auto">
              <a href="#tambah-modal" data-animation="sign" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-primary btn-sm mb-5">Tambah</a>

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
                <th>Jenis Kelamin</th>
                <th>Golongan</th>
                <th>Jabatan</th>
                <th>Alamat</th>
                <th>Nomor Hp</th>
                <!-- <th>Aksi</th> -->
              </tr>
            </thead>

            @foreach ($list_staff as $index => $list)
            <tr>
              <td>{{$index+1}}</td>
              <td>{{$list->nip}}</td>
              <td>{{$list->nama}}</td>
              <td>
                @if ($list->jenis_kelamin == 'lk')
                  Laki-Laki
                @else
                  Perempuan
                @endif
              </td>
              <td>{{$list->golongan}}</td>
              <td>{{$list->jabatan}}</td>
              <td>{{$list->alamat}}</td>
              <td>{{$list->no_hp}}</td>
              <!-- <td>
                <a href="#hapus-modal" data-animation="sign" data-plugin="custommodal" data-id='{{$list->nip}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-danger btn-sm hapus"><i class="mdi mdi-delete"></i></a>
              </td> -->
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


<div id="tambah-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Tambah Staff</h4>
    </div>
    <div class="p-20">

      <form class="form-horizontal m-t-20" action="{{'tambah-staff'}}" method="POST">
        {{csrf_field()}}
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="nip" required="" placeholder="NIP">
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="nama" required="" placeholder="Nama">
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <select class="custom-select" name="jenis_kelamin">
              <option selected="" disabled>Jenis Kelamin</option>
              <option value="lk">Laki-Laki</option>
              <option value="pr">Perempuan</option>
            </select>
          </div>
        </div>



        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="golongan" required="" placeholder="Golongan">
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <select class="custom-select" name="jabatan">
              <option selected="" disabled>Jabatan</option>
              <option value="Kepala Dinas">Kepala Dinas</option>
              <option value="Sekretaris">Sekretaris</option>
              <option value="Kasubag">Kasubag</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="no_hp" required="" placeholder="Nomor Hp">
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <textarea id="textarea" name="alamat" class="form-control" maxlength="225" rows="2" placeholder="Alamat"></textarea>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="password" required="" placeholder="Password">
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
      <h4 class="text-uppercase font-bold mb-0">Hapus Staff</h4>
    </div>
    <div class="p-20">

      <form class="form-horizontal m-t-20" action="{{'hapus-staff'}}" method="POST">
        {{csrf_field()}}

        <div>
          <input type=hidden id='nip' name='nip'>
          <h5 id="exampleModalLabel">Apakah anda yakin ingin mengapus staff ini?</h5>
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