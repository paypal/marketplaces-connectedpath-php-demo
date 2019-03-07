<?php
session_start();
$rootPath = "../../";
include_once($rootPath . 'api/Config/Config.php');
include($rootPath . 'templates/header.php');

$baseUrl = str_replace("pages/refunds/refund.php", "", $url);
$transaction_id = '7AK43993WC1138905';
$refund_reason = 'Testing refunds using partner';
if(isset($_SESSION['transaction_id'])) {
    $transaction_id = $_SESSION['transaction_id'];
}
?>

    <div class="container-fluid">
        <div class="row">
            <!-- Disbursement Section -->
            <div class="col-md-6 col-xs-12">
                <div class="card">
                    <h3>Connected: Refunds</h3>
                    <hr>
                    <br>
                    <form class="form-horizontal" id="refundConfirm">
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
                            <label for="transaction_id" class="col-sm-2 control-label">Reason</label>
                            <div class="col-sm-10">
                                <input class="form-control"
                                       type="text"
                                       id="transaction_id"
                                       name="seller_email"
                                       value="<?= $refund_reason ?>"
                                       readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <a class="btn btn-primary"
                                   href="javascript:void(0)"
                                   onclick="runRefund()">
                                    Refund Transaction
                                </a>
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal" id="refundView" style="display: none">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <p>Refund ID: <span id="viewRefundID"></span></p>
                                <p>Status: <span id="viewStatus"></span></p>
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

        function runRefund() {
            showDom('loadingAlert');
            const postData = {
                'transaction_id': '<?= $transaction_id ?>',
                'refund_reason': '<?= $refund_reason ?>'
            };
            request.post(
                '<?= $rootPath.URL['services']['refunds']['refund'] ?>',
                postData
            ).then(function(returnObject) {
                hideDom('loadingAlert');
                showRefundDetails(returnObject.data);
            });
        }

        function showRefundDetails(data) {
            if(data.hasOwnProperty('id')) {
                document.getElementById('viewRefundID').innerText = data.id;
                document.getElementById('viewStatus').innerText = data.status;
                hideDom('refundConfirm');
                showDom('refundView');
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