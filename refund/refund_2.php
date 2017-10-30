<?php 
	if (session_id() == "")
		session_start();
	require_once("../include/incl.header.php");
	
	include_once('../businessLogic/connected6.php');
	include_once('../businessLogic/connected6Data.php');
	include_once('../businessLogic/utilFunctions.php');
	
	$access_token = buildAndProcessGetAccessToken();
	$orderID = $_SESSION['order_id'];

	//Get Capture ID for a particular Purchase Unit, in the following case for Purchase Unit 1 (PU1) , the Watch
	$captureID = buildAndProcessGetCaptureIDFromPurchaseUnit($access_token, $orderID, 0);
	
	if ($captureID === NULL) {
		$statusMessage = "Capture ID not yet generated"; //Try again later
	} else {
		//Call refund API
		$status = buildAndProcessRefundCall($access_token, $captureID, $refundRequestData);
		$statusMessage = "Status = ".$status;
	}
?>
		
		<script>
		
			// Load the default state of the Overview icons for this page
			$(document).ready(function() {					
				
				overviewDefault("#icon-isu"); // ISU
				overviewDefault("#icon-ma"); // MA
				overviewDefault("#icon-checkout"); // Checkout
				overviewGrayout("#icon-disburse"); // Disburse
				overviewGrayoutHighlight("#icon-refund"); // Refund
				overviewDefault("#icon-reports"); // Reports
				
			});
		</script>

		<div class="container-fluid">
		
			<div class="row">

				<!-- --------- UPPER LEFT --------- -->			
				<div class="col-sm-6">

					<div class="divBorder" style="min-height: 470px;">

						<h3> Business Operations: Refund </h3>
						

						
						<br/>
						<br/><?php echo($statusMessage) ?>
						<br/>

						<h4 style="margin-left:50px;"> Refund API call completed.</h4>
                
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
