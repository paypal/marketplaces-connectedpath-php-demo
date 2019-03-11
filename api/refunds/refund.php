<?php

include_once("../Classes/PayPalMarketplace.php");
include_once("../Config/DataFactory.php");

$marketplaceHelper = new PayPalMarketplace();
$json = file_get_contents('php://input');
$postData = json_decode($json, true);

$postData['auth_assertion'] = DataFactory::PayPalAuthAssertion();

header('Content-Type: application/json');
echo json_encode($marketplaceHelper->orders->refund($postData));