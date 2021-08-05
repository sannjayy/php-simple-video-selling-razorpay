<?php
require "inc/main_init.php";
require('razorpay/config.php');
require('razorpay/razorpay-php/Razorpay.php');

// Full Site User Information from Here
if (isset($_SESSION['logged']) && isset($_SESSION['id'])) {
    $user = find("first", USERS, $value='*', "where `id` = :id", array(':id' => $_SESSION['id']));   
    if(!isset($_REQUEST['razorpay_payment_id'])){
    	echo "<script>window.location.href = 'login';</script>";
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
					<h6 class="text-center">Thank you for your payment.</h6>
					<hr />
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 d-flexjustify-content-center">
				<?php				
				use Razorpay\Api\Api;
				use Razorpay\Api\Errors\SignatureVerificationError;

				$success = true;

				$error = "Payment Failed";

				if (empty($_POST['razorpay_payment_id']) === false)
				{
				    $api = new Api($keyId, $keySecret);

				    try
				    {
				        // Please note that the razorpay order ID must
				        // come from a trusted source (session here, but
				        // could be database or something else)
				        $attributes = array(
				            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
				            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
				            'razorpay_signature' => $_POST['razorpay_signature']
				        );

				        $api->utility->verifyPaymentSignature($attributes);
				    }
				    catch(SignatureVerificationError $e)
				    {
				        $success = false;
				        $error = 'Razorpay Error : ' . $e->getMessage();
				    }
				}

				if ($success === true)
				{
					# Updating User After Payment Success
					$set_value = "`is_paid` = :is_paid, `payment_id` = :payment_id, `status` = :status";
					$execute=array(
	                    ":is_paid" => 1,
	                    ":payment_id" => $_REQUEST['razorpay_payment_id'],
	                    ":status" => 1,
	                    ":update_id" => $user['id']
	                );
	                update(USERS, $set_value, "where `id` = :update_id", $execute);
	                # Updating User After Payment Success End

				    $html = "<br/><p style='color:wheat;text-align:center;'>Your payment was successful</p>
				             <p style='color:wheat;text-align:center;'>Payment ID: {$_POST['razorpay_payment_id']}</p>";
				}
				else
				{
				    $html = "<p style='color:wheat;text-align:center;'>Your payment failed</p>
				             <p style='color:wheat;text-align:center;'>{$error}</p>";
				}

				echo $html;
				?>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col-md-12 d-flex align-items-center justify-content-center">
					<hr />
					</a> 
					<h6 class="text-center" style="color:wheat;">
						<a href="view"><button type="button" class="btn btn-danger">Open Video</button> </a><br/><br/>
						Dear <?=$user['name']?>, Thank you for your purchase.</h6>
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