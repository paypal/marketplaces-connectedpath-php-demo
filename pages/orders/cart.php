<?php
session_start();
$rootPath = "../../";
include_once($rootPath . 'api/Config/Config.php');
include_once($rootPath . 'api/Config/DataFactory.php');
include($rootPath . 'templates/header.php');

$baseUrl = str_replace("pages/orders/cart.php", "", URL['current']);
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
    'commit' => 'false',
    'debug' => $debug
);
?>

<div class="container-fluid">
    <div class="row">
        <!-- Shopping Cart Section -->
        <div class="col-md-6 col-xs-12">
            <div class="card">
                <h3>Connected: Shopping Cart</h3>
                <hr>
                <h5>Merchant Email: <?= $orderDetails['purchase_units'][0]['payee']['email_address'] ?></h5>
                <div class="table-responsive">
                    <table class="table cart-table">
                        <tr>
                            <th>Product</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                        <!-- Line Items -->
                        <tr>
                            <td>
                                <img class="img-responsive img-item"
                                     alt="<?= $orderDetails['purchase_units'][0]['items'][0]['name'] ?>"
                                     src="<?= $rootPath ?>img/camera.jpg">
                                <?= $orderDetails['purchase_units'][0]['items'][0]['name'] ?>
                                <br>
                                <small class="text-muted">SKU: <?= $orderDetails['purchase_units'][0]['items'][0]['sku'] ?></small>
                            </td>
                            <td><?= $orderDetails['purchase_units'][0]['items'][0]['description'] ?></td>
                            <td><?= $orderDetails['purchase_units'][0]['items'][0]['quantity'] ?></td>
                            <td><?= $orderDetails['purchase_units'][0]['items'][0]['unit_amount']['value'] ?></td>
                        </tr>
                        <!-- Total -->
                        <tr>
                            <td colspan="2"></td>
                            <th>
                                <p>Total Amount</p>
                                <small>
                                    <a class="cart-toggle collapsed"
                                       type="button"
                                       data-toggle="collapse"
                                       aria-expanded="false"
                                       data-target="#cartAggregateItems"
                                       aria-controls="cartAggregateItems">
                                    </a>
                                </small>
                            </th>
                            <th><?= $orderDetails['purchase_units'][0]['amount']['value'] ?></th>
                        </tr>
                        <!-- Aggregate Items -->
                        <tbody class="collapse" id="cartAggregateItems">
                        <tr>
                            <td colspan="2"></td>
                            <td>Tax</td>
                            <td><?= $orderDetails['purchase_units'][0]['amount']['breakdown']['tax_total']['value'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>Insurance</td>
                            <td><?= $orderDetails['purchase_units'][0]['amount']['breakdown']['insurance']['value'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>Handling Fee</td>
                            <td><?= $orderDetails['purchase_units'][0]['amount']['breakdown']['handling']['value'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>Estimated Shipping</td>
                            <td><?= $orderDetails['purchase_units'][0]['amount']['breakdown']['shipping']['value'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>Shipping Discount</td>
                            <td>-<?= $orderDetails['purchase_units'][0]['amount']['breakdown']['shipping_discount']['value'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>Currency</td>
                            <td><?= $orderDetails['purchase_units'][0]['amount']['currency_code'] ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <!-- Checkout Options -->
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-offset-6 col-sm-6 text-center">
                            <!-- PayPal Shortcut Checkout -->
                            <div id="paypalCheckoutContainer"></div>
                            <h4 class="text-center">OR</h4>
                            <!-- PayPal Mark Redirect -->
                            <a class="btn btn-primary"
                               href="<?= $rootPath . 'pages/orders/checkout.php' ?>">
                                <h5>Proceed to Checkout</h5>
                            </a>
                        </div>
                    </div>
                </form>
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

<!-- PayPal JSV4 script -->
<script src="<?= $rootPath ?>js/script.js"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    paypal.Button.render({

        // Set your environment
        env: '<?= PAYPAL_ENVIRONMENT ?>',

        // Set style of buttons
        style: {
            layout: 'horizontal',   // horizontal | vertical
            size:   'medium',   // medium | large | responsive
            shape:  'pill',         // pill | rect
            color:  'gold',         // gold | blue | silver | black,
            fundingicons: false,    // true | false,
            tagline: false,          // true | false,
        },

        // Set allowed funding sources
        funding: {
            allowed: [
                paypal.FUNDING.CARD,
                paypal.FUNDING.CREDIT
            ],
            disallowed: [ ]
        },

        // Show the buyer a 'Pay Now' button in the checkout flow
        commit: false,

        // payment() is called to start the payment flow when a button is clicked
        payment: function() {
            const postData = {
                'original': JSON.parse('<?= json_encode($orderDetails) ?>'),
                'update': null,
                'flow': 'shortcut'
            };
            return request.post(
                '<?= $rootPath.URL['services']['orders']['create'] ?>',
                postData
            ).then(function(returnObject) {
                return returnObject.data.id;
            });
        },

        // onAuthorize() is called when the buyer approves the payment
        onAuthorize: function(data) {
            const postData = {
                key: "order_id",
                value: data.orderID
            };
            submitForm('<?= $baseUrl.URL['redirect']['orders']['return_url'] ?>?flow=shortcut', postData);
        },

        // onCancel() is called when the buyer cancels payment authorization
        onCancel: function(data) {
            let url = "<?= $baseUrl ?>pages/orders/error.php?type=error",
                postData = {
                    key: "error",
                    value: data
                };
            submitForm(url, postData);
        },

        // onError() is called when there is an error in this Checkout.js script
        onError: function (error) {
            let url = "<?= $baseUrl ?>pages/orders/error.php?type=error",
                postData = {
                    key: "error",
                    value: error
                };
            submitForm(url, postData);
        }

    }, '#paypalCheckoutContainer');
</script>

<!-- PayPal Javascript SDK script
<script src="<?= $rootPath ?>js/script.js"></script>
<script type="text/javascript">
    const config = {
        buttons: {
            // Set up the transaction
            createOrder: function() {
                const postData = {
                    'original': JSON.parse('<?= json_encode($orderDetails) ?>'),
                    'update': null,
                    'flow': 'shortcut'
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
                submitForm('<?= $baseUrl.URL['redirect']['orders']['return_url'] ?>?flow=shortcut', postData);
            },

            // onError() is called when there is an error in this Checkout.js script
            onError: function (error) {
                let url = "<?= $baseUrl ?>pages/orders/error.php?type=error",
                    postData = {
                        key: "error",
                        value: error
                    };
                submitForm(url, postData);
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
-->
<?php
include($rootPath . 'templates/footer.php');
?>