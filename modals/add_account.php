<div class="modal fade bd-example-modal-xl" id="add_acc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #fff;">
        <h5 class="modal-title " id="exampleModalLabel">
          <b>Add Account</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-4">
            <!-- <span><b>Employee ID:</b></span> -->
            <input type="text" id="add_emp_id" class="form-control" placeholder="Employee ID..." style="height:35px; border: 1px solid black; font-size: 15px;" autocomplete="off">
          </div>
          <div class="col-sm-4">
            <!-- <span><b>Full Name:</b></span> -->
            <input type="text" id="add_fullname" class="form-control" placeholder="Full Name..." style="height:35px; border: 1px solid black; font-size: 15px;" autocomplete="off">
          </div> 
          <div class="col-sm-4">
            <!-- <span><b>Username:</b></span> -->
            <input type="text" id="add_username" class="form-control" placeholder="Username..." style="height:35px; border: 1px solid black; font-size: 15px;" autocomplete="off">
          </div>
          <div class="col-sm-4 mt-2">
            <!-- <span><b>Password:</b></span> -->
            <input type="password" id="add_password" class="form-control" placeholder="Password..." style="height:35px; border: 1px solid black; font-size: 15px;" autocomplete="off">
          </div>
          <div class="col-sm-4 mt-2">
            <!-- <span><b>Password:</b></span> -->
            <input type="text" list="section_list" id="add_section" class="form-control" placeholder="Select Section..." style="height:35px; border: 1px solid black; font-size: 15px;" autocomplete="off">
            <datalist id="section_list ">
              <option value="IT"></option>
              <option value="QA"></option>
            </datalist>
          </div>
          <div class="col-sm-4 mt-2">
          <!-- <label>User Type:</label> -->
                <select id="add_user_type" class="form-control">
                <option value="" disabled selected>Select User Type</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
                </select>
          </div>
        </div>
        <br>
      </div>
      <div class="modal-footer" style="background:#fff;">
        <div class="col-sm-3">
          <button class="btn btn-block" onclick="add_account();" style="background: #87A878 !important;color:#fff;height:34px;border-radius:.25rem;font-size:15px;font-weight:normal; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);">Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>