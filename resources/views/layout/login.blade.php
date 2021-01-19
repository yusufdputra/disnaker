@extends('layout/master')

@section('container_login')

<div class="m-t-40 card-box">
  <div class="text-center">
    <a href="/" class="logo"><span>SIPCK<span>-Disnaker</span></span></a>
  </div>
  <div class="text-center">
    <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
    @if(\Session::has('alert'))
    <div class="alert alert-danger">
      <div>{{Session::get('alert')}}</div>
    </div>
    @endif
  </div>

  <div class="p-20">
    <form class="form-horizontal m-t-20" action="{{'loginPost'}}" method="POST">
    {{csrf_field()}}
      <div class="form-group">
        <div class="col-xs-12">
          <input class="form-control" type="number" name="nip_login" required="" placeholder="NIP">
        </div>
      </div>

      <div class="form-group">
        <div class="col-xs-12">
          <input class="form-control" type="password" name="pass_login" required="" placeholder="Password">
        </div>
      </div>



      <div class="form-group text-center m-t-30">
        <div class="col-xs-12">
          <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Log In</button>
        </div>
      </div>

    </form>

  </div>
</div>
<!-- end card-box-->
@endsection