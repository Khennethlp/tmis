<div class="modal fade bd-example-modal-xl" id="history_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">
          <b>History</b>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="">
        <div class="col-md-12 mb-2">
          <div class="row">
            <label for="">To:</label>
            <div class="col-md-3 mb-2">
              <input type="date" class="form-control" placeholder="To Date" name="" id="">
            </div>
            <label for="">From:</label>
            <div class="col-md-3 mb-2">
              <input type="date" class="form-control" placeholder="From Date" name="" id="">
            </div>
            <div class="col-md-3 mb-2">
              <!-- <label for="">Search:</label> -->
              <input type="text" class="form-control" placeholder="Search..." name="" id="">
            </div>
            <div class="col-md-2">
              <input type="button" value="Search" class="form-control btn btn-outline-success " name="" id="" style="width:100px;">
            </div>
          </div>
        </div>
        <hr>
        <div class="col-md-12 mb-3">
          <div class="row">
            <!-- <div class="col-md-2"></div> -->
            <div class="col-md-2 ml-4">
              <a href="" class="btn btn-primary" style="width:100px;">Print</a>
            </div>

          </div>
        </div>
        <div class="table-responsive" style="height: 300px; overflow: auto; display:inline-block;">
          <table class="table table-head-fixed text-nowrap table-hover" id="">
            <thead style="text-align:center;">
              <th> # </th>
              <th> Part Code </th>
              <th> Part Name </th>
              <th> Packing Quantity </th>
              <th> Lot Address </th>
              <th> By </th>
            </thead>
            <tbody id="history_list" style="text-align:center;"></tbody>
          </table>

        </div>
      </div>
      <!-- <div class="modal-footer">
          <button type="button" id="btnAddAccount" name="btn_add_account" class="btn btn-success">Add New Account</button>
        </div> -->
    </div>
  </div>
</div>