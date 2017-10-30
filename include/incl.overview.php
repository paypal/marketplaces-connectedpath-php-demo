						<div class="container-fluid">
							<div class="row" >
								
								<?php 
									if ($mode == "isu") {
										require_once("incl.overview.isu.php");
									}
									else {
										require_once("incl.overview.ma.php");
									}
								?>

								<!-- checkout -->
								<div id="icon-checkout" class="col-xs-3 outer-border" url="../checkout/checkout_1.php?mode=<?php echo $mode; ?>">
									<div style="height: 60px; width: 60px; margin: 0 auto;">
										<img style="padding-top: 10px;" class="img-responsive" src="../img/icons/ShoppingCart_Color_Lifestyle_Glyphs.png" />
									</div>
									<div style="padding-top: 10px;">
										<h4>Checkout</h4>
									</div>									
								</div>
									
								<!-- disburse -->
								<div id="icon-disburse" class="col-xs-3 outer-border" url="../disburse/disburse_1.php?mode=<?php echo $mode; ?>">
									<div style="height: 60px; width: 60px; margin: 0 auto;">
										<img style="padding-top: 5px;" class="img-responsive" src="../img/icons/SendFunds_Color_Symbols.png" />
									</div>
									<div style="padding-top: 10px;">
										<h4>Disburse</h4>
									</div>									
								</div>
								
								<!-- refund -->
								<div id="icon-refund" class="col-xs-3 outer-border" url="../refund/refund_1.php?mode=<?php echo $mode; ?>">
									<div style="height: 50px; width: 50px; margin: 0 auto;">
										<img style="padding-top: 10px;" class="img-responsive" src="../img/icons/Airplane_Color_Lifestyle_Glyphs.png" />
									</div>
									<div style="padding-top: 20px;">
										<h4>Refund</h4>
									</div>
								</div>
								
					 	  	</div>
							
						</div>	