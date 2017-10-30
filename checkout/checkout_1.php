<?php 
	require_once("../include/incl.header.php");
    include_once('../businessLogic/paypalConfig.php');
?>
		<!-- Reference the required client SDKs -->
		<a id="CheckoutPPStart" href="<?php echo(CHECKOUT_START_URL)?>" hidden>Checkout with PayPal</a>
        <a id="CheckoutPPDone" href="<?php echo(CHECKOUT_RETURN_URL)?>" hidden>Checkout with PayPal</a>
		<script src="https://www.paypalobjects.com/api/checkout.js"></script>
		<script>
		
			// Load the default state of the Overview icons for this page
			$(document).ready(function() {					
				
				overviewDefault("#icon-isu"); // ISU
				overviewDefault("#icon-ma"); // MA
				overviewHighlight("#icon-checkout"); // Checkout
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

                        <h3> Checkout & Payment: The Buyer’s Experience </h3>

						<?php
                            include_once('../businessLogic/paypalFunctions.php');
                            include_once('../businessLogic/connected6.php');
                        	include_once('../businessLogic/utilFunctions.php');
                        ?>

						<div class="primary shopping-cart" role="main" style="border-top:1px solid #d4d2cf">
                                        <article>
                                            <br/>
                                            <h4>Shopping Cart</h4>
                                            <div class="cart-list boxed-content narrow-margin">
                                                <table colspan="12">

                                                    <colgroup>
                                                        <col span="2" title="Items" class="col-items" />
                                                        <col span="4" title="Details" class="col-details" />
                                                        <col span="2" title="Price" class="col-price" />
                                                        <col span="1" title="Quantity" class="col-qty" />
                                                        <col span="3" title="Total" class="col-total" />
                                                    </colgroup>
                                                    <thead class="show-for-medium">
                                                    <tr>
                                                        <th style="width: 15.2%;" scope="col">Items</th>
                                                        <th class="cart-details" scope="col">Details</th>
                                                        <th class="cart-price" scope="col">Price</th>
                                                        <th class="cart-qty" scope="col">Quantity</th>
                                                        <th class="cart-total" scope="col">Total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="cartRow">
                                                        <th class="cart-items" scope="row">
                                                            <img src="img/product-watch-180x180.jpg" width="100px" height="100px" alt="Watch">
                                                        </th>
                                                        <td class="cart-details" >
                                                            <p class="cartText">Seller: Watch Shop</p>
                                                            <p>Item #: 123456789</p>
                                                        </td>
                                                        <td class="cart-price" >$100</td>
                                                        <td class="cart-qty" ><span>1</span></td>
                                                        <td class="cart-total" >$100</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="cart-items" scope="row">
                                                            <img src="img/product-camera-180x180.jpg" width="100px" height="100px" alt="Black SLR Camera">
                                                        </th>
                                                        <td class="cart-details" >
                                                            <p class="cartText">Seller: Camera Shop</p>
                                                            <p>Item #: 123456790</p>
                                                        </td>
                                                        <td class="cart-price" >$300</td>
                                                        <td class="cart-qty" ><span>1</span></td>
                                                        <td class="cart-total" >$300</td>
                                                    </tr>
                                                    <tr style="border-top:1px solid #d4d2cf">
                                                        <td colspan="2">

                                                        </td>

                                                        <td colspan="2" style="padding-left:37px;">
                                                            <table>
                                                            <tr class="subtotal">
                                                                <td>Subtotal:</td>
                                                                <td>$400</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Shipping:</td>
                                                                <td>free</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Estimated Tax</td>
                                                                <td>&mdash;</td>
                                                            </tr>
                                                            <tr class="total" style="border-top:1px solid #d4d2cf">
                                                                <td>Order Total</td>
                                                                <td>$400</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div  class="partnerCheckoutWithPayPalContainer">
                                                                        <!--Checkout with PayPal Button-->
                                                                        <div id="paypal-button"></div>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            </table>
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </article>
                                    </div>
                
					</div>
				</div>


                <!--Checkout.js v4 script to render the Checkout button and control flow-->
				<script type="text/javascript">
                            var checkoutPPStart = document.getElementById(('CheckoutPPStart'));
                            var checkoutPPDone= document.getElementById('CheckoutPPDone');
                            paypal.Button.render({

                                env: 'sandbox', /* Or 'production'*/
                                style: {
                                    label: 'checkout', /* checkout | credit | pay */
                                    size:  'medium',    /* small | medium | responsive */
                                    shape: 'pill',     /* pill | rect */
                                    color: 'gold'      /* gold | blue | silver */
                                },

                                commit: true, /* Show a 'Pay Now' button */

                                payment: function(resolve) {
                                    /* Set up the payment here */
                                    return paypal.request.get(checkoutPPStart)
                                        .then(function(ecToken) {
                                            return ecToken;
                                        });
                                },

                                onAuthorize: function(data, actions) {
                                    /* Execute the payment here */
                                    window.parent.location = checkoutPPDone;
                                }

                            }, '#paypal-button');
                </script>

				
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
