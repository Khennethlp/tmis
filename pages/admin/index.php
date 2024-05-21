<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/preloader.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php'; ?>

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
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-download mr-2"></i> Store In</h3>
              <!-- <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                  <i class="fas fa-expand"></i>
                </button>
              </div> -->

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-md-12 mb-4">
                  <div class="dt-buttons btn-group flex-wrap">
                    <!-- <form id="file_form" enctype="multipart/form-data">
                      <button class="btn btn-func buttons-import buttons-html5" data-toggle="modal" data-target="#import_inv" tabindex="0" type="button">
                        <span><i class="fas fa-file-import mr-1"></i> IMPORT INVENTORY</span>
                      </button>
                    </form> -->
                    <button class="btn btn-func buttons-excel buttons-html5" data-toggle="modal" data-target="#" tabindex="0" onclick="export_csv('partsin_tbl')" type="button">
                      <span><i class="fas fa-file-csv mr-1"></i> Export</span>
                    </button>
                    <!-- <button class="btn btn-func buttons-excel buttons-html5" onclick="print()">Print</button> -->
                  </div>
                  <div class="col-sm-6 float-right">
                    <!-- <div class="input-group input-group-sm mb-1" style="width: 300px; float:right;">
                      <input type="date" id="fromD_search" class="form-control" style="height: 40px; " placeholder="From Date" autocomplete="off">
                      <input type="date" id="toD_search" class="form-control" style="height: 40px; " placeholder="To Date" autocomplete="off">
                      <div class="input-group-append">
                        <button type="button" class="btn btn-default" id="searchReqBtn" onclick="search_by_date()">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div> -->
                    <div class="input-group input-group-sm" style="width: 300px; float:right; margin-left: 40px;">
                      <input type="search" name="table_search" id="partsin_search" style="height: 40px; " class="form-control float-right" placeholder="Search" autocomplete="off">
                      <div class="input-group-append">
                        <button type="button" class="btn btn-default" id="searchReqBtn" onclick="search_partsin(1)">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="card-body table-responsive p-0" style="height: 350px;">
                    <table class="table table-head-fixed text-nowrap" id="partsin_tbl">
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
                      <tbody id="partsin_table"></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <!-- pagination -->
            <div class="row mb-4">
              <div class="col-sm-5 col-md-9 col-6 col-lg-9">
                <div class="dataTables_info pl-4" id="partsin_table_info" role="status" aria-live="polite"></div>
                <input type="hidden" id="count_rows">
              </div>
              <div class="col-sm-2 col-md-1 col-2 col-lg-1">
                <button type="button" id="btnPrevPage" class="btn bg-gray-dark btn-flat rounded mx-4" onclick="get_prev_page()">Prev</button>
              </div>
              <div class="col-sm-3 col-md-1 col-2">
                <input type="text" list="partsin_table_paginations" class="form-control" id="partsin_table_pagination">
                <datalist id="partsin_table_paginations"></datalist>
              </div>
              <div class="col-sm-2 col-md-1 col-1 rounded">
                <button type="button" id="btnNextPage" class="btn bg-gray-dark btn-flat mr-3 rounded" onclick="get_next_page()">Next</button>
              </div>
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

<?php include 'plugins/footer.php'; ?>
<?php include 'plugins/js/partsin_script.php'; ?>