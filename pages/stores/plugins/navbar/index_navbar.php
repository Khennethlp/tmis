<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-dark  text-light border-bottom-0">
  <a href="" class="navbar-brand ml-2">
    <img src="../../dist/img/warehouse.png" alt="Web Template Logo" class="brand-image elevation-3 bg-light p-1 rounded" style="opacity: .8">
    <span class="brand-text font-weight-light text-light"><b>TMIS</b></span>
  </a>

  <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse order-3" id="navbarCollapse">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <!-- <li class="nav-item">
        <a href="" class="nav-link active"><i class="fas fa-home"></i> Homepage</a>
      </li> -->
      <li class="nav-item">
        <?php if ($_SERVER['REQUEST_URI'] == "/tmis/pages/stores/index.php") { ?>
          <a href="index.php" class="nav-link nav-active">
          <?php } else { ?>
            <a href="index.php" class="nav-link">
            <?php } ?>
            <i class="nav-icon fas fa-download text-success"></i>
            Store-in
            </a>
      </li>
      <li class="nav-item">
        <?php if ($_SERVER['REQUEST_URI'] == "/tmis/pages/stores/store_out.php") { ?>
          <a href="store_out.php" class="nav-link nav-active">
          <?php } else { ?>
            <a href="store_out.php" class="nav-link">
            <?php } ?>
            <i class="nav-icon fas fa-upload text-danger"></i>
            Store-out
            </a>
      </li>
      <li class="nav-item">
        <?php if ($_SERVER['REQUEST_URI'] == "/tmis/pages/stores/inventory.php") { ?>
          <a href="inventory.php" class="nav-link nav-active">
          <?php } else { ?>
            <a href="inventory.php" class="nav-link">
            <?php } ?>
            <i class="nav-icon fas fa-file-alt text-info"></i>
            Inventory
            </a>
      </li>

      <!-- <li class="nav-item">
        <a href="#" class="nav-link"><i class="fas fa-upload"></i> Store-out</a>
      </li> -->
      <li class="nav-item">
        <!-- <a href="/k_temp/" class="nav-link"><i class="fas fa-sign-in-alt"></i> Login</a> -->
      </li>
      <li class="nav-item">
        <!-- <a href="/k_temp/" class="nav-link"><i class="fas fa-sign-out-alt"></i>  </a> -->
        <?php include 'logout.php'; ?>
      </li>
    </ul>
  </div>

  <!-- Right navbar links -->
  <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
    <li class="nav-item">
      <a class="nav-link">
        <i class="fas fa-user-circle mr-1"></i>
        <?php echo strtoupper(isset($_SESSION['username']) ? $_SESSION['username'] : 'No User'); ?>
      </a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li> -->
  </ul>
</nav>
<!-- /.navbar -->