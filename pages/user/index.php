<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/user_bar.php';?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <!-- Alert -->
   
      <!-- end of alert -->
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tube Making Inventory</h1>
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
          <!-- STORE IN -->
          <div class="card card-gray-dark card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-download"></i>&nbsp; Store-in</h3>
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
             <!-- <h6>content here...</h6> -->
             <div class="row">
              <div class="col-12">
                
              <div class="card">
              <div class="card-header">
                  <!-- <h3 class="card-title">List of Store-in</h3> -->
                  <div class="row align-items-center">
                      <div class="col-sm-3">
                          <input type="text" name="" class="form-control" id="">
                      </div>
                      <div class="col-sm">
                          <div class="input-group input-group-sm ">
                              <button id="search_store_in" class="btn btn-info mr-2"><i class="fas fa-search pr-2"></i> Search</button>
                              <button id="export_store_in" class="btn btn-success mr-2"><i class="fas fa-file-excel pr-2 "></i> Export</button>
                              <button id="export_store_in" class="btn btn-danger mr-2"><i class="fas fa-plus pr-2"></i> Add item</button>
                          </div>
                      </div>
                  </div>
                  </div>
              </div>
                <div class="card-body table-responsive p-0" style="height: 400px;">
                  <table class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Parts Code</th>
                        <th>Lot No.</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>01PFP</td>
                        <td>LPC-01240424-04046</td>
                        <td>500</td>
                        <td><span class="badge badge-success">Store in</span></td>
                        <td>2024/04/24</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>01PFQ</td>
                        <td>LPC-01240424-06001</td>
                        <td>500</td>
                        <td><span class="badge badge-success">Store in</span></td>
                        <td>2024/04/24</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>01PFH</td>
                        <td>LPC-01240424-03058</td>
                        <td>500</td>
                        <td><span class="badge badge-success">Store in</span></td>
                        <td>2024/04/24</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>02KXU</td>
                        <td>LPC-01240424-07001</td>
                        <td>500</td>
                        <td><span class="badge badge-success">Store in</span></td>
                        <td>2024/04/24</td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>02KXV</td>
                        <td>LPC-01240424-08001</td>
                        <td>500</td>
                        <td><span class="badge badge-success">Store in</span></td>
                        <td>2024/04/24</td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>02XYZ</td>
                        <td>LPC-01240424-05001</td>
                        <td>500</td>
                        <td><span class="badge badge-success">Store in</span></td>
                        <td>2024/04/24</td>
                      </tr>
                      <tr>
                        <td>7</td>
                        <td>03ABC</td>
                        <td>LPC-01240424-09103</td>
                        <td>500</td>
                        <td><span class="badge badge-success">Store in</span></td>
                        <td>2024/04/24</td>
                      </tr>
                      <tr>
                        <td>8</td>
                        <td>03LMO</td>
                        <td>LPC-01240424-01065</td>
                        <td>500</td>
                        <td><span class="badge badge-success">Store in</span></td>
                        <td>2024/04/24</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
              <hr>
              <div class="row">
                <!-- <h6>another content here...</h6> -->
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card end-->

        
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
  </section>
</div>

<?php include 'plugins/footer.php';?>
<?php //include 'plugins/js/pagination_script.php';?>