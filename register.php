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
					<h6 class="text-center">Register</h6>
					<hr />
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 d-flex align-items-center justify-content-center align-self-center">
					<form class="mt-3" method="post">
						<div class="mb-3">
							<label class="form-label">Full name <span style="color:red">*</span></label>
							<input type="text" class="form-control" id="name" name="name" minlength="3" placeholder="Your full name" required="">
						</div>
						<div class="mb-3">
							<label class="form-label">Email address <span style="color:red">*</span></label>
							<input type="email" class="form-control" id="email" name="email" minlength="3" placeholder="name@example.com" required="">
						</div>
						<div class="mb-3">
							<label class="form-label">Mobile number <span style="color:red">*</span></label>
							<input type="text" class="form-control" id="mobile" name="mobile" placeholder="10 digit mobile number" maxlength="10" required="">
						</div>
						<div class="mb-3">
							<label class="form-label">Password <span style="color:red">*</span></label>
							<input type="password" class="form-control" id="password" name="password" minlength="4" placeholder="******" required="">
						</div>
						<button type="submit" class="btn btn-danger btn-block" name="register">Register Now</button>
						<div class="card-footer">
							<div class="d-flex justify-content-center links mt-3">
								Already have an account?  &nbsp <a href="login">Login</a>
							</div>
							<!-- <div class="d-flex justify-content-center">
								<a href="#">Forgot your password?</a>
							</div> -->
						</div>
					</form>
					<?php
						if (isset($_POST['register'])) {
							$fields="`name`, `email`, `mobile`, `password`";
							$values=":name, :email, :mobile, :password";
							$execute=array(
								':name'=>trim($_POST['name']),		
								':email'=> trim($_POST['email']),		
								':mobile'=> trim($_POST['mobile']),											
								':password'=>md5(trim($_POST['password'])),		
							);					
							if (!empty($_POST['email']) && !empty($_POST['password'])) {

								$user = save(USERS, $fields, $values, $execute); # Save User to Database

								// echo "success";
								if (save(USERS, $fields, $values, $execute)){
									show_success_redirect('Registration successful. Please Wait...','login?account='.$_POST['name'].'', 1500);

								} else {	
									// echo "failed";
									show_error('An account with this email already exists! Please contact with support team.');
								}
							}
							else
							{	
								// echo "failed";
								show_error('There is something wrong! Please contact with support team.');
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