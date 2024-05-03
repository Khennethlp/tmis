<div class="modal fade bd-example-modal-xl" id="view_accounts" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">
          <b>Manage Accounts</b>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body" id="accounts_view">
            <table class="table table-head-fixed text-nowrap table-hover" id="accounts_table">
                <thead style="text-align:center;">
                <th> # </th>
                <th> Full Name </th>
                <th> Username </th>
                <th> User Type </th>
                </thead>
                <tbody id="list_of_accounts" style="text-align:center;"></tbody>
            </table>
          
        </div>
        <div class="modal-footer">
          <button type="button" id="btnAddAccount" name="btn_add_account" class="btn btn-success">Add New Account</button>
        </div>
    </div>
  </div>
</div>