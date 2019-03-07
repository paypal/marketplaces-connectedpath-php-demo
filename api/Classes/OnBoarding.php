<?php
include_once('Helpers/PayPalHelper.php');

class ConnectedOnBoarding extends PayPalHelper {

    private function _createReferral($postData) {
        $this->_checkToken();
        $this->_http->resetHelper();
        $this->_setDefaultHeaders();
        $this->_setAPIVersion('1');
        $this->_http->setUrl($this->_createApiUrl("customer/partner-referrals"));
        $this->_http->setBody($postData);
        return $this->_respond($this->_http->sendRequest());
    }

    public function create($postData) {
        return $this->_createReferral($postData);
    }
}