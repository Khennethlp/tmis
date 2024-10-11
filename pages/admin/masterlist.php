<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/preloader.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php'; ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <!-- <h1 class="m-0" style="text-transform: uppercase;"><i class="fas fa-users"></i>&nbsp; Masterlist</h1> -->
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item ">Masterlist</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="far fa-list-alt mr-2"></i>&nbsp; Masterlist</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="col-md-12">
                <div class="row mb-3">
                  <div class="col-md-4">
                    <div class="input-group input-group-sm">
                      <input type="search" name="table_search" id="mlist_search" class="form-control" style="height: 40px;" placeholder="Search" autocomplete="off">
                      <div class="input-group-append">
                        <button type="button" class="btn btn-info" style="width: 80px; background-color:#275DAD;" id="searchReqBtn" onclick="search_mlist(1)">
                          <i class="fas fa-search"></i> Search
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="col-0 mx-3 ml-auto">
                    <button class="btn btn-del mx-3" id="deleteBtn" onclick="delete_data_arr()">DEL</button>
                    <button class="btn btn-func buttons-csv buttons-html5" data-toggle="modal" data-target="#add_mlist" tabindex="0" type="button">
                      <span><i class="fas fa-plus mr-1"></i> Add New</span>
                    </button>
                    <!-- <button class="btn btn-func buttons-excel buttons-html5" data-toggle="modal" data-target="#" tabindex="0" onclick="export_csv('mlist_table')" type="button"> -->
                    <button class="btn btn-func buttons-excel buttons-html5" data-toggle="modal" data-target="#" tabindex="0" onclick="export_mlist();" type="button">
                      <span><i class="fas fa-file-export mr-1"></i> Export</span>
                    </button>
                  </div>
                </div>
              </div>

              <div class="table-responsive" style="height: 350px; overflow: auto; display:inline-block;">
                <table class="table table-head-fixed text-nowrap table-hover" id="mlist_table">
                  <thead style="text-align:center;">
                    <th><input type="checkbox" name="" class="select_all" id="select_all" onclick="selectAll()" value=""></th>
                    <th> # </th>
                    <th> Part Code </th>
                    <th> Part Name </th>
                    <th> Packing Quantity </th>
                  </thead>
                  <tbody id="kanban_mlist" style="text-align:center;"></tbody>
                </table>
              </div>
              <hr>
              <!-- pagination -->
              <div class="row mb-4">
                <div class="col-sm-5 col-md-9 col-6 col-lg-9">
                  <div class="dataTables_info pl-4" id="mlist_table_info" role="status" aria-live="polite"></div>
                  <input type="hidden" id="count_rows">
                </div>
                <div class="col-sm-2 col-md-1 col-2 col-lg-1">
                  <button type="button" id="btnPrevPage" class="btn bg-gray-dark btn-flat rounded mx-4" onclick="get_prev_page()">Prev</button>
                </div>
                <div class="col-sm-3 col-md-1 col-2">
                  <input type="text" list="mlist_table_paginations" class="form-control" id="mlist_table_pagination">
                  <datalist id="mlist_table_paginations"></datalist>
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
<?php include 'plugins/js/masterlist_script.php'; ?>