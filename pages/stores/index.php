<?php
include('plugins/header.php');
include('plugins/preloader.php');
include('plugins/navbar/index_navbar.php');
// echo gethostname();
echo gethostbyaddr($_SERVER['REMOTE_ADDR']);
// echo $_SERVER['HTTP_USER_AGENT'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="row mb-2 ml-1 mr-1">
      <div class="col-sm-6">
        <h1 class="m-0"> Store-in</h1>
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
  <button id="startButton">Start Camera</button>
    <div id="reader" style="width:100px; height:100px; display: none;"></div>
    <div id="result" style="display: none;"></div>
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="row">
          <div class="col-md-6">
            <label for="">SCAN STOCK ADDRESS QR:</label>
            <input type="text" class="form-control" name="" id="store_in_address" placeholder="Stock Address Qr here..." style=" height: 50px;" autocomplete="off" autofocus>
          </div>
          <div class="col-md-6">
          <label for="">SCAN KANBAN QR:</label>
            <input type="text" class="form-control" id="store_in_qr" placeholder="Kanban Qr here..." onchange="insert_partsin(); save_to_local_storage();" onkeydown="return true;" oninput="trim_white_space(event);" style=" height: 50px;" autocomplete="off">
          </div>
        </div>
      </div>
    </div>
    <a href="" class="float-right mx-3 my-2 btnClearSession" onclick="clearSessionStorage()">Clear All</a>
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
        <tbody id="partsin_table" style="text-align:center;">
        </tbody>
      </table>
    </div>
  </div>

  <!-- /.content -->
  <!-- pagination -->
</div>
<!-- /.content-wrapper -->

<?php
include('plugins/footer.php');
include('plugins/js/index_script.php');
include('plugins/js/partsin_script.php');
?>