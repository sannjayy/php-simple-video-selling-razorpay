<?php 
require "inc/main_init.php";
if (!isset($_SESSION['logged']) && !isset($_SESSION['id']) && isset($_SESSION['login_type']) == 'admin') {
    echo "<script>window.location.href = '/';</script>";  

    
} else {
	$user = find("first", USERS, $value='*', "where `id` = :id", array(':id' => $_SESSION['id']));
	$video = find("first", VIDEOS, $value='*', "where `id` = :id", array(':id' => 1)); 
	if($user['is_admin'] != 1){
    	echo "<script>window.location.href = '/';</script>";
    }
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
					<h6 class="text-center">Video Update</h6>
					<hr />
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 d-flex align-items-center justify-content-center align-self-center">
					<form class="mt-3" method="post" enctype="multipart/form-data">
						<div class="mb-3">
							<label class="form-label">Video Name <span style="color:red">*</span></label>
							<input type="text" class="form-control" id="name" name="name" value="<?=$video['video_name'];?>" minlength="3" placeholder="Video Name" required="">
						</div>
						<div class="mb-3">
							<label class="form-label">Price <span style="color:red">*</span></label>
							<input type="number" class="form-control" id="price" name="price" value="<?=$video['price'];?>" minlength="1" placeholder="INR" required="">
						</div>
						<div class="mb-3">
							<label class="form-label">Thumbnail <span style="color:red">*</span></label>
							<input type="file" class="form-control" id="thumbnail" name="thumbnail" accept=".png, .jpg, .jpeg, .gif" value="<?=$video['thumbnail'];?>">
						</div>
						<div class="mb-3">
							<label class="form-label">Trailer Video <span style="color:red">*</span></label>
							<input type="file" class="form-control" id="trailer_video" name="trailer_video" value="<?=$video['trailer_video'];?>" accept=".mp4, .avi, .ogg, .webm">
						</div>
						<div class="mb-3">
							<label class="form-label">Full Video <span style="color:red">*</span></label>
							<input type="file" class="form-control" id="video_file" name="video_file" value="<?=$video['video_file'];?>" accept=".mp4, .avi, .ogg, .webm">
						</div>
						<button type="submit" class="btn btn-danger btn-block" name="update_video">Update Video</button>
					
					</form>
					<?php
						if (isset($_POST['update_video'])) {
							$thumbnail = false;
							$trailer_video = false;
							$video_file = false;

							$user_path = "media/";

							if(isset($_FILES['thumbnail']['tmp_name']) && is_uploaded_file($_FILES['thumbnail']['tmp_name'])) {
									if(file_exists($user_path.$video['thumbnail'])) {
										unlink($user_path.$video['thumbnail']);
									} 
								    if(checkImageValid($_FILES['thumbnail']['name'])==true)
								    {
								      $path_hs=rand().$_FILES['thumbnail']['name'];
								      // $path_hs = $_FILES['thumbnail']['name'];
								      $ext = pathinfo($path_hs, PATHINFO_EXTENSION);
								      $thumbnail_fileName=$video['video_name']."-thumbnail)-".rand().'.'.$ext;
								      $path = $user_path.$thumbnail_fileName;								      
								      move_uploaded_file($_FILES['thumbnail']['tmp_name'], $user_path.$thumbnail_fileName);
								      $thumbnail = true;
								    }
								}

							if(isset($_FILES['trailer_video']['tmp_name']) && is_uploaded_file($_FILES['trailer_video']['tmp_name'])) {
									if(file_exists($user_path.$video['trailer_video'])) {
										unlink($user_path.$video['trailer_video']);
									} 
								    if(checkVideoValid($_FILES['trailer_video']['name'])==true)
								    {
								      $path_hs=rand().$_FILES['trailer_video']['name'];
								      // $path_hs = $_FILES['trailer_video']['name'];
								      $ext = pathinfo($path_hs, PATHINFO_EXTENSION);
								      $trailer_video_fileName=$video['video_name']."-trailer_video)-".rand().'.'.$ext;
								      $path = $user_path.$trailer_video_fileName;								      
								      move_uploaded_file($_FILES['trailer_video']['tmp_name'], $user_path.$trailer_video_fileName);
								      $trailer_video = true;
								    }
								}

							if(isset($_FILES['video_file']['tmp_name']) && is_uploaded_file($_FILES['video_file']['tmp_name'])) {
									if(file_exists($user_path.$video['video_file'])) {
										unlink($user_path.$video['video_file']);
									} 
								    if(checkVideoValid($_FILES['video_file']['name'])==true)
								    {
								      $path_hs=rand().$_FILES['video_file']['name'];
								      // $path_hs = $_FILES['video_file']['name'];
								      $ext = pathinfo($path_hs, PATHINFO_EXTENSION);
								      $video_file_fileName=$video['video_name']."-video_file)-".rand().'.'.$ext;
								      $path = $user_path.$video_file_fileName;								      
								      move_uploaded_file($_FILES['video_file']['tmp_name'], $user_path.$video_file_fileName);
								      $video_file = true;
								    }
								}


							$set_value = "`video_name` = :video_name, `price` = :price, `thumbnail` = :thumbnail, `trailer_video` = :trailer_video,  `video_file` = :video_file";
							$execute=array(
			                    ":video_name" => trim($_POST['name']),
			                    ":price" => trim($_POST['price']),
			                    ":thumbnail" =>  ($thumbnail_fileName)? $thumbnail_fileName : $video['thumbnail'],
			                    ":trailer_video" => ($trailer_video_fileName)? $trailer_video_fileName : $video['trailer_video'],
			                    ":video_file" => ($video_file_fileName)? $video_file_fileName : $video['video_file'],
			                    ":update_id" => 1
			                );
			                				
							
							// echo "success";
							if (update(VIDEOS, $set_value, "where `id` = :update_id", $execute)){

								show_success_redirect('Update successful. Please Wait...','admin', 1500);

							} else {	
								// echo "failed";
								show_error('There is something wrong');
							}
							
						}
					?>
				</div>
			</div>


		</div>
	</main>

	<footer class="footer mt-auto py-3 bg-light">
	  <?php include 'component/footer.php'; ?>
	</footer>


</body>
</html>