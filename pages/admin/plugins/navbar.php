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
    body.light-mode{
      color: black;
    }
    body.dark-mode{
      color: white;
    }
    .active{
      background-color: #275DAD !important; /*#000EA4*/
      border-bottom: 2px solid #ffffff !important;
      color: #fff;
    }

    .b-border{
      border-bottom: 2px solid #275DAD !important;
    }
    .btn-func{
      color: #fff ;
      background-color: #3B83EF !important;
      /* width: 100%; */
      /* border: 1px solid #5B616A !important; */
    }
    
    .btn-func:hover{
       /* background: rgba(255, 255, 255, 0.2); */
      /* border: 2px solid #5B616A !important; */
      color: #bbb;
    }
    .btn-del{
      background-color: var(--danger) !important;
      font-size: 13px; 
      height: 35px; 
      color: #fff;
      background: none;
      border: 1px solid #ccc !important;
    }
    .btn-del:hover{
      background-color: var(--danger) !important;
      color: #bbb !important;
    }
    .subBtn{
      background-color: #3765AA;
      color: #fff;
    }
    .subBtn:hover{
      background-color: #3765AA !important;
      color: #bbb;
    }
    .nav-link {
      cursor: pointer;
    }
    .nav-link:hover {
      cursor: pointer;
      background-color: #bbb;
      /* color:#275DAD !important; */
    }

    .dropdown-item{
      cursor: pointer;
    }
    .nav-link .i-user {
      font-size: 22px;
    }

    .nav-link.no-caret::after {
      display: none;
    }

    .info {
      position: relative;
      padding-right: 30px;
      cursor: pointer;
    }
    .copy-icon {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      display: none;
      cursor: pointer;
    }
    
    .info:hover > .copy-icon {
      display: block;
    }

    
    ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    li a {
      /* padding: 5px; */
      display: inline-flex;
      /* Ensure the padding and width apply correctly */

    }

    .searchBy-item {
      padding: 2px 0;
      max-width: 100px;
      /* margin: 0 0px; */
    }
    .select_all{
      /* display: none; */
      cursor:pointer; 
    }
    input[type=text]:focus,
    input[type=password]:focus, 
    input[list]:focus, 
    select:focus, input[type=number]:focus
     {
      border: 1px solid #458487 !important;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand" id="navbar">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-dark" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <div class="row">
      <li class="nav-item dropdown mx-4">
        <a class="nav-link dropdown-toggle no-caret btn" data-toggle="modal" data-target="#logout_modal" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:#275DAD; color:#fff;">
          <i class="far fa-user-circle i-user ">&nbsp;Logout</i> 
        </a>
        <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item " data-toggle="modal" data-target="#logout_modal" >
          <i class="fas fa-sign-out-alt mr-3 text-md"></i>
            LOGOUT
          </a>
        </div> -->
      </li>
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li> -->
      </div>
    </ul>
  </nav>
  <!-- /.navbar -->

