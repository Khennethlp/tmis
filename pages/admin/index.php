<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/admin_bar.php';?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1 class="m-0">TMS INVENTORY</h1> -->
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
          <div class="card card-danger card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-download"></i> Store-in</h3>
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
              <div class="col-md-12 mb-3">
                <!-- <form id="MyForm" action="../../process/admin/store_in_out_p.php" method="post"> -->
                <div class="row">
                  <!-- <div class="col-md-4">
                    <label for="kanban_partnames">Parts Name:</label>
                    <input list="m_kanban" class="form-control" name="" id="kanban_partnames" placeholder="Select here..." autofocus required>
                    <datalist id="m_kanban"></datalist>
                  </div> -->
                  <div class="col-md-6">
                    <label for="">Scan Address:</label>
                    <input type="text" class="form-control" name="" id="store_in_address" placeholder="Scan stock address..." autofocus>
                  </div>
                  <div class="col-md-6">
                    <label for="store_in_qr">Scan QR:</label>
                    <input type="password" class="form-control" name="" id="store_in_qr" placeholder="QR Here..." onchange="insert_partsin()" oninput="trim_white_space(event);"  autocomplete="off">
                    <!-- <input type="submit" value="Submit" class="form-control" name="submit_qr" id="submit_qr" style="display: none;"> -->
                    <!-- <button id="submit_qr" style="display: none;"></button> -->
                    </div>
                </div>
                <!-- </form> -->
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Part Code</th>
                        <th>Part Name</th>
                        <th>Packing Qty</th>
                        <th>Stock Address</th>
                        <th>Barcode Label</th>
                        <th>Date</th>
                        <th>Added By</th>
                      </tr>
                    </thead>
                    <tbody id="partsin_table"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <hr>
        
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
<?php include 'plugins/js/partsin_script.php';?>