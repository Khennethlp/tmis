<?php include '../includes/header.php'; ?>
<section>
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-md-12 col-sm-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-4">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4 mt-2">Sign up</p>

                <form class="mx-1 mx-md-4">

                  <div class="mb-4">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-user fa-lg me-3 fa-fw"></i></span>
                      <input type="text" class="form-control" placeholder="Your Name" />
                    </div>
                  </div>

                  <!-- <div class="mb-4">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-envelope fa-lg me-3 fa-fw"></i></span>
                      <input type="email" class="form-control" placeholder="Your Email" />
                    </div>
                  </div> -->

                  <div class="mb-4">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-lock fa-lg me-3 fa-fw"></i></span>
                      <input type="password" class="form-control" placeholder="Password" />
                    </div>
                  </div>

                  <div class="mb-4">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-key fa-lg me-3 fa-fw"></i></span>
                      <input type="password" class="form-control" placeholder="Repeat your password" />
                    </div>
                  </div>

                  <div class="text-center mb-3 mb-lg-4">
                    <button type="button" class="btn btn-success btn-md btn-block">Register</button>
                    <button type="button" class="btn btn-outline-muted btn-md btn-block" onclick="history.back();">Back</button>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php include '../includes/footer.php'; ?>