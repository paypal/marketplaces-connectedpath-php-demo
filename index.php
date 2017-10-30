<?php
if (session_id() == "")
	session_start();
	require_once("include/incl.indexheader.php");
?>

		<div class="container-fluid">
			<div class="row">
		
				<!-- --------- UPPER LEFT --------- -->
				<div class="col-sm-6">
				
					<div class="divBorder" style="min-height: 470px;">

						<h3> Connected Path </h3>
						</br>
						</br>
						<h4> Pattern: <small>Funds Movement: Yes;  Partner Fee: Yes;  Cart Type: Multi Merchant Cart</small></h4>
						<p style="font-size:18px">
							<a href="onboarding/isu_1.php?mode=isu">Onboarding</a> -
							<a href="checkout/checkout_1.php?mode=isu">Checkout</a> -
							<a href="disburse/disburse_1.php?mode=isu">Disburse</a> -
							<a href="refund/refund_1.php?mode=isu">Refund</a>
						</p>
						
						</br>
						</br>

					</div>
					
					
				</div>
				
				<!-- --------- UPPER RIGHT --------- -->
				<div class="col-sm-6">

				
					<div class="divBorder" style="min-height: 470px;">

						 <h3> Managed Path </h3>
						</br>
						</br>
						<p style="font-size:18px" >
							<!-- Managed Accounts - Checkout - Disburse - Refund -->
							Available separately on <a href="https://demo.paypal.com/us/demo/code_samples" target="_blank">PayPal Demo</a>.
						</p>
						</br>
						</br>
						

					</div>
					
					
				</div>				

	
				<!-- ---------  Readme --------- -->
				
				<div class="col-xs-12">
					<a id="readme"></a>
					<div class="divBorder">
					 	<?php include("include/incl.readme.php"); ?>
					</div>
				</div>  

			</div> <!-- row -->

		</div> <!-- container -->

<?php require_once("include/incl.footer.php"); ?>
