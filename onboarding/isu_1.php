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

			<!-- --------- UPPER LEFT ----------- -->
			<div class="col-sm-6">

				<div class="divBorder" style="min-height: 470px;">

					<h3> Onboarding: Your merchant’s Experience </h3>


					<h4> </h4>

					<br/>
					<br/>
					<br/>

					<input type="button" class="btn btn-primary" value="Call Prefill API" onclick="location.href = 'isu_2.php?mode=<?php echo $mode;?>'">

				</div>
			</div>


			<!-- ---------  UPPER RIGHT: Overview icons section --------- -->
			<div class="col-sm-6">
				<div class="divBorder" style="min-height: 470px;">

					<?php
					require_once("../include/incl.overview.php");
					?>
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