<?php
include('plugins/header.php');
include('plugins/preloader.php');
include('plugins/navbar/index_navbar.php');
?>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <u>
            <h1 class="m-0" style="text-transform: uppercase;">Inventory</h1>
          </u>
        </div><!-- /.col -->

      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div id="funcContainer" style="display:none;">
            <div class="row mb-3">
              <div class="col-md-3">
                <div class="input-group input-group-sm" style="margin: 8px;">
                  <input type="search" name="table_search" id="inv_search" style="height:43px;" class="form-control float-right" placeholder="Search" autocomplete="off">
                  <div class="input-group-append">
                    <button type="button" class="btn btn-info" style="width: 80px; background-color:#275DAD;" id="searchReqBtn" onclick="search_inv(1)">
                      <i class="fas fa-search"></i>&nbsp; Search
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mb-2" id="t_t1_breadcrumb">
            <div class="col-12">
              <ol class="breadcrumb mb-0" style="background-color: #bbb;">
                <li class="breadcrumb-item"><i class="fas fa-chevron-left"></i> <a href="#" onclick="search_inv(1);">&nbsp;Back</a></li>
                <li class="breadcrumb-item" id="lbl_c1"></li>
              </ol>
            </div>
          </div>
          <div class="table-responsive p-0" style="height: 400px;">
            <table class="table table-head-fixed text-nowrap table-hover text-center" id="inv_tbl">
              <thead id="thead_t">
                <tr>
                  <th>#</th>
                  <th>Part Code</th>
                  <th>Part Name</th>
                  <th>Packing Qty</th>
                  <th>Stock Address</th>
                  <th>Barcode Label</th>
                  <th>Quantity</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody id="inventory_table"></tbody>
            </table>
          </div>
          <hr>
          <div class="row mb-4">
            <div class="col-sm-5 col-md-9 col-6 col-lg-9">
              <div class="dataTables_info pl-4" id="inv_table_info" role="status" aria-live="polite"></div>
              <input type="hidden" id="count_rows">
            </div>
            <div class="col-sm-2 col-md-1 col-2 col-lg-1">
              <button type="button" id="btnPrevPage" class="btn bg-gray-dark btn-flat rounded mx-5" onclick="get_prev_page()">Prev</button>
            </div>

            <div class="col-sm-3 col-md-1 col-2">
              <input type="text" list="inv_table_paginations" class="form-control" id="inv_table_pagination">
              <datalist id="inv_table_paginations"></datalist>
            </div>

            <div class="col-sm-2 col-md-1 col-1 rounded">
              <button type="button" id="btnNextPage" class="btn bg-gray-dark btn-flat mr-3 rounded" onclick="get_next_page()">Next</button>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>

<?php
include('plugins/footer.php');
include 'plugins/js/inventory_script.php';
?>