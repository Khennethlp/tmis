<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/admin_bar.php';?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1 class="m-0"><i class="fas fa-download"></i> STORE IN</h1> -->
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item ">Store-in</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card card-danger card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-download"></i> Store In</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                  <i class="fas fa-expand"></i>
                </button>
              </div>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="row">
              <div class="col-md-12 mb-3">
                <!-- <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="" id="store_in_address" placeholder="SCAN RACK QR..." style="border: 1px solid black;" autofocus>
                  </div>
                  <div class="col-md-6">
                    <input type="password" class="form-control" name="" id="store_in_qr" placeholder="SCAN KANBAN QR TO STORE IN..."  oninput="trim_white_space(event);" style="border: 1px solid black;"  autocomplete="off">
                    </div>
                </div> -->
                <div class="input-group input-group-sm" style="width: 300px; float:right; margin-left: 40px;">
                  <input type="search" name="table_search" id="partsin_search" style="height: 40px; "  class="form-control float-right" placeholder="Search" autocomplete="off">
                  <div class="input-group-append">
                  <button type="button" class="btn btn-default" id="searchReqBtn" onclick="search_partsin(1)">
                  <i class="fas fa-search"></i>
                  </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Part Code</th>
                        <th>Part Name</th>
                        <th>Packing Qty</th>
                        <th>Stock Address</th>
                        <th>Barcode Label</th>
                        <th>Date</th>
                        <th>By</th>
                      </tr>
                    </thead>
                    <tbody id="partsin_table"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <hr>
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
        </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
  </section>
</div>

<?php include 'plugins/footer.php';?>
<?php include 'plugins/js/partsin_script.php';?>