<?php
require "inc/main_init.php";
$video = find("first", VIDEOS, $value='*', "where `id` = :id", array(':id' => 1)); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'component/head_tags.php'; ?>	
	<link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />

	<style>
		#modal {
		background: #424242;
		width: 640px;
		height: 264px;
		font-family: open sans-serif;
		opacity: 0.97;
		}

		#message {
		font-size: 2.5em;
		float: left;
		padding: 6%;
		text-align: center;
		color: #c3c3c3;
		}

		#button1 {
		display: inline-block;
		font-size: 1.5em;
		margin: 0% 0% 0% 21%;
		padding: 2% 4% 2% 4%;
		background: #0e61bd;
		color: white;
		border: none;
		}

		#button2 {
		display: inline-block;
		font-size: 1.5em;
		margin: 0% 0% 0% 5%;
		padding: 2% 4% 2% 4%;
		background: #02ac90;
		color: white;
		border: none;
		}

		#replay-video {
		font-size: 1.5em;
		text-align: center;
		margin: 5%;
		color: white;
		}
	</style>
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

			<!-- <div class="row">
				<div class="col-md-12 d-flex align-items-center justify-content-center align-self-center">
				<video width="100%" height="370" controls preload="auto"
				poster="media/<?=$video['thumbnail'];?>">
				  <source src="media/<?=$video['trailer_video']?>" type="video/mp4">
				  <source src="MY_VIDEO.webm" type="video/webm" />
				  Your browser does not support the video player try with another device.
				</video>
				</div>
			</div> -->


			<div class="row">
				<div class="col-md-12 d-flex align-items-center justify-content-center align-self-center mt-5">
					<video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="none" width="640" height="264"
						poster="media/<?=$video['thumbnail'];?>"
						data-setup="{}">
						<source src="media/<?=$video['trailer_video']?>" type='video/mp4' />
						<!-- <source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' /> -->
						<!-- <source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' /> -->
						<!-- <track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track> -->
						<!-- <track kind="subtitles" src="demo.captions.vtt" srclang="en" label="English"></track> -->
						<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
					</video>
					
				</div>
			</div>

			<!-- <div class="row mt-5">
				<div class="col-md-12 d-flex align-items-center justify-content-center">
					<hr />
					<a href="payment"><button type="button" class="btn btn-danger">Make Payment for Full Video</button></a>
					<hr />
				</div>
			</div> -->

		</div>
	</main>

	<footer class="footer mt-auto py-3 bg-light fixed-bottom">
		<?php include 'component/footer.php'; ?>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>

	<script type="text/javascript">
	const func = (a) => {
		$(`#${a}`).bind('ended',function() {
			$(`#${a}`).append(
				'<div id="modal" class="video-js">' +
				'<div id="message">Want to watch full video? </div>' +
				'<a href="#" target="_blank"><button type="button" id="button1">Purchase Now @ ₹12</button></a>' +
				'<a href="#" target="_blank"><button type="button" id="button2">Another Button</button></a>' +
				'<a href="#"><div id="replay-video"><u>Replay Video</u></div></a>' +
				'</div>'
				);

			$('#replay-video').click(function() {
				$('#modal').remove();
				vjs("example_video_1").play();
			});
		});
	}
	func('example_video_1')
	</script>
</body>
</html>