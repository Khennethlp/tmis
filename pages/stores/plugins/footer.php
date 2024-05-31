  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <b>Version</b> 1.0.0
      <a href="#" class="text-secondary" data-target="#info" data-toggle="modal" title="Keyboard Shortcut">
      <i class="fas fa-keyboard ml-3 pe-auto"></i>
      </a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <script>   
        var currentYear = new Date().getFullYear();
        if (currentYear === 2024) {
          document.write(currentYear);
        } else {
          document.write("2024 - " + currentYear);
        };</script>. 
        Khennethlp.</strong>
    All rights reserved.
  </footer>
  <?php
  include '../../modals/logout_modal.php';
  include '../../modals/info.php';
  ?>
  <!-- qrcode reader script link -->
  <!-- <script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/@zxing/library@0.18.4"></script>
  
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
</div>
<!-- ./wrapper -->