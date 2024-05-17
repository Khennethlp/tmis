<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/preloader.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php'; ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1 class="m-0" style="text-transform: uppercase;"><i class="fas fa-file-alt"></i>&nbsp; Inventory</h1> -->
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item ">Inventory</li>
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
              <h3 class="card-title"><i class="fas fa-tasks mr-2"></i> Inventory</h3>
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
              <!-- <div class="row"> -->
              <div class="col-sm-12">
                <!-- <div class="card"> -->

                <div class="row mb-4">
                  <!-- <button class="btn btn-del mx-3" id="deleteBtn" onclick="delete_data_arr()"><i class="fas fa-trash"></i></button> -->
                  <div class="col-sm-7">
                    <div class="dt-buttons btn-group flex-wrap">
                      <form id="file_form" enctype="multipart/form-data">
                        <button class="btn btn-func buttons-import buttons-html5" data-toggle="modal" data-target="#import_inv" tabindex="0" type="button">
                          <span><i class="fas fa-file-import mr-1"></i> Import</span>
                        </button>
                      </form>
                      <button class="btn btn-func buttons-excel buttons-html5" data-toggle="modal" data-target="#" tabindex="0" onclick="export_csv('inv_tbl')" type="button">
                        <span><i class="fas fa-file-csv mr-1"></i> Export</span>
                      </button>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="input-group input-group-sm" style="width: 300px; float:right;">
                      <input type="search" name="table_search" id="inv_search" style="height: 40px;" class="form-control float-right" placeholder="Search" autocomplete="off">
                      <div class="input-group-append">
                        <button type="button" class="btn btn-default" id="searchReqBtn" onclick="search_inv(1)">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- <div class="input-group input-group-sm" style="width: 300px; float:right;">
                          <input type="date" id="fromD_search" class="form-control" style="height: 40px; " placeholder="From Date" autocomplete="off">
                          <input type="date" id="toD_search" class="form-control" style="height: 40px; " placeholder="To Date" autocomplete="off">
  
                          <div class="input-group-append">
                          <button type="button" class="btn btn-default" id="searchReqBtn" onclick="search_by_date()">
                          <i class="fas fa-search"></i>
                          </button>
                          </div>
                        </div> -->
                <div class="row mb-2" id="t_t1_breadcrumb">
                <div class="col-12">
                  <ol class="breadcrumb bg-dark mb-0">
                    <li class="breadcrumb-item"><a href="#" onclick="load_inventory()">Back</a></li>
                    <li class="breadcrumb-item" id="lbl_c1"></li>
                  </ol>
                </div>
              </div>
                <div class="table-responsive p-0" style="height: 350px;">
                  <table class="table table-head-fixed text-nowrap" id="inv_tbl">
                    <thead>
                      <tr>
                        <!-- <th><input type="checkbox" name="" id="select_all" onclick="selectAll()" value="" style="cursor:pointer;"></th> -->
                        <th>#</th>
                        <th>Part Code</th>
                        <th>Part Name</th>
                        <th>Packing Qty</th>
                        <th>Stock Address</th>
                        <th>Barcode Label</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <!-- <th>By</th> -->
                      </tr>
                    </thead>
                    <tbody id="inventory_table"></tbody>
                  </table>
                </div>

              </div>
              <!-- </div> -->
              <!-- <div class="row">
                <p>&nbsp;&nbsp;&nbsp;&nbsp; Total: &nbsp;<span id="count"></span></p>
               
              </div> -->
            </div>
            <hr>
               <!-- pagination -->
               <div class="row mb-4">
                <div class="col-sm-12 col-md-9 col-9">
                  <div class="dataTables_info pl-4" id="inv_table_info" role="status" aria-live="polite"></div>
                  <input type="hidden" id="count_rows">
                </div>
                <div class="col-sm-12 col-md-1 col-1">
                  <button type="button" id="btnPrevPage" class="btn bg-gray-dark btn-flat rounded mx-4" onclick="get_prev_page()">Prev</button>
                </div>
                <div class="col-sm-12 col-md-1 col-1">
                  <input type="text" list="inv_table_paginations" class="form-control" id="inv_table_pagination">
                  <datalist id="inv_table_paginations"></datalist>
                  <!-- <div class="dataTables_paginate paging_simple_numbers" id="accounts_table_pagination">
                    </div> -->
                </div>
                <div class="col-sm-12 col-md-1 col-1">
                  <button type="button" id="btnNextPage" class="btn bg-gray-dark btn-flat mr-3 rounded" onclick="get_next_page()">Next</button>
                </div>
              </div>
            <!-- /.card-body -->
            <!-- </div> -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
  </section>
</div>

<?php include 'plugins/footer.php'; ?>
<?php include 'plugins/js/inventory_script.php'; ?>