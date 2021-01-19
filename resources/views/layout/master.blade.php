<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
  <meta name="author" content="Coderthemes">

  <link rel="shortcut icon" href="adminto/images/favicon.ico">

  <title>Sistem Informasi </title>

  <!-- Plugins css-->
  <link href="adminto/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
  <link href="adminto/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
  <link href="adminto/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
  <link href="adminto/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
  <link href="adminto/plugins/switchery/switchery.min.css" rel="stylesheet" />
  <link href="adminto/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
  <link href="adminto/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
  <link href="adminto/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="adminto/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

  <!-- App css -->
  <link href="adminto/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="adminto/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="adminto/css/style.css" rel="stylesheet" type="text/css" />

  <script src="adminto/js/modernizr.min.js"></script>

  <!-- DataTables -->
  <link href="adminto/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="adminto/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- Responsive datatable examples -->
  <link href="adminto/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- Multi Item Selection examples -->
  <link href="adminto/plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- Custom box css -->
  <link href="adminto/plugins/custombox/dist/custombox.min.css" rel="stylesheet">

  @toastr_css
</head>

<body>
  <!-- * *
*
* * * * create by Yusuf Dwi Putra
email yusuf.dputra0@gmail.com * * * * *
* 
* * -->

  @if(Session::get('status_login')==1)
  <!-- Begin page -->
  <div id="wrapper">
    <!-- Top Bar Start -->
    <div class="topbar">

      <!-- LOGO -->
      <div class="topbar-left">
        <a href="{{'/'}}" class="logo"><span>SIPCK<span>-Disnaker</span></span><i class="mdi mdi-layers"></i></a>
      </div>

      <!-- Button mobile view to collapse sidebar menu -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">

          <!-- Page title -->
          <ul class="nav navbar-nav list-inline navbar-left">
            <li class="list-inline-item">
              <button class="button-menu-mobile open-left">
                <i class="mdi mdi-menu"></i>
              </button>
            </li>
            <li class="list-inline-item">
              <h4 class="page-title">@yield('title')</h4>
            </li>
          </ul>


        </div><!-- end container -->
      </div><!-- end navbar -->
    </div>
    <!-- Top Bar End -->

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
      <div class="sidebar-inner slimscrollleft">

        <!-- User -->
        <div class="user-box">
          <div class="user-img">
            <img src="adminto/images/users/avatar.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail img-responsive">
            <div class="user-status offline"><i class="mdi mdi-adjust"></i></div>
          </div>
          <h5><a href="#">{{Session::get('jabatan')}}</a> </h5>
          <ul class="list-inline">
            @if(Session::get('jabatan') != 'Admin')

            @endif
            <li class="list-inline-item">
              <a href="{{'logout'}}" class="text-custom">
                <span>Logout</span>
              </a>
            </li>
          </ul>
        </div>
        <!-- End User -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">
          <ul>
            <li class="text-muted menu-title">Navigation</li>

            <li>
              <a href="{{'dashboard'}}" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
            </li>


            @if(Session::get('jabatan') == 'Admin')
            <li>
              <a href="{{'pegawai'}}" class="waves-effect"><i class=" mdi mdi-account-settings-variant"></i> <span> Data Pegawai </span> </a>
            </li>

            <li>
              <a href="{{'staff'}}" class="waves-effect"><i class="mdi mdi-account-network"></i> <span> Data Staff </span> </a>
            </li>



            <li>
              <a href="{{'riwayat'}}" class="waves-effect"><i class="mdi mdi-history"></i> <span> Riwayat Pengajuan </span> </a>
            </li>

            @elseif(Session::get('jabatan') == 'Kepala Dinas' || Session::get('jabatan') == 'Sekretaris')

            <li>
              <a href="{{'pengajuan-cuti'}}" class="waves-effect"><i class=" mdi mdi-format-list-checks"></i> <span> Pengajuan Cuti </span> </a>
            </li>

            <li>
              <a href="{{'sisa-cuti'}}" class="waves-effect"><i class="mdi mdi-calendar-question"></i> <span> Sisa Cuti </span> </a>
            </li>

            <li>
              <a href="{{'riwayat'}}" class="waves-effect"><i class="mdi mdi-history"></i> <span> Riwayat Pengajuan </span> </a>
            </li>

            @elseif(Session::get('jabatan') == 'Kasubag')
            <li>
              <a href="{{'pengajuan-cuti'}}" class="waves-effect"><i class=" mdi mdi-format-list-checks"></i> <span> Pengajuan Cuti </span> </a>
            </li>

            <li>
              <a href="{{'limit'}}" class="waves-effect"><i class="mdi mdi-calendar-multiple"></i> <span> Limit Cuti </span> </a>
            </li>
            
            <li>
              <a href="{{'riwayat'}}" class="waves-effect"><i class="mdi mdi-history"></i> <span> Riwayat Pengajuan </span> </a>
            </li>



            @else
            <li>
              <a href="{{'cuti-tahun'}}" class="waves-effect"><i class="mdi mdi-calendar-remove"></i> <span> Cuti Tahunan </span> </a>
            </li>

            @if (Session::get('jenis_kelamin') == 'pr')
            <li>
              <a href="{{'cuti-melahirkan'}}" class="waves-effect"><i class="mdi mdi-calendar-plus"></i> <span> Cuti Melahirkan </span> </a>
            </li>
            @endif

            @endif



          </ul>
          <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

      </div>

    </div>
    <!-- Left Sidebar End -->
    <div class="content-page">
      @yield('container')
      <footer class="footer text-right">
        2020 © TIM IT DISNAKER
      </footer>

    </div>
  </div>
  @endif

  @if(Session::get('status_login')==0)
  <div class="account-pages"></div>
  <div class="clearfix"></div>

  <div class="wrapper-page">
    @yield('container_login')
  </div>
  <!-- end card-box-->
  @endif

  <!-- @jquery
  @toastr_js
  @toastr_render -->

  <!-- jQuery  -->
  <script src="adminto/js/jquery.min.js"></script>
  <script src="adminto/js/popper.min.js"></script>
  <script src="adminto/js/bootstrap.min.js"></script>
  <script src="adminto/js/detect.js"></script>
  <script src="adminto/js/fastclick.js"></script>
  <script src="adminto/js/jquery.blockUI.js"></script>
  <script src="adminto/js/waves.js"></script>
  <script src="adminto/js/jquery.nicescroll.js"></script>
  <script src="adminto/js/jquery.slimscroll.js"></script>
  <script src="adminto/js/jquery.scrollTo.min.js"></script>

  <!-- Buttons examples -->
  <script src="adminto/plugins/datatables/dataTables.buttons.min.js"></script>
  <script src="adminto/plugins/datatables/buttons.bootstrap4.min.js"></script>
  <script src="adminto/plugins/datatables/jszip.min.js"></script>
  <script src="adminto/plugins/datatables/pdfmake.min.js"></script>
  <script src="adminto/plugins/datatables/vfs_fonts.js"></script>
  <script src="adminto/plugins/datatables/buttons.html5.min.js"></script>
  <script src="adminto/plugins/datatables/buttons.print.min.js"></script>
  <!-- Modal-Effect -->
  <script src="adminto/plugins/custombox/dist/custombox.min.js"></script>
  <script src="adminto/plugins/custombox/dist/legacy.min.js"></script>

  <!-- App js -->
  <script src="adminto/js/jquery.core.js"></script>
  <script src="adminto/js/jquery.app.js"></script>

  <!-- Required datatable js -->
  <script src="adminto/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="adminto/plugins/datatables/dataTables.bootstrap4.min.js"></script>


  <!-- Key Tables -->
  <script src="adminto/plugins/datatables/dataTables.keyTable.min.js"></script>

  <!-- Responsive examples -->
  <script src="adminto/plugins/datatables/dataTables.responsive.min.js"></script>
  <script src="adminto/plugins/datatables/responsive.bootstrap4.min.js"></script>

  <!-- Selection table -->
  <script src="adminto/plugins/datatables/dataTables.select.min.js"></script>

  <!-- Plugins Js -->
  <script src="adminto/plugins/switchery/switchery.min.js"></script>
  <script src="adminto/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script type="text/javascript" src="adminto/plugins/multiselect/js/jquery.multi-select.js"></script>
  <script type="text/javascript" src="adminto/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
  <script src="adminto/plugins/select2/js/select2.min.js" type="text/javascript"></script>
  <script src="adminto/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
  <script src="adminto/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
  <script src="adminto/plugins/moment/moment.js"></script>
  <script src="adminto/plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <script src="adminto/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="adminto/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="adminto/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="adminto/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>



  <script type="text/javascript">
    $(document).ready(function() {

      // Default Datatable
      $('#datatable').DataTable();

      jQuery('#datepicker-multiple-date').datepicker({
        format: "dd/M/yyyy",
        clearBtn: true,
        multidate: true,
        multidateSeparator: ","
      });

      jQuery('#datepicker').datepicker({
        format: "dd-M-yyyy",
        autoclose: true,
        toggleActive: true,
        todayHighlight: true,
        clearBtn: true,
      });

      jQuery('#date-range').datepicker({
        format: "dd-M-yyyy",
        toggleActive: true,
        todayHighlight: true,
        clearBtn: true,
      });


      // Responsive Datatable
      $('#responsive-datatable').DataTable();

      // Multi Selection Datatable
      $('#selection-datatable').DataTable({
        select: {
          style: 'multi'
        }
      });

      $('.hapus').click(function() {
        var nip = $(this).data('id');
        $('#nip').val(nip);
      });

      $('.pengajuan_aksi').click(function() {
        var id = $(this).data('id');
        $('.id_pengajuan').val(id);
      });

      $('.lihat_pesan').click(function() {
        var id = $(this).data('id');
        $('.alasan').val(id);
      });
    });
  </script>

</body>

</html>