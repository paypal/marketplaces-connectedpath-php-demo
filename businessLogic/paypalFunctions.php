<?php
/********************************************
	Module contains calls to PayPal APIs
	********************************************/
	include_once('paypalConfig.php');
/*
	* Purpose: 	Gets the access token from PayPal
	* Inputs:
	* Returns:  access token
	*
	*/
function getAccessToken($curlHeader, $postData){
	$curlServiceUrl = (SANDBOX_FLAG ? SANDBOX_ENDPOINT : LIVE_ENDPOINT);
	$curlServiceUrl = $curlServiceUrl. "/v1/oauth2/token";
	$curlPostData = http_build_query($postData);
	$curlResponse = curlCall($curlServiceUrl, $curlHeader, $curlPostData);
	return $curlResponse;
}

/*
	* Purpose: 	Call the prefill API and get the PayPal action URL to redirect the user to.
	* Inputs:
	*		access_token    : The access token received from PayPal
	* Returns:              curlResponse
	*/
function callISUFlow($access_token, $curlHeader, $postData){

	$curlServiceUrl = (SANDBOX_FLAG ? SANDBOX_ENDPOINT : LIVE_ENDPOINT);
	$curlServiceUrl = $curlServiceUrl. "/v1/customer/partner-referrals";

	$curlResponse = curlCall($curlServiceUrl, $curlHeader, $postData);


	return $curlResponse;
}

/*
	* Purpose: 	Call the PayPal risk transaction context API for Physical Goods.
	* Inputs:
	*		access_token    : The access token received from PayPal
	* Returns:              curlResponse
	*/
function callRiskTransactionContext($access_token, $curlHeader, $partnerID, $postData){

	$curlServiceUrl = (SANDBOX_FLAG ? SANDBOX_ENDPOINT : LIVE_ENDPOINT);
	$curlServiceUrl = $curlServiceUrl. "/v1/risk/transaction-contexts/".$partnerID."/code_sample_12345";

	$curlResponse = curlCall($curlServiceUrl, $curlHeader, $postData);


	return $curlResponse;
}

/*
	* Purpose: 	Call the PayPal create order API.
	* Inputs:
	*		access_token    : The access token received from PayPal
	* Returns:              Create Order curlResponse
	*/
function callCreateOrder($access_token, $curlHeader, $postData){

	$curlServiceUrl = (SANDBOX_FLAG ? SANDBOX_ENDPOINT : LIVE_ENDPOINT);
	$curlServiceUrl = $curlServiceUrl. "/v1/checkout/orders";

	$curlResponse = curlCall($curlServiceUrl, $curlHeader, $postData);


	return $curlResponse;
}

/*
	* Purpose: Call pay for order API
	* Inputs:
	*		access_token    : The access token received from PayPal
	* Returns:              Payment curlResponse
	*/
function callPayForOrder($access_token, $curlHeader, $orderID, $postData){

	$curlServiceUrl = (SANDBOX_FLAG ? SANDBOX_ENDPOINT : LIVE_ENDPOINT);

	$curlServiceUrl = $curlServiceUrl. "/v1/checkout/orders/".$orderID."/pay";
	$curlResponse = curlCall($curlServiceUrl, $curlHeader, $postData);


	return $curlResponse;

}

/*
	* Purpose: 	Call the PayPal get order status API.
	* Inputs:
	*		access_token    : The access token received from PayPal
	* Returns:              Order Details curlResponse
	*/
function callGetOrderStatus($access_token, $curlHeader, $orderID){

	$curlServiceUrl = (SANDBOX_FLAG ? SANDBOX_ENDPOINT : LIVE_ENDPOINT);

	$curlServiceUrl = $curlServiceUrl. "/v1/checkout/orders/".$orderID;
	$curlResponse = curlCall($curlServiceUrl, $curlHeader, NULL);


	return $curlResponse;

}

/*
	* Purpose: 	Call the PayPal disburse API for the payment that was on hold.
	* Inputs:
	*		access_token    : The access token received from PayPal
	* Returns:              Disburse curlResponse
	*/
function callDisburse($access_token, $curlHeader, $orderID, $postData){

	$curlServiceUrl = (SANDBOX_FLAG ? SANDBOX_ENDPOINT : LIVE_ENDPOINT);

	$curlServiceUrl = $curlServiceUrl. "/v1/payments/referenced-payouts-items";
	$curlResponse = curlCall($curlServiceUrl, $curlHeader, $postData);


	return $curlResponse;

}

/*
	* Purpose: 	Call the PayPal refund API to refund the payment.
	* Inputs:
	*		access_token    : The access token received from PayPal
	* Returns:              Refund curlResponse
	*/
function callRefund($access_token, $curlHeader, $captureID, $postData){

	$curlServiceUrl = (SANDBOX_FLAG ? SANDBOX_ENDPOINT : LIVE_ENDPOINT);

	$curlServiceUrl = $curlServiceUrl. "/v1/payments/capture/".$captureID."/refund";
	$curlResponse = curlCall($curlServiceUrl, $curlHeader, $postData);


	return $curlResponse;

}

?>