<?php
$rootPath = "../../";
include_once($rootPath . 'api/Config/Config.php');
include($rootPath . 'templates/header.php');

$error = "";
if(array_key_exists('error', $_POST))
    $error = $_POST['error'];

$baseUrl = str_replace("pages/orders/error.php", "", URL['current']);
?>
    <div class="container-fluid">
        <div class="row">
            <!-- Error Section -->
            <div class="col-xs-12">
                <div class="card">
                    <h3>There was an error during checkout</h3>
                    <hr>
                    <pre id="errorMsg"></pre>
                    <hr>
                    <h3> Click <a href='<?= $rootPath ?>pages/orders/cart.php'>here </a> to return to Cart Page</h3>
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

    <!-- Javascript Import -->
    <script src="<?= $rootPath ?>js/script.js"></script>

    <!-- Error Page JS scripts -->
    <script type="text/javascript">

        if(getUrlParams('type') === 'cancel') {
            document.getElementById('errorMsg').innerHTML = "Buyer has canceled their checkout";
        }
        else {
            document.getElementById('errorMsg').innerHTML = "<?= htmlspecialchars($error) ?>"
        }

    </script>

<?php
include($rootPath . 'templates/footer.php');
?>