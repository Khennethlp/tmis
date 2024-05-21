<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/preloader.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php'; ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <!-- <h1 class="m-0">Accounts Management</h1> -->
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item "> Accounts Management</li>

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
              <h3 class="card-title"><i class="fas fa-user-cog mr-2"></i>&nbsp; Accounts Management </h3>
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
              <div class="col-12 mb-2 mb-4">
                <div class="row align-items-center">
                  <div class="col-12 col-md-6 col-lg-6">
                    <div class="dt-buttons btn-group flex-wrap">
                      <button class="btn btn-func buttons-add buttons-html5" data-toggle="modal" data-target="#add_acc" tabindex="0" type="button">
                        <span><i class="fas fa-user-plus mr-1"></i>New User</span>
                      </button>
                      <button class="btn btn-func buttons-import buttons-html5" data-toggle="modal" data-target="#import_acc" tabindex="0" type="button">
                        <span><i class="fas fa-file-import mr-1"></i>Import</span>
                      </button>
                      <button class="btn btn-func buttons-csv buttons-html5" data-toggle="modal" data-target="#" tabindex="0" onclick="export_csv('search_accounts')" type="button">
                        <span><i class="fas fa-file-csv mr-1"></i>Export</span>
                      </button>
                    </div>
                  </div>
                  <div class="col-sm-3"></div>
                  <div class="col-12 col-md-6 col-lg-3">
                    <div class="input-group input-group-sm">
                      <input type="search" name="table_search" id="acc_search" style="height: 40px;" class="form-control" placeholder="Search" autocomplete="off">
                      <div class="input-group-append">
                        <button type="button" class="btn btn-default" id="searchReqBtn" onclick="search_accounts(1)">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <!-- <div class="col-sm-2">
              <label>User Type:</label>
                <select id="user_type_search" class="form-control">
                  <option value="">Select User Type</option>
                  <option value="admin">Admin</option>
                  <option value="user">User</option>
                </select>
              </div> -->
              <div class="table-responsive dataTable dtr-inline collapsed" style="height: 350px; overflow: auto; display:inline-block;">
                <table class="table table-head-fixed text-nowrap table-hover" id="search_accounts">
                  <thead style="text-align:center;">
                    <th> # </th>
                    <th> Employee ID </th>
                    <th> Full Name </th>
                    <th> Username </th>
                    <th> Dept/Section </th>
                    <th> User Type </th>
                  </thead>
                  <tbody id="list_of_accounts" style="text-align:center;"></tbody>
                </table>
              </div>
            </div>
            <hr>
            <!-- pagination -->
            <div class="row mb-4">
            <div class="col-sm-5 col-md-9 col-6 col-lg-9">
                <div class="dataTables_info pl-4" id="account_table_info" role="status" aria-live="polite"></div>
                <input type="hidden" id="count_rows">
              </div>
              <div class="col-sm-2 col-md-1 col-2 col-lg-1">
                <button type="button" id="btnPrevPage" class="btn bg-gray-dark btn-flat rounded mx-4" onclick="get_prev_page()">Prev</button>
              </div>
              <div class="col-sm-3 col-md-1 col-2">
                <input type="text" list="account_table_paginations" class="form-control" id="account_table_pagination">
                <datalist id="account_table_paginations"></datalist>
                <!-- <div class="dataTables_paginate paging_simple_numbers" id="accounts_table_pagination">
                    </div> -->
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


<?php include 'plugins/footer.php'; ?>
<?php //include 'plugins/js/script.php';
?>
<?php include 'plugins/js/accounts_script.php'; ?>