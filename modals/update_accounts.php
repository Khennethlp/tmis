<div class="modal fade bd-example-modal-xl" id="update_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #fff;">
        <h5 class="modal-title " id="exampleModalLabel">
          <b>Add Masterlist</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" id="id_acc" name="id_acc">
          <div class="col-sm-4">
            <span><b>EmployeeID:</b></span>
            <input type="text" id="empId_edit" class="form-control" style="height:35px; border: 1px solid black; font-size: 15px;" placeholder="" autocomplete="off">
          </div>
          <div class="col-sm-4">
            <span><b>Full Name:</b></span>
            <input type="text" id="fullname_edit" class="form-control" style="height:35px; border: 1px solid black; font-size: 15px;" placeholder="" autocomplete="off">
          </div>
          <div class="col-sm-4">
            <span><b>Username</b></span>
            <input type="text" id="username_edit" class="form-control" style="height:35px; border: 1px solid black; font-size: 15px;" autocomplete="off">
          </div>
          <div class="col-sm-4">
            <span><b>Password</b></span>
            <input type="text" id="password_edit" class="form-control" style="height:35px; border: 1px solid black; font-size: 15px;" autocomplete="off">
          </div>
          <div class="col-md-4">
            <label>Section:</label>
            <input type="text" name="section_edit" id="section_edit" class="form-control" list="section_list">
            <datalist id="section_list"></datalist>

          </div>
          <div class="col-md-4">
            <label>User Type:</label>
            <select id="user_type_edit" class="form-control">
              <option value="">Select User Type</option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>
        </div>
        <br>
      </div>
      <div class="modal-footer" style="background:#fff;">
        <div class="col-sm-3">
          <button class="btn btn-block" onclick="" style="color:#111;height:34px;border-radius:.25rem;background: #DFE2E2;font-size:15px;font-weight:normal; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">Delete </button>
        </div>
        <div class="col-sm-3">
          <button class="btn subBtn btn-block" id="update_btn" onclick="" style="color:#fff;height:34px;border-radius:.25rem;background: #000EA4;font-size:15px;font-weight:normal; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);">Update </button>
        </div>
      </div>
    </div>
  </div>
</div>