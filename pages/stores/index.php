<?php
include('plugins/header.php');
include('plugins/preloader.php');
include('plugins/navbar/index_navbar.php');
// echo gethostname();
// echo gethostbyaddr($_SERVER['REMOTE_ADDR']);
// echo $_SERVER['HTTP_USER_AGENT'];
?>
<style>
  body,
  html {
    margin: 0;
    padding: 0;
    height: 100%;
    /* overflow: hidden; */
  }

  #reader {
    width: 100vw;
    height: 100vh;
    display: none;
    object-fit: cover;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="row mb-2 ml-1 mr-1">
      <div class="col-sm-6">
      <u><h1 class="m-0"> STORE IN</h1></u>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active">Store-in</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <!-- <button id="startButtonAddr">Start Camera Address</button>
    <button id="startButtonKan">Start Camera Kanban</button> -->
    <!-- <div id="reader" style="width:100px; height:100px; display: block;"></div> -->
    <!-- <video id="reader" style="width:200px; height:200px;" playsinline></video>
    <div id="result" style="display: block;"></div> -->
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="row">
          <div class="col-md-6">
            <label for="">SCAN STOCK ADDRESS QR:</label>
            <input type="text" class="form-control" name="" id="store_in_address" placeholder="Stock Address Qr here..." autocomplete="off" autofocus>
          </div>
          <div class="col-md-6">
          <label for="">SCAN KANBAN QR:</label>
            <input type="text" class="form-control" id="store_in_qr" placeholder="Kanban Qr here..." onchange="insert_partsin(); save_to_local_storage();" onkeydown="return true;" oninput="trim_white_space(event);" style=" height: 50px;" autocomplete="off">
          </div>
        </div>
      </div>
    </div>
    <!-- <a href="" class="float-right mx-3 my-2 btnClearSession" onclick="clearSessionStorage()">Clear All</a> -->
    <div class="table-responsive dataTable dtr-inline collapsed" style="height: 400px; overflow: auto; display:inline-block;">
      <table class="table table-head-fixed text-nowrap table-hover" id="search_accounts">
        <thead style="text-align:center;">
          <th>#</th>
          <th>Part Code</th>
          <!-- <th>Part Name</th> -->
          <th>Packing Qty</th>
          <th>Stock Address</th>
          <th>Barcode Label</th>

        </thead>
        <tbody id="partsin_table" style="text-align:center;"></tbody>
      </table>
    </div>
  </div>
</div>
<!-- /.content-wrapper -->

<?php
include('plugins/footer.php');
include('plugins/js/index_script.php');
include('plugins/js/partsin_script.php');
?>