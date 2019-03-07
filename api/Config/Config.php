<?php

// Urls
if(isset($_SERVER['SERVER_NAME'])) {
    $url = @($_SERVER["HTTPS"] != 'on') ? 'http://' . $_SERVER["SERVER_NAME"] : 'https://' . $_SERVER["SERVER_NAME"];
    $url .= ($_SERVER["SERVER_PORT"] !== 80) ? ":" . $_SERVER["SERVER_PORT"] : "";
    $url .= $_SERVER["REQUEST_URI"];
}
else {
    $url = "";
}

define("URL", array(
    "current" => $url,
    "services" => array(
        "onBoarding" => array(
            "createReferral" => "api/onBoarding/createReferral.php"
        ),
        "orders" => array(
            "create" => "api/orders/create.php",
            "get" => "api/orders/get.php",
            "capture" => "api/orders/capture.php"
        ),
        "disburse" => array(
            "disburse" => "api/disburse/disburse.php"
        ),
        "refunds" => array(
            "refund" => "api/refunds/refund.php"
        )
    ),
    "redirect" => array(
        "onBoarding" => array(
            "return_url" => "pages/onBoarding/complete.php",
            "action_renewal_url" => ""
        ),
        "orders" => array(
            "return_url" => "pages/orders/capture.php",
            "cancel_url" => "pages/orders/error.php?type=cancel"
        )
    )
));

// PayPal Environment 
define("PAYPAL_ENVIRONMENT", "sandbox");

// PayPal REST API endpoints
define("PAYPAL_ENDPOINTS", array(
	"sandbox" => "https://api.sandbox.paypal.com",
	"production" => "https://api.paypal.com"
));

// PayPal REST App credentials
define("PAYPAL_CREDENTIALS", array(
	"sandbox" => [
		"client_id" => "",
		"client_secret" => ""
	],
	"production" => [
		"client_id" => "",
		"client_secret" => ""
	]
));

// PayPal Marketplace Config
define("MARKETPLACE", array(
    "partner_id" => "",
    "seller" => array(
        "email" => "",
        "id" => "",
        "template" => "mp_seller@demoportal.com"
    )
));

// ButtonSource Tracker Code
define("SBN_CODE", "DemoPortalNM6_MP");