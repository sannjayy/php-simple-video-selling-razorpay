<?php
require "inc/main_init.php";
// Full Site User Information from Here
if (isset($_SESSION['logged']) && isset($_SESSION['id'])) {
    $user = find("first", USERS, $value='*', "where `id` = :id", array(':id' => $_SESSION['id'])); 

    if($user['is_paid'] != 1){
    	echo "<script>window.location.href = 'payment';</script>";
    }
    $video = find("first", VIDEOS, $value='*', "where `id` = :id", array(':id' => 1));
} 
else
{
	echo "<script>window.location.href = 'login';</script>";
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
					<h6 class="text-center">Video That Can Change Your Life </h6>
					<hr />
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 d-flex align-items-center justify-content-center align-self-center">
				<video width="100%" height="370" controls preload="auto"
				poster="media/<?=$video['thumbnail'];?>">
				  <source src="media/<?=$video['video_file']?>" type="video/mp4">
				  <!-- <source src="MY_VIDEO.webm" type="video/webm" /> -->
				  Your browser does not support the video player try with another device.
				</video>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col-md-12 d-flex align-items-center justify-content-center">
					<hr />
					<h6 class="text-center" style="color:wheat;">Dear <?=$user['name']?>, Thank you for your purchase.</h6>
					<hr />
				</div>
			</div>

		</div>
	</main>

	<footer class="footer mt-auto py-3 bg-light fixed-bottom">
	  <?php include 'component/footer.php'; ?>
	</footer>
</body>
</html>