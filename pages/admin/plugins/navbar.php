<?php 
//SESSION
include '../../process/login.php';

if (!isset($_SESSION['username'])) {
  header('location:../../');
  exit;
} else if ($_SESSION['role'] == 'user') {
  header('location: ../../pages/stores/index.php');
  exit;
}
?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>

  <link rel="icon" href="../../dist/img/warehouse.png" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="../../dist/css/font.min.css">

  <link rel="stylesheet" href="../../dist/css/datatable/dataTables.dataTables.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Sweet Alert -->
  <link rel="stylesheet" href="../../plugins/sweetalert2/dist/sweetalert2.min.css">

  <link rel="stylesheet" href="../../plugins/datatable/dist/dataTables.dataTables.min.css">
  <style>
    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #536A6D;
      width: 50px;
      height: 50px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
    }

    .btn-file {
      position: relative;
      overflow: hidden;
    }
    .btn-file input[type=file] {
      position: absolute;
      top: 0;
      right: 0;
      min-width: 100%;
      min-height: 100%;
      font-size: 100px;
      text-align: right;
      filter: alpha(opacity=0);
      opacity: 0;
      outline: none;   
      cursor: inherit;
      display: block;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(1080deg); }
    } 
    .active{
      background-color: #AA2138 !important;
      border-bottom: 2px solid #ffffff !important;
      color: #fff;
    }
    .b-border{
      border-bottom: 2px solid #AA2138 !important;
    }
    .btn-func{
      color: #fff;
      background-color: #AA2138 !important;
      border-bottom: 2px solid #ccc !important;
    }
    .btn-func:hover{
      background-color: #942D3E !important;
      border-bottom: 2px solid #45141C !important;
      color: #fff;
    }
    .btn-del{
      font-size: 13px; 
      height: 35px; 
      color: #45141C;
      background: none;
      border: 1px solid #45141C !important;
    }
    .btn-del:hover{
      background-color: #942D3E !important;
      color: #fff !important;
    }

  </style>
</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../dist/img/warehouse.png" alt="logo" height="60" width="60">
    <noscript>
      <br>
      <span>We are facing <strong>Script</strong> issues. Kindly enable <strong>JavaScript</strong>!!!</span>
      <br>
      <span>Call IT Personnel Immediately!!! They will fix it right away.</span>
    </noscript>
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

