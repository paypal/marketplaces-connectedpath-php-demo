<?php
    /*
        * Config for PayPal specific values
    */
    //Whether Sandbox environment is being used, Keep it true for testing
    define("SANDBOX_FLAG", true);
    define("WEBHOOK_CONFIGURED", false);
    //PayPal REST API endpoints
    define("SANDBOX_ENDPOINT", "https://api.sandbox.paypal.com");
    define("LIVE_ENDPOINT", "https://api.paypal.com");
    //Environments -Sandbox and Production/Live
    define("SANDBOX_ENV", "sandbox");
    define("LIVE_ENV", "production");
    //ISU return URL
    define("ISU_RETURN_URL",'http://'.$_SERVER['HTTP_HOST'].preg_replace('/isu_2.php/','isu_3.php?mode=isu',$_SERVER['SCRIPT_NAME']));
    define("ISU_ACTION_RENEWAL_URL",'http://'.$_SERVER['HTTP_HOST'].preg_replace('/isu_2.php/','isu_1.php?mode=isu',$_SERVER['SCRIPT_NAME']));
    //Checkout URL
    define("CHECKOUT_START_URL",'http://'.$_SERVER['HTTP_HOST'].preg_replace('/checkout_1.php/','checkout_2.php?mode=isu',$_SERVER['SCRIPT_NAME']));
    define("CHECKOUT_RETURN_URL",'http://'.$_SERVER['HTTP_HOST'].preg_replace('/checkout_1.php/','checkout_3.php?mode=isu',$_SERVER['SCRIPT_NAME']));

    //Partner credentials
    define("PARTNER_ID","");
    define("PARTNER_BN_CODE", "");
    define("PARTNER_EMAIL", "");
    define("PARTNER_CLIENT_ID","");
    define("PARTNER_CLIENT_SECRET", "");

    //Seller emails
    define("SELLER_1_EMAIL", "");
    define("SELLER_2_EMAIL", "");

    //Seller Payer IDs
    define("SELLER_1_PAYER_ID", "");
    define("SELLER_2_PAYER_ID", "");

?>