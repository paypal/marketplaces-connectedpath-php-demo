<?php
session_start();
$rootPath = "../../";
include_once($rootPath . 'api/Config/Config.php');
include_once($rootPath . 'api/Config/DataFactory.php');
include($rootPath . 'templates/header.php');

$baseUrl = str_replace("pages/onBoarding/create.php", "", URL['current']);
$prefill = DataFactory::PartnerReferral('prefill');
$prefill['web_experience_preference']['return_url'] = $baseUrl.URL['redirect']['onBoarding']['return_url'];
$prefill['web_experience_preference']['action_renewal_url'] = $baseUrl.URL['redirect']['onBoarding']['action_renewal_url'];

$_SESSION["seller_email"] = $prefill['customer_data']['person_details']['email_address'];
$_SESSION["tracking_id"] = $prefill['customer_data']['partner_specific_identifiers'][0]['value'];
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
                        <label for="seller_email" class="col-sm-2 control-label">Seller Email</label>
                        <div class="col-sm-10">
                            <input class="form-control"
                                   type="text"
                                   id="seller_email"
                                   name="seller_email"
                                   value="<?= $_SESSION["seller_email"] ?>"
                                   readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tracking_id" class="col-sm-2 control-label">Tracking ID</label>
                        <div class="col-sm-10">
                            <input class="form-control"
                                   type="text"
                                   id="tracking_id"
                                   name="tracking_id"
                                   value="<?= $_SESSION["tracking_id"] ?>"
                                   readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-5">
                            <a id="createReferralButton"
                                   class="btn btn-primary"
                                   href="javascript:void(0)"
                                   onclick="createReferral()">
                                Create Partner Referral
                            </a>
                            <div dir="ltr" trbidi="on">
                                <script>
                                    (function(d, s, id) {
                                        let js, ref = d.getElementsByTagName(s)[0];
                                        if (!d.getElementById(id)) {
                                            js = d.createElement(s);
                                            js.id = id;
                                            js.async = true;
                                            js.src = "https://www.paypal.com/webapps/merchantboarding/js/lib/lightbox/partner.js";
                                            ref.parentNode.insertBefore(js, ref);
                                        }
                                    }(document, "script", "paypal-js"));

                                </script>
                                <a id="popUpButton"
                                   style="display: none"
                                   class="btn btn-primary"
                                   data-paypal-button="true"
                                   href="javascript:void(0)"
                                   target="PPFrame">
                                    Sign Up for PayPal
                                </a>
                            </div>
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

    function createReferral() {
        showDom('loadingAlert');
        const postData = JSON.parse('<?= json_encode($prefill) ?>');
        request.post(
            '<?= $rootPath.URL['services']['onBoarding']['createReferral'] ?>',
            postData
        ).then(function(returnObject) {
            returnObject.data.links.forEach(function (link) {
                if(link.rel === 'action_url') {
                    document.getElementById('popUpButton').href = link.href + '&displayMode=minibrowser';
                    hideDom('createReferralButton');
                    hideDom('loadingAlert');
                    showDom('popUpButton');
                }
            });
        });
    }

</script>

<?php
include($rootPath . 'templates/footer.php');
?>