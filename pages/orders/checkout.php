<?php
$rootPath = "../../";
include_once($rootPath . 'api/Config/Config.php');
include_once($rootPath . 'api/Config/DataFactory.php');
include($rootPath . 'templates/header.php');

$baseUrl = str_replace("pages/orders/checkout.php", "", URL['current']);
$orderDetails = DataFactory::OrderDetails();
if(PAYPAL_ENVIRONMENT === 'sandbox') {
    $debug = 'false';
    $clientID = 'sb';
}
else {
    $debug = 'false';
    $clientID = PAYPAL_CREDENTIALS['production']['client_id'];
}
$sdkConfig = array(
    'client-id' => $clientID,
    'currency' => $orderDetails['purchase_units'][0]['amount']['currency_code'],
    'intent' => strtolower($orderDetails['intent']),
    'commit' => 'true',
    'debug' => $debug
);
?>
<div class="container-fluid">
    <div class="row">
        <!-- Order Section -->
        <div class="col-md-6 col-xs-12">
            <div class="card">
                <h3>Connected: Checkout</h3>
                <hr>
                <br>
                <form id="orderConfirm"
                      class="form-horizontal">
                    <h4>Order Review</h4>
                    <h5>Enter checkout information to complete payment</h5>
                    <br>
                    <!-- Shipping Information -->
                    <div class="form-group">
                        <label for="recipient_name" class="col-sm-5 control-label">Recipient Name</label>
                        <div class="col-sm-7">
                            <input class="form-control"
                                   type="text"
                                   id="recipient_name"
                                   name="recipient_name"
                                   value="Jane Doe"
                                   readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="line1" class="col-sm-5 control-label">Address Line 1</label>
                        <div class="col-sm-7">
                            <input class="form-control"
                                   type="text"
                                   id="line1"
                                   name="line1"
                                   value="55 East 52nd Street"
                                   readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="line2" class="col-sm-5 control-label">Address Line 1</label>
                        <div class="col-sm-7">
                            <input class="form-control"
                                   type="text"
                                   id="line2"
                                   name="line2"
                                   value="21st Floor"
                                   readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col-sm-5 control-label">City</label>
                        <div class="col-sm-7">
                            <input class="form-control"
                                   type="text"
                                   id="city"
                                   name="city"
                                   value="New York"
                                   readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="state" class="col-sm-5 control-label">State</label>
                        <div class="col-sm-7">
                            <input class="form-control"
                                   type="text"
                                   id="state"
                                   name="state"
                                   value="NY"
                                   readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zip" class="col-sm-5 control-label">Postal Code</label>
                        <div class="col-sm-7">
                            <input class="form-control"
                                   type="text"
                                   id="zip"
                                   name="zip"
                                   value="10022"
                                   readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zip" class="col-sm-5 control-label">Country</label>
                        <div class="col-sm-7">
                            <input class="form-control"
                                   type="text"
                                   id="country"
                                   name="country"
                                   value="US"
                                   readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="shippingMethod" class="col-sm-5 control-label">Shipping Type</label>
                        <div class="col-sm-7">
                            <select class="form-control" name="shippingMethod" id="shippingMethod">
                                <optgroup label="United Parcel Service" style="font-style:normal;">
                                    <option value="8.00">
                                        Worldwide Expedited - $8.00</option>
                                    <option value="4.00">
                                        Worldwide Express Saver - $4.00</option>
                                </optgroup>
                                <optgroup label="Flat Rate" style="font-style:normal;">
                                    <option value="2.00" selected>
                                        Fixed - $2.00</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <!-- Checkout Options -->
                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-7">
                            <div class="radio">
                                <label>
                                    <input type="radio"
                                           name="paymentMethod"
                                           id="paypalRadio"
                                           value="paypal"
                                           checked>
                                    <img src="https://fpdbs.paypal.com/dynamicimageweb?cmd=_dynamic-image&amp;buttontype=ecmark&amp;locale=en_US" alt="Acceptance Mark" class="v-middle">
                                    <a href="https://www.paypal.com/us/cgi-bin/webscr?cmd=xpt/Marketing/popup/OLCWhatIsPayPal-outside" onclick="javascript:window.open('https://www.paypal.com/us/cgi-bin/webscr?cmd=xpt/Marketing/popup/OLCWhatIsPayPal-outside','olcwhatispaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, ,left=0, top=0, width=400, height=350'); return false;">What is PayPal?</a>
                                </label>
                            </div>
                            <div class="radio disabled">
                                <label>
                                    <input type="radio"
                                           name="paymentMethod"
                                           id="cardRadio"
                                           value="card"
                                           disabled>
                                    Card
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-7">
                            <!-- Container for PayPal Mark Checkout -->
                            <div id="paypalCheckoutContainer"></div>
                        </div>
                    </div>
                </form>
                <form id="orderView"
                      class="form-horizontal"
                      style="display: none;">
                    <h4>Order Confirmation</h4>
                    <h5>
                        <span id="viewFirstName"></span>
                        <span id="viewLastName"></span>,
                        Thank you for your Order
                    </h5>
                    <br>
                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Shipping Details</label>
                            <div class="col-sm-7">
                                <p id="viewRecipientName"></p>
                                <p id="viewAddressLine1"></p>
                                <p id="viewAddressLine2"></p>
                                <p>
                                    <span id="viewCity"></span>,
                                    <span id="viewState"></span> - <span id="viewPostalCode"></span>
                                </p>
                                <p id="confirmCountry"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Transaction Details</label>
                            <div class="col-sm-7">
                                <p>Reference:
                                    <span id="viewOrderID"></span> [<span id="viewReferenceID"></span>]
                                </p>
                                <p>Transaction ID: <span id="viewTransactionID"></span></p>
                                <p>Payment Total Amount: <span id="viewFinalAmount"></span> </p>
                                <p>Currency Code: <span id="viewCurrency"></span></p>
                                <p>Payment Status: <span id="viewPaymentState"></span></p>
                                <p>Disbursement Type: <span id="viewTransactionType"></span> </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h3> Click <a href='<?= $rootPath ?>order/cart.php'>here </a> to return to Cart Page</h3>
                </form>
                <div id="loadingAlert"
                     style="display: none;">
                    <div class="alert alert-info block"
                         role="alert">
                        Loading....
                    </div>
                </div>
            </div>
        </div>

        <!-- Flow Diagram Section -->
        <div class="col-md-6 col-xs-12">
            <div class="card">
                <h3>Connected Path Overview</h3>
                <hr>
                <br>
                <?php include($rootPath . "templates/flow.php"); ?>
                <br>
            </div>
        </div>

        <!-- Readme section -->
        <div class="col-xs-12">
            <div id="readme" class="card">
                <?php include($rootPath . "templates/readme.php"); ?>
            </div>
        </div>

    </div>
</div>

<script src="<?= $rootPath ?>js/script.js"></script>
<!-- PayPal Javascript SDK script -->
<script type="text/javascript">
    const config = {
        buttons: {
            // Set up the transaction
            createOrder: function() {
                const shippingMethodSelect = document.getElementById("shippingMethod"),
                    updatedShipping = shippingMethodSelect.options[shippingMethodSelect.selectedIndex].value,
                    update = {
                        'updated_shipping': updatedShipping,
                        'shipping_address': {
                            "address_line_1": document.getElementById("line1").value,
                            "address_line_2": document.getElementById("line2").value,
                            "admin_area_1": document.getElementById("state").value,
                            "admin_area_2": document.getElementById("city").value,
                            "postal_code": document.getElementById("zip").value,
                            "country_code": document.getElementById("country").value
                        }
                    };
                const postData = {
                    'original': JSON.parse('<?= json_encode($orderDetails) ?>'),
                    'update': update,
                    'flow': 'mark'
                };
                return request.post(
                    '<?= $rootPath.URL['services']['orders']['create'] ?>',
                    postData
                ).then(function(returnObject) {
                    return returnObject.data.id;
                });
            },

            // Finalize the transaction
            onApprove: function(data) {
                const postData = {
                    key: "order_id",
                    value: data.orderID
                };
                submitForm('<?= $baseUrl.URL['redirect']['orders']['return_url'] ?>?flow=mark', postData);
            },

            // onError() is called when there is an error in this Checkout.js script
            onError: function (error) {
                let url = "<?= $baseUrl ?>pages/orders/error.php?type=error",
                    postData = {
                        key: "error",
                        value: error
                    };
                console.log(postData);
                //submitForm(url, postData);
            }
        }
    };

    let script = document.createElement('script');
    script.onload = function () {
        paypal.Buttons(config.buttons).render('#paypalCheckoutContainer');
    };
    script.src = 'https://www.paypal.com/sdk/js?<?= http_build_query($sdkConfig) ?>';
    document.head.appendChild(script);

</script>
<?php
include($rootPath . 'templates/footer.php');
?>
