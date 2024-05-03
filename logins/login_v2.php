<?php include '../includes/header.php'; ?>

<div class="">
	<div class="container d-flex justify-content-center">
		<div class="row">
			<div class="card">
				<div class="card-header">
					<strong>Login</strong>
				</div>
				<div class="card-body">
					<form name="login" id="login">
						<div class="row">
							<div class="col">
								<span class="profile-img">
									<i class='fas fa-user-circle' style='font-size:120px'></i>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<hr> <!-- other content  -->
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">
												<i class='fas fa-user-shield'></i>
											</span>
										</div>
										<input class="form-control" placeholder="Email" id="loginEmail" name="loginEmail" type="email" autofocus>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">
												<i class='fas fa-user-secret'></i>
											</span>
										</div>
										<input class="form-control" placeholder="Password" id="loginPassword" name="loginPassword" type="password">
									</div>
								</div>
								<div class="form-group">
									<input type="button" class="btn btn-sm btn-success btn-block submit" id="login_m"  value="Sign in" >
									<!-- <input type="button" class="btn btn-sm btn-block submit" id="login_m" onclick="history.back();" value="Back" > -->
                                    <a href="reg_v2.php" class="btn btn-sm btn-block submit"><u>Click to Register.</u></a>
								</div>
							</div>
						</div>
					<!-- <a href="#" onClick="">I forgot my password!</a> -->
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include '../includes/footer.php'; ?>

