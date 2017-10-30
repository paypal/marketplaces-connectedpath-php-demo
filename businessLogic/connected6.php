<?php
/********************************************
	Prepare data for PayPal API calls and process API response
	********************************************/
	include_once('paypalConfig.php');
	include_once('paypalFunctions.php');
/*
	* Purpose: 	Prepare data to call the get access token API
	* Inputs:
	* Returns:  access token
	*
	*/
function buildAndProcessGetAccessToken(){
	$base6encodedPartnerAuth = base64_encode(PARTNER_CLIENT_ID.':'.PARTNER_CLIENT_SECRET);
	$curlHeader = array(
		"Content-type" => "application/json",
		"Authorization: Basic ".$base6encodedPartnerAuth, //"Authorization: Basic ". base64_encode( $clientId .":". $clientSecret),
		"PayPal-Partner-Attribution-Id" => PARTNER_BN_CODE
		);
	$postData = array(
		 "grant_type" => "client_credentials"
		 );

	$curlResponse = getAccessToken($curlHeader, $postData);
	$access_token = $curlResponse['json']['access_token'];
	return $access_token;
}

/*
	* Purpose: 	Prepare data to call the prefill API for Onboarding flow
	* Inputs:
	*		access_token    : The access token received from PayPal
	* Returns:              action URL
	*/
function buildAndProcessISUFlow($access_token, $postData){

	$curlHeader = array("Content-Type:application/json", "Authorization:Bearer ".$access_token, "PayPal-Partner-Attribution-Id:".PARTNER_BN_CODE);
	$jsonResponse = callISUFlow($access_token, $curlHeader, $postData);


	foreach ($jsonResponse['json'] as $link) {
		$action_url = $link[1]['href'];
		return $action_url;
	}
}

/*
	* Purpose: 	Prepare data to call the PayPal Risk transaction context API
	* Inputs:
	*		access_token    : The access token received from PayPal
	* Returns:              curlResponse
	*/
function buildAndProcessRiskContextCall($access_token, $postData){

	$curlHeader = array("Content-Type:application/json","Accept:application/json", "Authorization:Bearer ".$access_token, "PayPal-Partner-Attribution-Id:".PARTNER_BN_CODE, "X-HTTP-Method-Override: PUT");
	$partnerID = PARTNER_ID;
	$curlResponse = callRiskTransactionContext($access_token, $curlHeader, $partnerID, $postData);


	return $curlResponse;
}

/*
	* Purpose: 	Prepare data to call the PayPal Create Order
	* Inputs:
	*		access_token    : The access token received from PayPal
	* Returns:              Approval URL to redirect the user to
	*/
function buildAndProcessCreateOrderCall($access_token, $postData){


	$curlHeader = array("Content-Type:application/json","Accept:application/json", "Authorization:Bearer ".$access_token, "PayPal-Partner-Attribution-Id:".PARTNER_BN_CODE);
	$curlResponse = callCreateOrder($access_token, $curlHeader, $postData);
	$jsonResponse = $curlResponse['json'];

	$_SESSION['order_id'] = $jsonResponse['id']; //Save the order ID in session
	foreach ($jsonResponse['links'] as $link) {
		if($link['rel'] == 'approval_url'){
			$approval_url = $link['href'];
			return $approval_url;
		}
	}
}

/*
	* Purpose: 	Prepare data to call the Pay for Order API
	* Inputs:
	*		access_token    : The access token received from PayPal
	* Returns:              Pay for Order JSON response
	*/
function buildAndProcessPayForOrderCall($access_token, $orderID, $payForOrderRequestData){

	$curlHeader = array("Content-Type:application/json","Accept:application/json", "Authorization:Bearer ".$access_token, "PayPal-Partner-Attribution-Id:".PARTNER_BN_CODE);
	$curlResponse = callPayForOrder($access_token, $curlHeader, $orderID, $payForOrderRequestData);
	$jsonResponse = $curlResponse['json'];


	return $jsonResponse;
}

/*
	* Purpose: 	Prepare data to call the get order status API.
 	* Gets the Capture ID needed to make Disburse/Refund calls for a Particular Purchase Unit
	* Inputs:
	*		access_token    : The access token received from PayPal
	* Returns:              Capture ID for a purchase unit, if the Capture ID is generated
	*/
function buildAndProcessGetCaptureIDFromPurchaseUnit($access_token, $orderID, $purchaseUnitId){

	if(WEBHOOK_CONFIGURED){
		//Get Capture ID data from WebHook
	} else {
		$curlHeader = array("Content-Type:application/json","Accept:application/json", "Authorization:Bearer ".$access_token, "PayPal-Partner-Attribution-Id:".PARTNER_BN_CODE);
		$curlResponse = callGetOrderStatus($access_token, $curlHeader, $orderID);
		$jsonResponse = $curlResponse['json'];

		if(!isset($jsonResponse['purchase_units'][$purchaseUnitId])){
			echo("Invalid Purchase Unit Id");
		} else if(sizeof($jsonResponse['purchase_units'][$purchaseUnitId]['payment_summary']) == 0){
			echo("Capture ID not yet Generated");
		} else {
			return $jsonResponse['purchase_units'][$purchaseUnitId]['payment_summary']['captures'][0]['id']; //return the Capture ID for the Requested Purchase Unit
		}

	}
}

/*
 * Purpose: Prepare data to call the pay API for payment that was on hold.
 * Inputs:
 *		access_token    : The access token received from PayPal
 * Returns:              Disburse Call status
 */
function buildAndProcessDisburseCall($access_token, $captureID, $disburseRequestData){
	if ($captureID === NULL) {
		return;
	}

	$curlHeader = array("Content-Type:application/json","Accept:application/json", "Authorization:Bearer ".$access_token, "PayPal-Partner-Attribution-Id:".PARTNER_BN_CODE, "Prefer:respond-sync");
	
	//update the request info
	$disburseReqArray = json_decode($disburseRequestData, true);
	$disburseReqArray['reference_id'] = $captureID;
	$disburseRequestData = json_encode($disburseReqArray);
	
	$curlResponse = callDisburse($access_token, $curlHeader, $captureID, $disburseRequestData);
	$jsonResponse = $curlResponse['json'];


	
	$status = $jsonResponse['processing_state']['status'];
	return $status;
}

/*
 * Purpose: Prepare data to call the refund API to refund the payment.
 * Inputs:
 *		access_token    : The access token received from PayPal
 * Returns:              Refund Call state
 */
function buildAndProcessRefundCall($access_token, $captureID, $refundRequestData){

	$paypalAuthAssertionCommonHeader = '{"alg":"none"}';
	$paypalAuthAssertionPayload = '{"iss": "'.PARTNER_CLIENT_ID.'", "payer_id":"'.SELLER_1_PAYER_ID.'"}';
	$paypalAuthAssertionHeader = base64_encode($paypalAuthAssertionCommonHeader).'.'.base64_encode($paypalAuthAssertionPayload).'.';

	$curlHeader = array("Content-Type:application/json","Accept:application/json", "Authorization:Bearer ".$access_token, "PayPal-Partner-Attribution-Id:".PARTNER_BN_CODE, "PayPal-Auth-Assertion:".$paypalAuthAssertionHeader);
	
	//update the request info
	$refundReqArray = json_decode($refundRequestData, true);
	$refundReqArray['amount']['currency'] = "USD";
	$refundReqArray['amount']['total'] = "100";
	$refundRequestData = json_encode($refundReqArray, JSON_FORCE_OBJECT);
	
	$curlResponse = callRefund($access_token, $curlHeader, $captureID, $refundRequestData);
	$jsonResponse = $curlResponse['json'];



	$state = $jsonResponse['state'];
	return $state;
}

?>