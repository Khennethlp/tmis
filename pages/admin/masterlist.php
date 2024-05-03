
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
            <li class="breadcrumb-item ">Masterlist</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
 
  <!-- <section class="content">
    <div class="container-fluid">
      
      <div class="row">
        
        <div class="col-lg-3 col-6">
         
          <a href="#" data-toggle="modal" data-target="#add_mlist">
            <div class="small-box bg-danger" >
              <div class="inner">
                <h4>ADD MASTERLIST</h4>
                <br>
                <p></p>
              </div>
              <div class="icon">
                <i class="fa fa-plus-circle"></i>
              </div>
            </div>
        </div>
        </a> -->
       
        <!-- <div class="col-lg-3 col-6" >
          <a href="" data-toggle="modal" data-target="#history_modal">
            <div class="small-box bg-success">
              <div class="inner">
                <h4>HISTORY</h4>
                <br>
                <p></p>
              </div>
              <div class="icon">
                <i class="fa fa-history"></i>
              </div>
            </div>
        </div>
        </a> -->
        <!-- ./col -->
        <!-- <div class="col-lg-3 col-6">
        
          <a href="#" data-toggle="modal" data-target="#import_employee">
            <div class="small-box bg-success">
              <div class="inner">
                <h4>IMPORT</h4>
                <br>
                <p></p>
              </div>
              <div class="icon">
                <i class="fas fa-file-import"></i>
              </div>
            </div>
          </a>
        </div> -->
        <!-- ./col -->
        <!-- <div class="col-lg-3 col-6">
          <a href="#"">
            <div class="small-box bg-info">
              <div class="inner">
                <h4>EXPORT</h4>
                <br>
                <p></p>
              </div>
              <div class="icon">
                <i class="fas fa-file-export"></i>
              </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
          <a href="#"">
            <div class="small-box bg-warning">
              <div class="inner">
                <h4>IMPORT</h4>
                <br>
                <p></p>
              </div>
              <div class="icon">
                <i class="fas fa-file-import"></i>
              </div>
            </div>
        </div>
        </a>
      </div>
    </div> -->

  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card card-danger card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-users"></i>&nbsp;Kanban Masterlist</h3>
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
              <a href=""  class="btn btn-danger mr-2" data-toggle="modal" data-target="#add_mlist" title="Add New Kanban Masterlist" style="width: 115px;"><i class="fas fa-plus mr-2"></i>Add New</a>
              <!-- <label for="" style="color: #ADACB5; font-size: 14px;">Add New</label> -->
            <form id="file_form" enctype="multipart/form-data">
              <a href="" class="btn btn-warning mr-2" title="Import to Table" data-toggle="modal" data-target="#import_mlist" style="width: 100px;"><i class="fas fa-file-import mr-2"></i>Import</a>
              <!-- <label for="" style="color: #ADACB5; font-size: 14px;">Import</label> -->
            </form>
              <a href="" class="btn btn-success mr-2" title="Export Table" onclick="export_csv('mlist_table')" style="width: 100px;"><i class="fas fa-file-csv mr-2"></i>Export</a>
              <!-- <label for="" style="color: #ADACB5; font-size: 14px;">Export</label> -->
              <a href="" class="btn btn-info mr-2" title="Print Table" style="width: 100px;"><i class="fas fa-print mr-2"></i>print</a>
              <!-- <label for="" style="color: #ADACB5; ">Print</label> -->
           </div>
              <div class="row mb-4">
                <div class="col-sm-2">
                  <label>Search:</label>
                  <input type="search" id="mlist_search" class="form-control" placeholder="Search here..." autocomplete="off">
                </div>
                <div class="col-sm-2">
                  <label>&nbsp;</label>
                  <button class="btn btn-block btn-white" style="background: #F2F5F7; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3); width: 100px;" id="searchReqBtn" onclick="search_mlist();"><i class="fas fa-search mr-2"></i>Search</button>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-2">
                  <label>From Date:</label>
                  <input type="date" id="fromD_search" class="form-control" placeholder="Search here..." autocomplete="off">
                </div>
                <div class="col-sm-2">
                  <label>To Date:</label>
                  <input type="date" id="toD_search" class="form-control" placeholder="Search here..." autocomplete="off">
                </div>
                <div class="col-sm-2">
                  <label>&nbsp;</label>
                  <button class="btn btn-block btn-white" style="background: #F2F5F7; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3); width: 100px;" id="searchReqBtn" onclick="search_by_date();"><i class="fas fa-search mr-2"></i>Search</button>
                </div>
              </div>
              <div class="table-responsive" style="height: 500px; overflow: auto; display:inline-block;">
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