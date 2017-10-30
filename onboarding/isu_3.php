<?php 
	require_once("../include/incl.header.php");
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

						<!--Display Success message for Integrated Sign Up flow completion-->
						<h4  style="margin-top: 25px;color:#62BD97 ">Setup Complete</h4>
                
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
