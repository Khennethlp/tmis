<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/preloader.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php'; ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1 class="m-0"><i class="fas fa-download"></i> STORE OUT</h1> -->
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item ">Store-out</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-upload mr-2"></i> Store Out</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-md-4">
                  <div class="input-group input-group-sm" style="margin: 8px;">
                    <input type="search" name="table_search" id="partsout_search" style="height: 40px;" class="form-control float-right" placeholder="Search" autocomplete="off">
                    <div class="input-group-append">
                      <button type="button" class="btn btn-info" style="width: 80px; background-color:#275DAD;" id="searchReqBtn" onclick="search_partsout(1)">
                        <i class="fas fa-search"></i>&nbsp; Search
                      </button>
                    </div>
                  </div>
                </div>
                <div class="col-0 ml-auto mx-3 mt-2">
                  <!-- <button class="btn btn-func buttons-excel buttons-html5" data-toggle="modal" data-target="#" tabindex="0" onclick="export_csv('partsout_tbl')" type="button"> -->
                  <button class="btn btn-func buttons-excel buttons-html5" onclick="export_partsout();">
                    <span><i class="fas fa-file-csv mr-1"></i> Export</span>
                  </button>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="card-body table-responsive p-0" style="height: 350px;">
                    <table class="table table-head-fixed text-nowrap" id="partsout_tbl">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Part Code</th>
                          <th>Part Name</th>
                          <th>Packing Qty</th>
                          <th>Stock Address</th>
                          <th>Barcode Label</th>
                          <th>Date</th>
                          <!-- <th>By</th> -->
                        </tr>
                      </thead>
                      <tbody id="partsout_table"></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <!-- pagination -->
            <div class="row mb-4">
              <div class="col-sm-5 col-md-9 col-6 col-lg-9">
                <div class="dataTables_info pl-4" id="partsout_table_info" role="status" aria-live="polite"></div>
                <input type="hidden" id="count_rows">
              </div>
              <div class="col-sm-2 col-md-1 col-2 col-lg-1">
                <button type="button" id="btnPrevPage" class="btn bg-gray-dark btn-flat rounded mx-4" onclick="get_prev_page()">Prev</button>
              </div>
              <div class="col-sm-3 col-md-1 col-2">
                <input type="text" list="partsout_table_paginations" class="form-control" id="partsout_table_pagination">
                <datalist id="partsout_table_paginations"></datalist>
              </div>
              <div class="col-sm-2 col-md-1 col-1 rounded">
                <button type="button" id="btnNextPage" class="btn bg-gray-dark btn-flat mr-3 rounded" onclick="get_next_page()">Next</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</section>
</div>

<?php include 'plugins/footer.php'; ?>
<?php include 'plugins/js/partsout_script.php'; ?>