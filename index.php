<?php
/*
    * PayPal Commerce Platform Homepage
*/

$rootPath = "";
include($rootPath . 'templates/header.php');

?>

<div class="container-fluid">
    <div class="row">
        <!-- Main Section -->
        <div class="col-md-6 col-xs-12">
            <div class="card">
                <h3>Connected Path</h3>
                <hr>
                <br>
                <a class="btn btn-primary"
                   href="<?= $rootPath ?>pages/onBoarding/create.php">
                    OnBoarding
                </a>
                <a class="btn btn-primary"
                   href="<?= $rootPath ?>pages/orders/cart.php">
                    Orders
                </a>
                <a class="btn btn-primary"
                   href="<?= $rootPath ?>pages/disburse/disburse.php">
                    Disburse
                </a>
                <a class="btn btn-primary"
                   href="<?= $rootPath ?>pages/refunds/refund.php">
                    Refund
                </a>
            </div>
        </div>

        <!-- Managed Path section -->
        <div class="col-md-6 col-xs-12">
            <div class="card">
                <h3>Managed Path</h3>
                <hr>
                <br>
                <p class="lead">
                    Available separately on <a href="https://demo.paypal.com/us/demo/code_samples" target="_blank">PayPal Demo</a>
                </p>
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

<?php
include($rootPath . 'templates/footer.php');
?>
