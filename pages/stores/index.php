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
              <input type="text" class="form-control" name="" id="store_in_address" placeholder="SCAN RACK QR..." style="border: 1px solid black;" autofocus>
            </div>
            <div class="col-md-6">
              <input type="password" class="form-control" name="" id="store_in_qr" placeholder="SCAN KANBAN QR TO STORE IN..." onchange="insert_partsin()" oninput="trim_white_space(event);" style="border: 1px solid black;"  autocomplete="off">
              </div>
          </div>
        </div>
      </div>
        <div class="table-responsive dataTable dtr-inline collapsed" style="height: 400px; overflow: auto; display:inline-block;">
          <table class="table table-head-fixed text-nowrap table-hover" id="search_accounts">
            <thead style="text-align:center;">
              <th>#</th>
              <th>Part Code</th>
              <th>Part Name</th>
              <th>Packing Qty</th>
              <th>Stock Address</th>
              <th>Barcode Label</th>
              <th>Date</th>
              <th>By</th>
            </thead>
            <tbody id="partsin_table" style="text-align:center;">
          </tbody>
          </table>
        </div>
    </div>
     <!-- pagination -->
     <div class="row mb-4">
        <div class="col-sm-12 col-md-9 col-9">
          <div class="dataTables_info pl-4" id="partsin_table_info" role="status" aria-live="polite"></div>
          <input type="hidden" id="count_rows">
        </div>
        <div class="col-sm-12 col-md-1 col-1">
          <button type="button" id="btnPrevPage" class="btn bg-gray-dark btn-flat" onclick="get_prev_page()">Prev</button>
        </div>
        <div class="col-sm-12 col-md-1 col-1">
          <input type="text" list="partsin_table_paginations" class="form-control" id="partsin_table_pagination">
          <datalist id="partsin_table_paginations"></datalist>
          <!-- <div class="dataTables_paginate paging_simple_numbers" id="accounts_table_pagination">
          </div> -->
        </div>
        <div class="col-sm-12 col-md-1 col-1">
          <button type="button" id="btnNextPage" class="btn bg-gray-dark btn-flat mr-3" onclick="get_next_page()">Next</button>
        </div>
      </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
include('plugins/footer.php');
include('plugins/js/index_script.php');
include('plugins/js/partsin_script.php');
?>
