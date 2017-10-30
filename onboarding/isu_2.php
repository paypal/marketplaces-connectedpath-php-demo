<?php 
	require_once("../include/incl.header.php");

	include_once('../businessLogic/connected6.php');
	include_once('../businessLogic/connected6Data.php');
	include_once('../businessLogic/utilFunctions.php');

	//Call API to get the access token needed for the REST API calls
	$access_token =buildAndProcessGetAccessToken();
	$_SESSION['access_token'] = $access_token;

	$isuReqArray = json_decode($isuRequestData, true);
	$newSellerEmailAddress = generateEmailAddress();
	$isuReqArray['customer_data']['person_details']['email_address'] = $newSellerEmailAddress; //update the email address with a random generated value
	$isuRequestJson = json_encode($isuReqArray);

	//Call Partner Referral API(with Prefill) for Integrated Sign Up onboarding flow
	$action_url = buildAndProcessISUFlow($_SESSION['access_token'], $isuRequestJson);

?>
		
		<script>
		
			// Load the default state of the Overview icons for this page
			$(document).ready(function() {					
				
				overviewHighlight("#icon-isu"); // ISU				
				overviewDefault("#icon-checkout"); // Checkout
				overviewGrayout("#icon-disburse"); // Disburse
				overviewGrayout("#icon-refund"); // Refund
				overviewDefault("#icon-reports"); // Reports
				
			});		
		</script>

		<div class="container-fluid">
		
			<div class="row">

				<!-- --------- UPPER LEFT --------- -->			
				<div class="col-sm-6">

					<div class="divBorder" style="min-height: 470px;">

						<h3> Onboarding: Your merchant’s Experience </h3>

						<br/>
						<h4> PayPal Payments</h4>
						<!--Script to get the mini-browser or in-context flow for the Integrated Sign Up experience-->
						<script>
							(function(d, s, id){
								var js, ref = d.getElementsByTagName(s)[0];
								if (!d.getElementById(id)){
									js = d.createElement(s); js.id = id; js.async = true;
									js.src = "https://www.sandbox.paypal.com/webapps/merchantboarding/js/lib/lightbox/partner.js";
									ref.parentNode.insertBefore(js, ref);
								}
							}(document, "script", "paypal-js"));
						</script>

						<h5 style="margin-top: 25px;">Want to let your customers pay with PayPal?</h5>

						<!--Link to redirect the user(merchant) too-->
						<a href="<?php echo($action_url); ?>&displayMode=minibrowser" data-paypal-button="true">
							<h4  style="margin-top: 25px;">Enable PayPal</h4>
						</a>

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
