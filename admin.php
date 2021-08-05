<?php
require "inc/main_init.php";
// Full Site User Information from Here
if (isset($_SESSION['logged']) && isset($_SESSION['id']) && isset($_SESSION['login_type']) == 'admin') {
    $user = find("first", USERS, $value='*', "where `id` = :id", array(':id' => $_SESSION['id']));   

    if($user['is_admin'] != 1){
    	echo "<script>window.location.href = '/';</script>";
    }
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
					<h6 class="text-center">Administration Zone</h6>
					<hr />
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<?php
					$users = find("all", USERS, $value='*', "ORDER BY `id` DESC", array());
					?>
					<table class="table table-borderless mb-0 table-striped" id="custom_table" >
						<h6 class="text-center mt-2 white">Subscribers List</h6>
						<thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Name</th>
					      <th scope="col">Email</th>
					      <th scope="col">Mobile</th>
					      <th scope="col">Status</th>
					      <th scope="col">Payment Status</th>
					      <th scope="col">Date</th>
					    </tr>
					  </thead>
					  <tbody>
						<?php
	                    foreach ($users as $key => $value) {
	                    ?>
					    <tr>
					      <th scope="row"><?=$value['id'];?></th>
					      <td><?=$value['name'];?></td>
					      <td><?=$value['email'];?></td>
					      <td><?=$value['mobile'];?></td>
					      <td><?=($value['status'])? 'Active' : 'Pending' ?></td>
					      <td><?=($value['payment_id'])? $value['payment_id'] : 'Not Paid' ?></td>
					      <td><?=date("d-m-Y (H:i:s)", strtotime($value['created_at']));?></td>
					    </tr>	
					    <?php } ?>				    
					  </tbody>
					</table>

				</div>
				
			</div>
			
			<hr />
			<div class="row mt-5">
				<div class="col-md-12">
					<?php
					$videos = find("all", VIDEOS, $value='*', "ORDER BY `id` DESC", array());
					?>
					<table class="table table-borderless mb-3 table-striped" id="custom_table2" >
						<h6 class="text-center mt-2 white">Video Details</h6>
						<thead>
					    <tr>
					      <th scope="col">Name</th>
					      <th scope="col">Price</th>
					      <th scope="col">Thumbnail</th>
					      <th scope="col">Trailer Video</th>
					      <th scope="col">Video</th>
					      <th scope="col">Action</th>
					    </tr>
					  </thead>
					  <tbody>
						<?php
	                    foreach ($videos as $key => $value) {
	                    ?>
					    <tr>
					      <td><?=$value['video_name'];?></td>
					      <td>₹<?=$value['price'];?></td>
					      <td><a href="media/<?=$value['thumbnail'];?>" target="_blank"><?=$value['thumbnail'];?></a></td>
					      <td><a href="media/<?=$value['trailer_video'];?>" target="_blank"><?=$value['trailer_video'];?></a></td>
					      <td><a href="media/<?=$value['video_file'];?>" target="_blank"><?=$value['video_file'];?></a></td>
					      <td>
					      	<a href="video-update">Update</a>
					      </td>
					    </tr>	
					    <?php } ?>				    
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</main>

	<footer class="footer mt-auto py-3 bg-dark">
	  <?php include 'component/footer.php'; ?>
	</footer>	
	<script>
		$(document).ready(function() {
	        $('#custom_table').DataTable({
	        	responsive: true,
	        });
	    });
	</script>
</body>
</html>