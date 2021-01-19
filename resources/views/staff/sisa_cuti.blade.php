@extends('layout/master')

@section('title', 'Sisa Cuti Karyawan')

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
                <h4 class="m-t-0 header-title">Sisa Cuti Karyawan</h4>

              </div>
            </div>
            <div class="col-auto">
              <a href="{{'refresh-cuti'}}" class="btn btn-primary btn-sm mb-2">Refresh</a>
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
                <th>Sisa Cuti (Tahunan)</th>
                <th>Terakhir Update</th>
              </tr>
            </thead>

            @foreach ($sisa_cuti as $index => $list)
            <tr>
              <td>{{$index+1}}</td>
              <td>{{$list->nip}}</td>
              <td>{{$list->nama}}</td>
              <td>{{$list->sisa}} Hari</td>
              <td>{{$list->updated_at}}</td>
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