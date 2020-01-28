<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" href="<?= base_url('assets/img/logo/logo-smk.png'); ?>">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') ?>">

  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css">


  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/daterangepicker/daterangepicker.css') ?>">

  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">

  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/summernote/summernote-bs4.css') ?>">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/toastr/toastr.min.css') ?>">

  <link rel="stylesheet" href="<?= base_url('assets/plugins/chart.js/Chart.min.css') ?>">

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.standalone.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
    .img-preview {
      width: 100px;
      height: 100px;
      background-size: contain;
      border-radius: 10%;
    }

    .img-peserta {
      width: 250px;
      height: 250px;
      background-size: contain;
      border-radius: 50%;
    }

    .img-file {
      max-height: 140px !important;
      max-width: 100% !important;
    }

    .borderless td,
    .borderless th {
      border: none;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini" onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
  <div class="wrapper">

    <?php $this->load->view('templates/admin_sidebar'); ?>