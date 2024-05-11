<div class="modal fade bd-example-modal-xl" id="update_inventory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #fff;">
        <h5 class="modal-title " id="exampleModalLabel">
          <b>History</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" id="id_history" name="id_history">
          <div class="col-sm-4">
            <span><b>Part Code:</b></span>
            <input type="text" id="partcode_update" class="form-control" style="height:35px; border: 1px solid black; font-size: 15px;" placeholder="" autocomplete="off">
          </div>
          <div class="col-sm-4">
            <span><b>Part Name:</b></span>
            <input type="text" id="partname_update" class="form-control" style="height:35px; border: 1px solid black; font-size: 15px;" placeholder="" autocomplete="off">
          </div>
          <div class="col-sm-4">
            <span><b>Packing Quantity</b></span>
            <input type="number" id="qty_update" class="form-control" style="height:35px; border: 1px solid black; font-size: 15px;" autocomplete="off">
          </div>
          <div class="col-sm-4">
            <span><b>Lot Address:</b></span>
            <input type="text" id="address_update" class="form-control" style="height:35px; border: 1px solid black; font-size: 15px;" autocomplete="off">
          </div>
          <div class="col-sm-4">
            <span><b>By:</b></span>
            <input type="text" id="by_update" class="form-control" style="height:35px; border: 1px solid black; font-size: 15px;" disabled autocomplete="off">
          </div>
        </div>
        <br>
      </div>
      <div class="modal-footer" style="background:#fff;">
        <div class="col-sm-3">
          <button class="btn btn-block" onclick="delete_history()" style="color:#111;height:34px;border-radius:.25rem;background: #DFE2E2;font-size:15px;font-weight:normal; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">Delete</button>
        </div>
        <div class="col-sm-3">
          <button class="btn btn-block" id="update_btn" onclick="history_update()" style="color:#fff;height:34px;border-radius:.25rem;background: #87A878;font-size:15px;font-weight:normal; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);">Update</button>
        </div>
      </div>
    </div>
  </div>
</div>