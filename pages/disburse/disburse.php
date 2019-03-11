<?php
session_start();
$rootPath = "../../";
include_once($rootPath . 'api/Config/Config.php');
include($rootPath . 'templates/header.php');

$baseUrl = str_replace("pages/disburse/disburse.php", "", $url);
$transaction_id = '7AK43993WC1138905';
if(isset($_SESSION['transaction_id'])) {
    $transaction_id = $_SESSION['transaction_id'];
}
?>

<div class="container-fluid">
    <div class="row">
        <!-- Disbursement Section -->
        <div class="col-md-6 col-xs-12">
            <div class="card">
                <h3>Connected: Disbursement</h3>
                <hr>
                <br>
                <form class="form-horizontal" id="disburseConfirm">
                    <div class="form-group">
                        <label for="transaction_id" class="col-sm-2 control-label">Transaction ID</label>
                        <div class="col-sm-10">
                            <input class="form-control"
                                   type="text"
                                   id="transaction_id"
                                   name="seller_email"
                                   value="<?= $transaction_id ?>"
                                   readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <a class="btn btn-primary"
                               href="javascript:void(0)"
                               onclick="runDisbursement()">
                                Disburse Funds
                            </a>
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" id="disburseView" style="display: none">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <p>Item ID: <span id="viewItemID"></span></p>
                            <p>Authorization ID: <span id="viewAuthorizationID"></span></p>
                            <p>Settlement ID: <span id="viewSettlementID"></span></p>
                            <p>Processing Status: <span id="viewProcessingStatus"></span></p>
                        </div>
                    </div>
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
    
    function runDisbursement() {
        showDom('loadingAlert');
        const postData = {
            'transaction_id': '<?= $transaction_id ?>'
        };
        request.post(
            '<?= $rootPath.URL['services']['disburse']['disburse'] ?>',
            postData
        ).then(function(returnObject) {
            hideDom('loadingAlert');
            showDisbursementDetails(returnObject.data);
        });
    }

    function showDisbursementDetails(data) {
        if(data.hasOwnProperty('item_id')) {
            document.getElementById('viewItemID').innerText = data.item_id;
            document.getElementById('viewAuthorizationID').innerText = data.reference_id;
            document.getElementById('viewSettlementID').innerText = data.payout_transaction_id;
            document.getElementById('viewProcessingStatus').innerText = data.processing_state.status;
            hideDom('disburseConfirm');
            showDom('disburseView');
        }
        else {
            console.log(data);
            alert(data.message);
        }
    }
    
</script>
<?php
include($rootPath . 'templates/footer.php');
?>