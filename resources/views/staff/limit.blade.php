@extends('layout/master')

@section('title', 'Limit Cuti Karyawan')

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
                <h4 class="m-t-0 header-title">Limit Cuti Karyawan</h4>

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
                <th>Bagian</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
                <th>Tanggal Cuti</th>
              </tr>
            </thead>

            @foreach ($jabatan as $index => $list)
            <tr>
              <td>{{$index+1}}</td>
              <td>{{$list->nama}}</td>
              
              <td>
                @foreach ($pegawai as $k => $v)
                  @if ($v->bagian == $list->id)
                    - {{$v->nama}} <br>
                  @endif
                @endforeach
              </td>
              <td>
                @foreach ($pegawai as $k => $v)
                  @if ($v->bagian == $list->id)
                    - {{$v->jabatan}} Bagian<br>
                  @endif
                @endforeach
              </td>
              <td>
                @foreach ($pegawai as $k => $v)
                  @if ($v->bagian == $list->id)
                    - {{$v->tanggal_cuti}} <br>
                  @endif
                @endforeach
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