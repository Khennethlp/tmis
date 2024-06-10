<footer class="main-footer text-sm">
  Developed by: Khennethlp
  <div class="float-right d-none d-sm-inline-block">
    <strong>Copyright &copy;
      <script>
        var currentYear = new Date().getFullYear();
        if (currentYear !== 2024) {
          document.write("2024 - " + currentYear);
        } else {
          document.write(currentYear);
        };
      </script>.
    </strong>
    All rights reserved.
    <a href="#" class="text-secondary" data-target="#info" data-toggle="modal" title="PC INFO">
      <i class="fas fa-laptop ml-3 pe-auto"></i>
    </a>
  </div>
</footer>
<?php
//MODALS
include '../../modals/logout_modal.php';
include '../../modals/info.php';

include '../../modals/history_modal.php';
include '../../modals/view_accounts.php';

include '../../modals/add_mlist.php';
include '../../modals/add_account.php';

include '../../modals/update_mlist.php';
include '../../modals/update_history.php';
include '../../modals/update_accounts.php';
// include '../../modals/update_inventory.php';

include '../../modals/import_account.php';
include '../../modals/import_mlist.php';
include '../../modals/import_inventory.php';

?>
<!-- jQuery -->
<script src="../../plugins/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- SweetAlert2 -->
<script type="text/javascript" src="../../plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/popup_center.js"></script>
<script src="plugins/js/custom.js"></script>

</body>

</html>