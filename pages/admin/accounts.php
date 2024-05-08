<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/admin_bar.php';?>

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
          <div class="card card-danger card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-users"></i>&nbsp; Accounts Management </h3>
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
              <div class="col-sm-12 mb-3">
                    <div class="row">
                    <div class="col-sm-6">
                    <div class="dt-buttons btn-group flex-wrap">               
                    <button class="btn btn-func buttons-add buttons-html5" data-toggle="modal" data-target="#add_acc" tabindex="0" type="button"><span><i class="fas fa-plus mr-1"></i>ADD ACCOUNT</span></button> 
                    <button class="btn btn-func buttons-import buttons-html5" data-toggle="modal" data-target="#import_acc" tabindex="0"  type="button"><span><i class="fas fa-file-import mr-1"></i>IMPORT ACCOUNT</span></button> 
                    <button class="btn btn-func buttons-csv buttons-html5" data-toggle="modal" data-target="#" tabindex="0" onclick="export_csv('accounts_table')" type="button"><span><i class="fas fa-file-export mr-1"></i>EXPORT ACCOUNT</span></button> 
                  </div>
                    </div> 
                    <div class="col-sm-6">
                      <div class="input-group input-group-sm" style="width: 300px; float:right;">
                        <input type="search" name="table_search" id="acc_search" style="height: 35px; "  class="form-control float-right" placeholder="Search" autocomplete="off">
                        <div class="input-group-append">
                        <button type="button" class="btn btn-default" id="searchReqBtn" onclick="search_accounts()">
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
              <div class="table-responsive dataTable dtr-inline collapsed" style="height: 400px; overflow: auto; display:inline-block;">
                <table class="table table-head-fixed text-nowrap table-hover" id="accounts_table">
                  <thead style="text-align:center;">
                    <th> # </th>
                    <th> Employee ID </th>
                    <th> Full Name </th>
                    <th> Username </th>
                    <th> Section </th>
                    <th> User Type </th>
                  </thead>
                  <tbody id="list_of_accounts" style="text-align:center;"></tbody>
                </table>
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


<?php include 'plugins/footer.php';?>
<?php //include 'plugins/js/script.php';?>
<?php include 'plugins/js/accounts_script.php';?>