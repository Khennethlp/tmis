<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/admin_bar.php';?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <!-- <h1 class="m-0">Masterlist</h1> -->
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
              <h3 class="card-title"><i class="fas fa-users"></i>&nbsp; Manage Accounts</h3>
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
              <div class="row mb-2">
                <div class="col-sm-3"> 
                  <!-- <label>Search:</label> -->
                  <input type="search" id="acc_search" class="form-control" placeholder="Type here..." autocomplete="off">
                </div>
                <div class="col-sm-1">
                  <button class="btn btn-block " id="searchReqBtn" style="background: #F2F5F7; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3); width: 100px;" onclick="search_accounts()"><i class="fas fa-search mr-2"></i>Search</button>
                </div>
                <div class="col-md-3"></div>
                <div class="col-sm-1 mr-2">
                  <button class="btn btn-block btn-danger" id="" data-toggle="modal" data-target="#add_acc" style="width: 100px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);" onclick=""><i class="fas fa-plus mr-2"></i>Add</button>
                </div>
                <div class="col-sm-1 mr-2">
                  <button class="btn btn-block btn-warning" id="" data-toggle="modal" data-target="#import_acc" style="width: 100px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);" onclick=""><i class="fas fa-file-import mr-2"></i>Import</button>
                </div>
                <div class="col-sm-1 mr-2">
                  <button class="btn btn-block btn-success" id="" data-toggle="modal" data-target="#" style="width: 100px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);" onclick="export_csv('accounts_table')"><i class="fas fa-file-csv mr-2"></i>Export</button>
                </div>
                <div class="col-sm-1 mr-2">
                  <button class="btn btn-block btn-info" id="" data-toggle="modal" data-target="#" style="width: 100px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);" onclick=""><i class="fas fa-print mr-2"></i>Print</button>
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
      
              </div>
              <div class="table-responsive" style="height: 400px; overflow: auto; display:inline-block;">
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
<?php //include 'plugins/js/script.php';?>
<?php include 'plugins/js/accounts_script.php';?>