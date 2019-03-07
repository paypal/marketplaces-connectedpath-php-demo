<?php
session_start();
$rootPath = "../../";
include_once($rootPath . 'api/Config/Config.php');
include($rootPath . 'templates/header.php');

$url = strtok(URL['current'], '?');
$baseUrl = str_replace("pages/orders/capture.php", "", $url);
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
                          class="form-horizontal"
                          style="display: none;">
                        <h4>Order Review</h4>
                        <h5>Choose shipping option to complete payment</h5>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Buyer Information</label>
                            <div class="col-sm-7">
                                <p id="confirmBuyerName"></p>
                                <p id="confirmBuyerEmail"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Shipping Information</label>
                            <div class="col-sm-7">
                                <p id="confirmRecipient"></p>
                                <p id="confirmAddressLine1"></p>
                                <p id="confirmAddressLine2"></p>
                                <p>
                                    <span id="confirmCity"></span>,
                                    <span id="confirmState"></span> - <span id="confirmZip"></span>
                                </p>
                                <p id="confirmCountry"></p>
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
                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-7">
                                <label class="btn btn-primary" id="confirmButton">Pay Now</label>
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
    <script type="text/javascript">
        if('<?= $_GET['flow'] ?>' === 'shortcut') {
            getAuthorizationDetails();
        }
        else {
            captureOrder('<?= $_POST['order_id'] ?>', false)
        }

        function getAuthorizationDetails() {
            showDom('loadingAlert');
            const postData = {
                'order_id': '<?= $_POST['order_id'] ?>'
            };
            request.post(
                '<?= $rootPath.URL['services']['orders']['get'] ?>',
                postData
            ).then(function (returnObject) {
                returnObject.data.purchase_units[0].order_id = returnObject.data.id;
                hideDom('loadingAlert');
                showAuthorizationDetails(
                    returnObject.data.payer,
                    returnObject.data.purchase_units[0]
                )
            });
        }

        function showAuthorizationDetails(payer, order) {
            document.getElementById('confirmBuyerName').innerText = payer.name.given_name + ' ' + payer.name.surname;
            document.getElementById('confirmBuyerEmail').innerText = payer.email_address;
            document.getElementById('confirmRecipient').innerText = order.shipping.name.full_name;
            document.getElementById('confirmAddressLine1').innerText = order.shipping.address.address_line_1;
            document.getElementById('confirmAddressLine2').innerText = order.shipping.address.address_line_2;
            document.getElementById('confirmCity').innerText = order.shipping.address.admin_area_2;
            document.getElementById('confirmState').innerText = order.shipping.address.admin_area_1;
            document.getElementById('confirmZip').innerText = order.shipping.address.postal_code;
            showDom('orderConfirm');
            document.querySelector('#confirmButton').addEventListener('click', function () {
                const shippingMethodSelect = document.getElementById("shippingMethod"),
                    updatedShipping = shippingMethodSelect.options[shippingMethodSelect.selectedIndex].value;
                captureOrder(order, updatedShipping);
            });
        }

        function captureOrder(order, updatedShipping) {
            showDom('loadingAlert');
            const postData = {
                'flow': '<?= $_GET['flow'] ?>',
                'order': order,
                'updated_shipping': updatedShipping
            };
            request.post(
                '<?= $rootPath.URL['services']['orders']['capture'] ?>',
                postData
            ).then(function(returnObject) {
                hideDom('loadingAlert');
                hideDom('orderConfirm');
                showOrderConfirmation(returnObject.data);
            });
        }

        function showOrderConfirmation(data) {
            const order = data.purchase_units[0];
            document.getElementById('viewFirstName').textContent = data.payer.name.given_name;
            document.getElementById('viewLastName').textContent = data.payer.name.surname;
            document.getElementById('viewRecipientName').textContent = order.shipping.name.full_name;
            document.getElementById('viewAddressLine1').textContent = order.shipping.address.address_line_1;
            if(order.shipping.address.address_line_2)
                document.getElementById('viewAddressLine2').textContent = order.shipping.address.address_line_2;
            else
                document.getElementById('viewAddressLine2').textContent = "";
            document.getElementById('viewCity').textContent = order.shipping.address.admin_area_2;
            document.getElementById('viewState').textContent = order.shipping.address.admin_area_1;
            document.getElementById('viewPostalCode').innerHTML = order.shipping.address.postal_code;
            document.getElementById('viewOrderID').textContent = data.id;
            document.getElementById('viewReferenceID').textContent = order.reference_id;
            document.getElementById('viewTransactionID').textContent = order.payments.captures[0].id;
            document.getElementById('viewFinalAmount').textContent = order.payments.captures[0].amount.value;
            document.getElementById('viewCurrency').textContent = order.payments.captures[0].amount.currency_code;
            document.getElementById('viewPaymentState').textContent = order.payments.captures[0].status;
            document.getElementById('viewTransactionType').textContent = order.payments.captures[0].disbursement_mode;
            showDom('orderView');
        }
    </script>
<?php
include($rootPath . 'templates/footer.php');
?>
