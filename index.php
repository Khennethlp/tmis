<?php require 'process/login.php';

if (isset($_SESSION['username'])) {
  if ($_SESSION['role'] == 'admin') {
     header('location: pages/admin/index.php');
     exit;
 }elseif($_SESSION['role'] == 'user'){
     header('location: pages/user/index.php');
     exit;
 }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TMS INVENTORY</title>

  <link rel="icon" href="dist/img/logo.ico" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="dist/css/font.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="col-md-12">
      <?php if(isset($_SESSION['status']) && $_SESSION['status'] == 'error') { ?>
        <div class="alert alert-dismissible fade show" style="background-color: #C3423F; color: #fff; " role="alert">
          <strong>Oops!</strong> <?php echo $_SESSION['msg']; ?>
          <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <?php }  unset($_SESSION['status']); ?>
    </div>
    <div class="login-logo">
      <!-- <img src="dist/img/warehouse.png" style="height:25vh; width: 25vw;"> -->
      <h2><b>TUBE MAKING INVENTORY SYSTEM</b></h2>
    </div>
    <!-- /.login-logo -->
    <div class="card rounded">
      <div class="card-body login-card-body ">
        <p class="login-box-msg"><b>Sign in to start your session</b></p>

        <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="login_form">
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" autofocus required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col">
              <button type="submit" class="btn btn-block" name="Login" style="background-color: #306BAC; color: #fff;" value="login">Login</button>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col">
              <!-- <button type="button" href="#" target="_blank" class="btn bg-danger btn-block" id="wi">Work Instruction</button> -->
            </div>
          </div>
          <div class="row">
            <div class="col">
              <center>
                <a href="pages/viewer/">Go Back to Home Page</a>
              </center>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

<!-- jQuery -->
<script src="plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<noscript>
    <br>
    <span>We are facing <strong>Script</strong> issues. Kindly enable <strong>JavaScript</strong>!!!</span>
    <br>
    <span>Call IT Personnel Immediately!!! They will fix it right away.</span>
</noscript>

</body>
</html>
