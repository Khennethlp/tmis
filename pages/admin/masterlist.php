
<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/admin_bar.php';?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0" style="text-transform: uppercase;"><i class="fas fa-users"></i>&nbsp; Masterlist</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item ">Masterlist</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
<!--  
  <section class="content">
    <div class="row mb-2 mx-3">
      <a href=""  class="btn btn-danger mr-2" data-toggle="modal" data-target="#add_mlist" title="Add New Kanban Masterlist" style="width: 115px;"><i class="fas fa-plus mr-2"></i>Add New</a>
    <form id="file_form" enctype="multipart/form-data">
      <a href="" class="btn btn-warning mr-2" title="Import to Table" data-toggle="modal" data-target="#import_mlist" style="width: 100px;"><i class="fas fa-file-import mr-2"></i>Import</a>
    </form>
      <a href="" class="btn btn-success mr-2" title="Export Table" onclick="export_csv('mlist_table')" style="width: 100px;"><i class="fas fa-file-csv mr-2"></i>Export</a> -->

      <!-- PRINT BUTTON  -->
      <!-- <a href="" class="btn btn-info mr-2" title="Print Table" onclick="print()" style="width: 100px;"><i class="fas fa-print mr-2"></i>print</a> -->
    <!-- </div>
  </section> -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card card-danger card-outline">
            <div class="card-header">
              <!-- <h3 class="card-title"><i class="fas fa-users"></i>&nbsp;Kanban Masterlist</h3> -->
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                  <i class="fas fa-expand"></i>
                </button>
              </div>
              <div class="row">
              <div class="col-sm-12 col-md-6">
                    <div class="dt-buttons btn-group flex-wrap">               
                  <button class="btn btn-secondary buttons-csv buttons-html5" data-toggle="modal" data-target="#add_mlist" tabindex="0" type="button"><span>ADD</span></button> 
                  <button class="btn btn-secondary buttons-csv buttons-html5" data-toggle="modal" data-target="#import_mlist" tabindex="0"  type="button"><span>IMPORT</span></button> 
                  <button class="btn btn-secondary buttons-excel buttons-html5" data-toggle="modal" data-target="#" tabindex="0" onclick="export_csv('mlist_table')" type="button"><span>CSV</span></button> 
                </div>
              </div>
              </div>
              <!-- <div class="row">
              <button class="btn btn-danger mx-1" data-toggle="modal" data-target="#add_mlist" title="Add New Kanban Masterlist" style="width: 100px;"><i class="fas fa-plus"></i> Add</button>
              <form id="file_form" enctype="multipart/form-data">
                <a class="btn btn-warning mx-1" title="Import to Table" data-toggle="modal" data-target="#import_mlist" style="width: 100px;"><i class="fas fa-file-import"></i> Import</a>
              </form>
              <button class="btn btn-success mx-1" title="Export Table" onclick="export_csv('mlist_table')" style="width: 100px;"><i class="fas fa-file-csv mr-2"></i> Export</button>
              </div> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
       
              <div class="row mb-3">
                <div class="col-sm-3">
                  <label>Search:</label>
                  <input type="search" id="mlist_search" class="form-control" placeholder="Search here..." autocomplete="off">
                </div>
                <div class="col-sm-3">
                  <label>&nbsp;</label>
                  <button class="btn btn-block btn-white" style="background: #F2F5F7; width: 40px;" id="searchReqBtn" onclick="search_mlist();"><i class="fas fa-search mr-2"></i></button>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-2">
                  <label>From Date:</label>
                  <input type="date" id="fromD_search" class="form-control" placeholder="From Date" autocomplete="off">
                </div>
                <div class="col-sm-2">
                  <label>To Date:</label>
                  <input type="date" id="toD_search" class="form-control" placeholder="To Date" autocomplete="off">
                </div>
                <div class="col-sm-1">
                  <label>&nbsp;</label>
                  <button class="btn btn-block btn-white" style="background: #F2F5F7; width: 40px;" id="searchReqBtn" onclick="search_by_date();"><i class="fas fa-search mr-2"></i></button>
                </div>
              </div>
              <div class="table-responsive" style="height: 300px; overflow: auto; display:inline-block;">
                <table class="table table-head-fixed text-nowrap table-hover" id="mlist_table">
                  <thead style="text-align:center;">
                    <th> # </th>
                    <th> Part Code </th>
                    <th> Part Name </th>
                    <th> Packing Quantity </th>
                  </thead>
                  <tbody id="kanban_mlist" style="text-align:center;"></tbody>
                </table>
              </div>
              <div class="row">
              <p>Total: <span id="count_mlist"></span> </p>
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
<?php include 'plugins/js/masterlist_script.php';?>