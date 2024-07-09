<?php

class modelgetmenu extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getNumberRandom() {
        $i = 0;
        $xbufrandom = '';
        while ($i <= 6) {
            $xbufrandom .= rand(10000, 99999);
            $i++;
        }
        return $xbufrandom;
    }

    function getArrayKomponen($isFromAdmin, $headertext, $xContent = '', $judul = '') {
        $xBuffResult = array();
        $this->load->model('modelmenu');
        //if true menu tampil di halalaman depan
        $xUser = $this->session->userdata('nama');
        $xTahun = $this->session->userdata('tahun');
        $menuatas = '';
        $menukiri = '';
        //if (!empty($xUser)) {
            $menuatas = $this->modelmenu->getMenuAtas();
            $menukiri = $this->modelmenu->getMenuKiri();
       // }
        $xBuffResult[1] = $menuatas;
        $xBuffResult[2] = $menukiri;
        // $xBuffResult[3] = "" . base_url() . "resource/scriptmedia/images/logo.png";
        $xBuffResult[3] = "https://picsum.photos/200";

        $xBuffResult[4] = $this->session->userdata('nama');
        $xBuffResult[5] = (!empty($judul) ? $judul : '');
        $xBuffResult[6] = $headertext;
        $xBuffResult[7] =  $xContent;

        return $xBuffResult;
    }

    function SetViewAdmin($xContent, $buf1, $xList, $xAjax, $buf2, $judul = '') {

        $this->load->helper('common');
        $this->load->helper('html');
        $xBufResult = $xContent . $xList;
        if (strpos($xContent, '<form') > 0) {
            $xBufResult = $xContent . '</form></div> ' . $xList;
        }
        $xMenuKanan = '';
        $xUser = $this->session->userdata('nama');
        // $logo = "" . base_url() . "resource/admin/dist/img/logo.png";
        $logo = "https://picsum.photos/200";
        $buf1 = 'Event Org';
        $xShow = $this->getArrayKomponen(TRUE, $buf1, $xBufResult, $judul);
        $xecho = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Event Org | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="' . base_url() . 'resource/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="' . base_url() . 'resource/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="' . base_url() . 'resource/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="' . base_url() . 'resource/AdminLTE/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="' . base_url() . 'resource/AdminLTE/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="' . base_url() . 'resource/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="' . base_url() . 'resource/AdminLTE/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="' . base_url() . 'resource/AdminLTE/plugins/summernote/summernote-bs4.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.2/dist/bootstrap-table.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  '.
                
  // link_tag('resource/admin/vendor/bootstrap-table/bootstrap-table.css') . "\n" .
  // link_tag('resource/admin/vendor/bootstrap/css/bootstrap.min.css') . "\n" .
  link_tag('resource/admin/dist/css/style.css') . "\n" .
 ' <script type="text/javascript">
                 function getBaseURL() {
                          return "' . base_url() . '";
                        }
                </script>'.
                '
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" >
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="'.$logo.'" alt="Admin" height="60" width="100" >
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  '.$xShow[1].'
   
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="'.$logo.'" alt="Admin Logo" class="brand-image">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">'.$xUser.'</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
      '.$xShow[2].'
       
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    './*<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->*/'

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid text-sm">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
           '.$xShow[7].'
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="' . base_url() . 'resource/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="' . base_url() . 'resource/AdminLTE/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge(\'uibutton\', $.ui.button)
</script>
'.$xAjax . "\n" .'
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<!-- Bootstrap 4 -->
<script src="' . base_url() . 'resource/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="' . base_url() . 'resource/AdminLTE/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="' . base_url() . 'resource/AdminLTE/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="' . base_url() . 'resource/AdminLTE/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="' . base_url() . 'resource/AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="' . base_url() . 'resource/AdminLTE/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="' . base_url() . 'resource/AdminLTE/plugins/moment/moment.min.js"></script>
<script src="' . base_url() . 'resource/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="' . base_url() . 'resource/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="' . base_url() . 'resource/AdminLTE/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="' . base_url() . 'resource/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="' . base_url() . 'resource/AdminLTE/dist/js/adminlte.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="' . base_url() . 'resource/AdminLTE/dist/js/pages/dashboard.js"></script>
<script src="' . base_url() . 'resource/js/common/custom.js"></script>
</body>
</html>
';

        return $xecho;
    }

}

?>
