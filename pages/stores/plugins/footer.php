  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">

      <b>Version</b> 1.0.0
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <script>
        var currentYear = new Date().getFullYear();
        if (currentYear === 2024) {
          document.write(currentYear);
        } else {
          document.write("2024 - " + currentYear);
        };
      </script>.
      Khennethlp.</strong>
    All rights reserved.
  </footer>
  <?php
  include '../../modals/logout_modal.php';
  include '../../modals/timeout.php';
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
  <script src="../../dist/js/session.js"></script>
  </div>
  <!-- ./wrapper -->