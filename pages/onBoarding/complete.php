<?php
session_start();
$rootPath = "../../";
include_once($rootPath . 'api/Config/Config.php');
include($rootPath . 'templates/header.php');

$url = strtok(URL['current'], '?');
$baseUrl = str_replace("pages/onBoarding/complete.php", "", $url);
$_SESSION['merchant_id'] = $_GET['merchantIdInPayPal'];
?>

<div class="container-fluid">
    <div class="row">
        <!-- OnBoarding Section -->
        <div class="col-md-6 col-xs-12">
            <div class="card">
                <h3>Connected: OnBoarding</h3>
                <hr>
                <br>
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-7">
                            <p><b>Seller Email:</b> <span><?= $_SESSION['seller_email'] ?></span></p>
                            <p><b>Tracking ID:</b> <span><?= $_SESSION['tracking_id'] ?></span></p>
                            <p><b>Merchant ID:</b> <span><?= $_SESSION['merchant_id'] ?></span></p>
                        </div>
                    </div>
                </form>
                <h3> Click <a href='<?= $rootPath ?>index.php'>here </a> to return to Home Page</h3>
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
<?php
include($rootPath . 'templates/footer.php');
?>