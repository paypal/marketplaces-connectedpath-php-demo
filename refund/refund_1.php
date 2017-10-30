<?php 
	require_once("../include/incl.header.php");
?>
		
		<script>
		
			// Load the default state of the Overview icons for this page
			$(document).ready(function() {					
				
				overviewDefault("#icon-isu"); // ISU
				overviewDefault("#icon-ma"); // MA
				overviewDefault("#icon-checkout"); // Checkout
				overviewGrayout("#icon-disburse"); // Disburse
				overviewHighlight("#icon-refund"); // Refund
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
						<br/>
						<br/>
						
						<input type="button" class="btn btn-primary" value="Call Refund API" onclick="location.href = 'refund_2.php?mode=<?php echo $mode; ?>';">
                
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
