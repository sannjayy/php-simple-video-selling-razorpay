<?php
require "inc/main_init.php";
$video = find("first", VIDEOS, $value='*', "where `id` = :id", array(':id' => 1)); 
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
				  <source src="media/<?=$video['trailer_video']?>" type="video/mp4">
				  <!-- <source src="MY_VIDEO.webm" type="video/webm" /> -->
				  Your browser does not support the video player try with another device.
				</video>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col-md-12 d-flex align-items-center justify-content-center">
					<hr />
					<a href="payment"><button type="button" class="btn btn-danger">Make Payment for Full Video</button></a>
					<hr />
				</div>
			</div>

		</div>
	</main>

	<footer class="footer mt-auto py-3 bg-light fixed-bottom">
		<?php include 'component/footer.php'; ?>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>