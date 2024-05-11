<?php 
//SESSION
include '../../process/login.php';

// if (!isset($_SESSION['username'])) {
//   header('location:../../');
//   exit;
// } else if ($_SESSION['role'] == 'user') {
//   header('location: ../../pages/stores/index.php');
//   exit;
// }
?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="description" content="tmis" />
  <meta name="keywords" content="tmis" />

  <title>Store-in-&-out</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="preload" href="../../dist/css/font.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <!-- Font Awesome Icons -->
  <link rel="preload" href="../../plugins/fontawesome-free/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <!-- Theme style -->
  <link rel="preload" href="../../dist/css/adminlte.min.css" as="style" onload="this.rel='stylesheet'">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <noscript>
    <link rel="stylesheet" href="../../dist/css/font.min.css">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  </noscript>

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

  <link rel="icon" type="image/x-icon" href="../../dist/img/warehouse.png">

  <style>
    .nav-active{
      background-color: #AA2138 !important;
      color: #fff;
      border-radius: 5px !important;
      /* border-bottom: 2px solid #ffffff !important; */
    }
  </style>
</head>