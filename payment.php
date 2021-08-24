<?php
require "inc/main_init.php";
require('razorpay/config.php');
require('razorpay/razorpay-php/Razorpay.php');

// Full Site User Information from Here
if (isset($_SESSION['logged']) && isset($_SESSION['id'])) {
    $user = find("first", USERS, $value='*', "where `id` = :id", array(':id' => $_SESSION['id']));   
    $video = find("first", VIDEOS, $value='*', "where `id` = :id", array(':id' => 1)); 
    if($user['is_paid'] == 1){
    	echo "<script>window.location.href = 'view';</script>";
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
					<h6 class="text-center">Make payment to continue watching...</h6>
					<hr />
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 d-flex align-items-center justify-content-center align-self-center mt-5">
					<form method="post">
					    <input type="submit" class="btn btn-danger btn-lg" name="btn-payment" id="btn-payment" value="Pay Now Rs. <?=$video['price']?>" />
					</form>

				</div>
				
			</div>
			<?php
			// Create the Razorpay Order

			use Razorpay\Api\Api;

			$api = new Api($keyId, $keySecret);

			//
			// We create an razorpay order using orders api
			// Docs: https://docs.razorpay.com/docs/orders
			//
			$orderData = [
			    'receipt'         => 3456,
			    'amount'          => $video['price'] * 100, // 2000 rupees in paise
			    'currency'        => 'INR',
			    'payment_capture' => 1 // auto capture
			];

			$razorpayOrder = $api->order->create($orderData);	
			

			$razorpayOrderId = $razorpayOrder['id'];

			$_SESSION['razorpay_order_id'] = $razorpayOrderId;

			$displayAmount = $amount = $orderData['amount'];

			if ($displayCurrency !== 'INR')
			{
			    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
			    $exchange = json_decode(file_get_contents($url), true);

			    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
			}

			$checkout = 'manual';

			if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
			{
			    $checkout = $_GET['checkout'];
			}

			$data = [
			    "key"               => $keyId,
			    "amount"            => $amount,
			    "name"              => "Prahelika Solitary",
			    "description"       => "Prahelika Solitary Transaction",
			    "image"             => "assets/img/logo-sq.jpg",
			    "prefill"           => [
			    "name"              => $user['name'],
			    "email"             => $user['email'],
			    "contact"           => $user['mobile'],
			    ],
			    "notes"             => [
			    "address"           => "India",
			    "merchant_order_id" => "12312321",
			    ],
			    "theme"             => [
			    "color"             => "#000000"
			    ],
			    "order_id"          => $razorpayOrderId,
			];

			if ($displayCurrency !== 'INR')
			{
			    $data['display_currency']  = $displayCurrency;
			    $data['display_amount']    = $displayAmount;
			}

			$json = json_encode($data);

			require("razorpay/checkout/{$checkout}.php");

			?>

			<div class="row mt-5">
				<div class="col-md-12 d-flex align-items-center justify-content-center gap-3">
					<hr />
					<h6 class="text-center gap-4" style="color:wheat;">
						 -- Account Information -- <br/><br/>
						Name : <?=$user['name']?> <br/><br/>
						Email : <?=$user['email']?> <br/><br/>
						Mobile : <?=$user['mobile']?>
					</h6>
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