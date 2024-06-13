<div class="modal fade bd-example-modal-xl" id="add_mlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title " id="exampleModalLabel">
          <b>Add Masterlist</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-4">
            <span><b>Part Code:</b></span>
            <input type="text" id="partcode" class="form-control" style="height:35px; border: 1px solid black; font-size: 15px;" placeholder="" autocomplete="off">
          </div>
          <div class="col-sm-4">
            <span><b>Part Name:</b></span>
            <!-- <input type="text" id="partname" class="form-control" style="height:35px; border: 1px solid black; font-size: 15px;" placeholder="" autocomplete="off"> -->
            <input type="text" list="mlist_list" id="partname" class="form-control" placeholder="Select mlist..." style="height:35px; border: 1px solid black; font-size: 15px;" autocomplete="off">
            <datalist id="mlist_list"></datalist>
            
          </div>
          <div class="col-sm-4">
            <span><b>Packing Quantity</b></span>
            <input type="number" id="qty" class="form-control" style="height:35px; border: 1px solid black; font-size: 15px;" autocomplete="off">
          </div>
        </div>
        <br>
      </div>
      <div class="modal-footer" >
        <div class="col-sm-3">
          <button class="btn btn-block" onclick="save_mlist()" style="background: #3765AA !important;color:#fff;height:34px;border-radius:.25rem;font-size:15px;font-weight:normal; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);">Add</button>
        </div>
        <div class="col-sm-3">
          <button class="btn btn-block Close" data-dismiss="modal" aria-label="Close" style="color: #fff;height:34px;border-radius:.25rem;font-size:15px;">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>