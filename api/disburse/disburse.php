<?php

include_once("../Classes/PayPalMarketplace.php");

$marketplaceHelper = new PayPalMarketplace();
$json = file_get_contents('php://input');
$postData = json_decode($json, true);

header('Content-Type: application/json');
echo json_encode($marketplaceHelper->orders->disburse($postData['transaction_id']));