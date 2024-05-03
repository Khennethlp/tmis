<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="../../dist/img/warehouse.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">TMS INVENTORY</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../../dist/img/user.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="index.php" class="d-block"><?=htmlspecialchars($_SESSION['name']);?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <?php if ($_SERVER['REQUEST_URI'] == "/tms/pages/admin/index.php") {?>
          <a href="index.php" class="nav-link active">
          <?php } else {?>
          <a href="index.php" class="nav-link">
          <?php } ?>
            <i class="nav-icon fas fa-download"></i>
            <p>
              Store-in
            </p>
          </a>
        </li>
        <li class="nav-item">
          <?php if ($_SERVER['REQUEST_URI'] == "/tms/pages/admin/index2.php") {?>
          <a href="index2.php" class="nav-link active">
          <?php } else {?>
          <a href="index2.php" class="nav-link">
          <?php } ?>
            <i class="nav-icon fas fa-upload"></i>
            <p>
              Store-out
            </p>
          </a>
        </li>
        <li class="nav-item">
          <?php if ($_SERVER['REQUEST_URI'] == "/tms/pages/admin/inventory.php") {?>
          <a href="inventory.php" class="nav-link active">
          <?php } else {?>
          <a href="inventory.php" class="nav-link">
          <?php } ?>
            <i class="nav-icon fas fa-list"></i>
            <p>
              Inventory
            </p>
          </a>
        </li>
        <li class="nav-item">
          <?php if ($_SERVER['REQUEST_URI'] == "/tms/pages/admin/masterlist.php") {?>
          <a href="masterlist.php" class="nav-link active">
          <?php } else {?>
          <a href="masterlist.php" class="nav-link">
          <?php } ?>
            <i class="nav-icon fas fa-users"></i>
            <p>
              Masterlist
            </p>
          </a>
        </li>
        <li class="nav-item">
          <?php if ($_SERVER['REQUEST_URI'] == "/tms/pages/admin/accounts.php") {?>
          <a href="accounts.php" class="nav-link active">
          <?php } else {?>
          <a href="accounts.php" class="nav-link">
          <?php } ?>
            <i class="nav-icon fas fa-user-cog"></i>
            <p>
              Accounts Management
            </p>
          </a>
        </li>
        <?php include 'logout.php';?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
    <!-- <p class="text-muted text-center" style="font-size: 11px;">Beta Version 1.0</p> -->
  </div>
  <div class="sidebar-bottom">
    <p class="text-muted text-center" style="font-size: 11px; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);">Beta Version 1.0</p>
  </div>
  <!-- /.sidebar -->
</aside>
