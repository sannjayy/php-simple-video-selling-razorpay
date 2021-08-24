<?php
require "inc/main_init.php";
if (isset($_SESSION['logged']) && isset($_SESSION['id'])) {
    echo "<script>window.location.href = '/';</script>";  
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'component/head_tags.php'; ?>	
</head>
<body>
	<header>
		<?php include 'component/navbar.php'; ?>
	</header>

	<main class="flex-shrink-0">
		<div class="container-fluid">
			<div class="row top_row">
				<div class="col-md-12">
					<hr />
					<h6 class="text-center">Login</h6>
					<hr />
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 d-flex align-items-center justify-content-center align-self-center">
					<form class="mt-5" method="post">
						<div class="mb-3">
							<label class="form-label">Email address</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required="">
						</div>
						<div class="mb-3">
							<label class="form-label">Password</label>
							<input type="password" class="form-control" id="password" name="password" minlength="4" placeholder="******" required="">
						</div>
						<button type="submit" class="btn btn-danger btn-block" name="login">Login</button>
						<div class="card-footer">
							<div class="d-flex justify-content-center links mt-3">
								Don't have an account?  &nbsp <a href="register">Sign Up</a>
							</div>
							<!-- <div class="d-flex justify-content-center">
								<a href="#">Forgot your password?</a>
							</div> -->
						</div>
					</form>

					<?php
					if (isset($_REQUEST['login'])) {
						$username = trim($_POST['email']);
						$p = trim($_POST['password']);
						$password = md5(utf8_encode($p));

						if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
							$where = "where `email` = :username && `password` = :password";
							$login_data = find("first", USERS, $value='`id`, `email`, `status`, `is_admin`', $where, array(':username' => $username, ':password' => $password));

							if($login_data){
								if ($login_data['is_admin'] == 1) {	
									// ADMIN LOGIN

										$_SESSION['logged'] = $login_data['email'];
										$_SESSION['id'] = $login_data['id'];
										$_SESSION['login_type'] = 'admin';									
										show_success_redirect('Login Success! Please Wait ...', 'admin?user='.$login_data['name'], 1500);
									}

								else if ($login_data['status'] == 1) {	
									// RETURNING USER

										$_SESSION['logged'] = $login_data['email'];
										$_SESSION['id'] = $login_data['id'];
										$_SESSION['login_type'] = 'user';									
										show_success_redirect('Login Success! Please Wait ...', 'view', 1500);
									} else {
									// NEW USER

										$_SESSION['logged'] = $login_data['email'];
										$_SESSION['id'] = $login_data['id'];
										$_SESSION['login_type'] = 'user';
										show_success_redirect('Login Success! Please Wait ...', 'payment', 1500);
									}

							} else {
								show_error('Invalid Email or Password. Please contact to our customer care.', 'Oh noes…','Try Again' );
							}
						}
					}
					?>
				</div>
			</div>
		</div>
	</main>

	<footer class="footer mt-auto py-3 bg-light fixed-bottom">
	  <?php include 'component/footer.php'; ?>
	</footer>
</body>
</html>