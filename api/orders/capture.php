<?php

session_start();
include_once("../Classes/PayPalMarketplace.php");

$marketplaceHelper = new PayPalMarketplace();
$json = file_get_contents('php://input');
$postData = json_decode($json, true);

if($postData['flow'] === 'shortcut') {
    $orderID = $postData['order']['order_id'];
    $marketplaceHelper->orders->patch($postData);
}
else {
    $orderID = $postData['order'];
}
$returnData = $marketplaceHelper->orders->capture($orderID);
$_SESSION['transaction_id'] = $returnData['data']['purchase_units'][0]['payments']['captures'][0]['id'];

header('Content-Type: application/json');
echo json_encode($returnData);