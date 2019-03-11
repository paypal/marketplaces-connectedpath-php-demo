<?php
include_once('HttpHelper.php');

class PayPalHelper {

    protected $_http = null;
    protected $_apiUrl = null;
    protected $_token = null;
    protected $_apiVersion = null;

	public function __construct() {
		$this->_http = new HttpHelper;
		$this->_apiUrl = PAYPAL_ENDPOINTS[PAYPAL_ENVIRONMENT];
		$this->_setAPIVersion('1');
	}

	protected function _setDefaultHeaders() {
		$this->_http->addHeader("PayPal-Partner-Attribution-Id: " . SBN_CODE);
        $this->_http->addHeader("Content-Type: application/json");
        if($this->_token !== null) {
            $this->_http->addHeader("Authorization: Bearer " . $this->_token);
        }
	}

    protected function _setAPIVersion($version) {
        if((int)$version === 2) {
            $this->_apiVersion = 'v2';
        }
        else {
            $this->_apiVersion = 'v1';
        }
    }

    protected function _createApiUrl($resource) {
		return $this->_apiUrl . "/" . $this->_apiVersion . "/" . $resource;
	}

    protected function _getToken() {
		$this->_http->resetHelper();
		$this->_setDefaultHeaders();
        $this->_setAPIVersion('1');
		$this->_http->setUrl($this->_createApiUrl("oauth2/token"));
		$this->_http->setAuthentication(PAYPAL_CREDENTIALS[PAYPAL_ENVIRONMENT]['client_id'] . ":" . PAYPAL_CREDENTIALS[PAYPAL_ENVIRONMENT]['client_secret']);
		$this->_http->setBody("grant_type=client_credentials");
		$returnData = $this->_http->sendRequest();
		$this->_token = $returnData['access_token'];	
	}

    protected function _checkToken() {
        if($this->_token === null) {
            $this->_getToken();
        }
    }

    protected function _respond($data) {
        return array(
            "ack" => true,
            "data" => $data
        );
    }
}