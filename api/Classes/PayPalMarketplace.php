<?php
include_once('../Config/Config.php');
include_once('OnBoarding.php');
include_once('Orders.php');

class PayPalMarketplace {

    public $onBoarding = null;
    public $orders = null;

    public function __construct() {
        $this->onBoarding = new ConnectedOnBoarding();
        $this->orders = new Orders();
    }
}