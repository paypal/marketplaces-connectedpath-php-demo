<?php
if (session_id() == "")
	session_start();
	require_once("../include/incl.header.php");

	include_once('../businessLogic/paypalFunctions.php');
	include_once('../businessLogic/connected6.php');
	include_once('../businessLogic/connected6Data.php');
	include_once('../businessLogic/utilFunctions.php');

	$access_token = buildAndProcessGetAccessToken();
	$orderID = $_SESSION['order_id'];

	//Call pay for order API
	$jsonResponseForPayAPI = buildAndProcessPayForOrderCall($access_token, $orderID, $payForOrderRequestData);

	$payerEmail = $jsonResponseForPayAPI['payer_info']['email'];
	$firstName = $jsonResponseForPayAPI['payer_info']['first_name'];
	$lastName = $jsonResponseForPayAPI['payer_info']['last_name'];
	$recipientName = $jsonResponseForPayAPI['payer_info']['shipping_address']['recipient_name'];
	$line1 = $jsonResponseForPayAPI['payer_info']['shipping_address']['line1'];
	$line2 = $jsonResponseForPayAPI['payer_info']['shipping_address']['line2'];
	$city = $jsonResponseForPayAPI['payer_info']['shipping_address']['city'];
	$state = $jsonResponseForPayAPI['payer_info']['shipping_address']['state'];
	$postalCode = $jsonResponseForPayAPI['payer_info']['shipping_address']['postal_code'];
	$countryCode = $jsonResponseForPayAPI['payer_info']['shipping_address']['country_code'];
?>

		<script>

			// Load the default state of the Overview icons for this page
			$(document).ready(function() {

				overviewDefault("#icon-isu"); // ISU
				overviewDefault("#icon-ma"); // MA
				overviewHighlight("#icon-checkout"); // Checkout
				overviewDefault("#icon-disburse"); // Disburse
				overviewGrayout("#icon-refund"); // Refund
				overviewDefault("#icon-reports"); // Reports

			});
		</script>

		<div class="container-fluid">

			<div class="row">

				<!-- --------- UPPER LEFT --------- -->
				<div class="col-sm-6">

					<div class="divBorder" style="min-height: 470px;">

						<h3> Checkout & Payment: The Buyer’s Experience </h3>
						<h4> Confirmation </h4>

						<br/>
						<br/>
						<br/>

						Your order has been placed with Order ID: <b><?php print_r($orderID);?></b>. Thank you for shopping with us!
						<br/><br/>
						Following are the Shipping Details:<br/>
						Recipient Name: <?php print_r($recipientName);?> <br/>
						Shipping Address:<br/>
						<?php print_r($line1); ?>
						<?php print_r($line2); ?><br/>
						<?php print_r($city); ?>, <?php print_r($state); ?> - <?php print_r($postalCode); ?>
						<?php print_r($countryCode); ?>


					</div>
				</div>


				<!-- ---------  UPPER RIGHT: Overview icons section --------- -->
				<div class="col-sm-6">
					<div class="divBorder" style="min-height: 470px;">

						<?php require_once("../include/incl.overview.php"); ?>

					</div>
				</div>


				<!-- ---------  BOTTOM: Readme --------- -->
				<div class="col-xs-12">
					<a id="readme"></a>
					<div class="divBorder">
					 	<?php include("../include/incl.readme.php"); ?>
					</div>
				</div>


			</div> <!-- row -->

		</div> <!-- container-fluid -->

<?php require_once("../include/incl.footer.php"); ?>
