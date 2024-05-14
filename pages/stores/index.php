<?php
include('plugins/header.php');
include('plugins/preloader.php');
include('plugins/navbar/index_navbar.php');
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
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="row">
          <div class="col-md-6">
            <input type="text" class="form-control" name="" id="store_in_address" placeholder="SCAN STOCK QR..." style="border: 1px solid black; height: 50px;" autofocus>
          </div>
          <div class="col-md-6">
            <input type="password" class="form-control" name="" id="store_in_qr" placeholder="SCAN KANBAN QR TO STORE IN..." onchange="save_to_local_storage()" oninput="trim_white_space(event);" style="border: 1px solid black; height: 50px;" autocomplete="off">
          </div>
        </div>
      </div>
    </div>
    <a href="" class="float-right" onclick="clearLocalStorage()">Clear All</a>
    <div class="table-responsive dataTable dtr-inline collapsed" style="height: 400px; overflow: auto; display:inline-block;">
      <table class="table table-head-fixed text-nowrap table-hover" id="search_accounts">
        <thead style="text-align:center;">
          <th>#</th>
          <th>Part Code</th>
          <th>Part Name</th>
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