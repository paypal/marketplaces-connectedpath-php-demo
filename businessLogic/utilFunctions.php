<?php
/*
	* Contains common useful functions
	* Purpose: 	To make a cURL call to REST API
	* Inputs:
	*		curlServiceUrl    : the service URL for the REST api
	*       curlHeader        : the header parameters specific to the REST api call
	*       curlPostData      : the post parameters encoded in the form required by the api (json_encode or http_build_query)
	* Returns:
	*		array["http_code"]   : the http status code
	*		array["json"]       : the response string
	*/
function curlCall($curlServiceUrl, $curlHeader, $curlPostData) {
	// response container
	$resp = array(
		"http_code" => 0,
		"json"     => ""
	);
	//set the cURL parameters
	$ch = curl_init($curlServiceUrl);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	//turning off the server and peer verification(TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_SSLVERSION , 'CURL_SSLVERSION_TLSv1_2');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	//curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeader);
	if(!is_null($curlPostData)) {
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPostData);
	}
	//getting response from server
	$response = curl_exec($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch); // close cURL handler

	// some kind of an error happened
	if (empty($response)) {
		return $resp;
	}

	$resp["http_code"] = $http_code;
	$resp["json"] = json_decode($response, true);
	return $resp;
}

/**
 * Prevents Cross-Site Scripting Forgery
 * @return boolean
 */
function verify_nonce() {
	if( isset($_GET['csrf']) && $_GET['csrf'] == $_SESSION['csrf'] ) {
		return true;
	}
	if( isset($_POST['csrf']) && $_POST['csrf'] == $_SESSION['csrf'] ) {
		return true;
	}
	return false;
}


/**
 * To generate seller email addresses with a random component for new seller onboarding
 */
function generateEmailAddress(){
	$uniqueId= time().'-'.mt_rand();
	return "dp_codeSampleSeller_".$uniqueId."@paypal.com";
}
?>