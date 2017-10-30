<?php

class test extends PHPUnit_Framework_TestCase {



    public function test_checkVariousDefinitions()
    {
        require_once(dirname(__FILE__)."/../businesslogic/paypalConfig.php");

        //These tests should be running on Sandbox!
        $this->assertEquals(SANDBOX_FLAG, true);
        //Seller Payer IDs need to be defined

        $this->assertNotEmpty(SELLER_2_PAYER_ID);


        //Partner credentials need to be defined
        $this->assertNotEmpty(PARTNER_ID);
        $this->assertNotEmpty(PARTNER_BN_CODE);
        $this->assertNotEmpty(PARTNER_EMAIL);
        $this->assertNotEmpty(PARTNER_CLIENT_ID);
        $this->assertNotEmpty(PARTNER_CLIENT_SECRET);

        //Seller emails need to be defined
        $this->assertNotEmpty(SELLER_1_EMAIL);
        $this->assertNotEmpty(SELLER_2_EMAIL);

        //Seller Payer IDs need to be defined
        $this->assertNotEmpty(SELLER_1_PAYER_ID);
        $this->assertNotEmpty(SELLER_2_PAYER_ID);

    }

    public function test_emailAddressBeingGenerated()
    {
        require_once(dirname(__FILE__)."/../businesslogic/utilFunctions.php");

        $emailAddress = generateEmailAddress();
        print_r("\n In test function test_emailAddressBeingGenerated. Returned Email: " . $emailAddress."\n");
        $this->assertNotEmpty($emailAddress);


    }

    public function test_checkSite() {

        $url = "http://sandbox.paypal.com" ; //Sandbox site

        $useragent = $_SERVER['HTTP_USER_AGENT'];

        $options = array(
                CURLOPT_RETURNTRANSFER => true,      // return web page
                CURLOPT_HEADER         => false,     // do not return headers
                CURLOPT_FOLLOWLOCATION => false,      // follow redirects
                CURLOPT_USERAGENT      => $useragent, // who am i
                CURLOPT_AUTOREFERER    => true,       // set referer on redirect
                CURLOPT_CONNECTTIMEOUT => 2,          // timeout on connect (in seconds)
                CURLOPT_TIMEOUT        => 2,          // timeout on response (in seconds)
                CURLOPT_MAXREDIRS      => 10,         // stop after 10 redirects
                CURLOPT_SSL_VERIFYPEER => false,     // SSL verification not required
                CURLOPT_SSL_VERIFYHOST => false,     // SSL verification not required
        );

        print_r("endpoint: " . SANDBOX_ENDPOINT."\n");
        $ch = curl_init($url);
        curl_setopt_array( $ch, $options );
        curl_exec( $ch );

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        print_r( "\n In test_checkSite(). Return Code : ". $httpcode ."\n");
        $this->assertEquals($httpcode, 302);

    }
}


?>
