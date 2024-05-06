
<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/admin_bar.php';?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Inventory</h1>
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
          <div class="card card-danger card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-file-alt"></i> Inventory Table</h3>
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
                <form id="file_form" enctype="multipart/form-data">
                <a href="" class="btn btn-warning mx-2 mb-2" title="Import to Table" data-toggle="modal" data-target="#import_mlist" style="width: 100px;"><i class="fas fa-file-import mr-2"></i>Import</a>
                <!-- <label for="" style="color: #ADACB5; font-size: 14px;">Import</label> -->
              </form>
                <a href="" class="btn btn-success mx-2 mb-2" title="Export Table" onclick="export_csv('mlist_table')" style="width: 100px;"><i class="fas fa-file-csv mr-2"></i>Export</a>
                <!-- <label for="" style="color: #ADACB5; font-size: 14px;">Export</label> -->
                <a href="" class="btn btn-info mx-2 mb-2" title="Print Table" onclick="print()" style="width: 100px;"><i class="fas fa-print mr-2"></i>print</a>
                <!-- <label for="" style="color: #ADACB5; ">Print</label> -->
                
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <label for="">&nbsp;</label>
                    <button class="btn btn-danger" id="deleteBtn" onclick="delete_data_arr()" style="height: 60px; margin-right: 25px; font-size: 13px;"><i class="fas fa-trash"></i></button>
                  
                    <div class="col-sm-3 mb-2">
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
                  <input type="date" id="mlist_search" class="form-control" placeholder="Search here..." autocomplete="off">
                </div>
                <div class="col-sm-2">
                  <label>To Date:</label>
                  <input type="date" id="mlist_search" class="form-control" placeholder="Search here..." autocomplete="off">
                </div>
                  </div>
              
                <div class="card-body table-responsive p-0" style="height: 350px;">
                  <table class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th><input type="checkbox" name="" id="select_all" onclick="selectAll()" value="" style="cursor:pointer;"> (Select All)</th>
                        <th>#</th>
                        <th>Part Code</th>
                        <th>Part Name</th>
                        <th>Packing Qty</th>
                        <th>Stock Address</th>
                        <th>Barcode Label</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <!-- <th>Added By</th> -->
                      </tr>
                    </thead>
                    <tbody id="inventory_table"></tbody>
                      <!-- <tr>
                        <td colspan="5">COMING SOON!</td>
                      </tr> -->
                    
                  </table>
                </div>
              </div>
            </div>
          </div>
            <hr>
              <div class="row">
                <p>Total: <span id="count"></span></p>
                <!-- <h5>another content here...</h5> -->
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
<?php include 'plugins/js/inventory_script.php';?>