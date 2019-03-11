<?php

abstract class DataFactory {

    private static function _getPrefillMerchant() {
        $timestamp = time();
        $email = str_replace('@','_' . $timestamp . '@', MARKETPLACE['seller']['template']);
        return array (
            'customer_type' => 'MERCHANT',
            'person_details' => array (
                'email_address' => $email,
                'date_of_birth' =>
                    array (
                        'event_type' => 'BIRTH',
                        'event_date' => '1986-2-3T23:59:59.999Z'
                    ),
                'nationality_country_code' => 'US',
                'name' =>
                    array (
                        'given_name' => 'John',
                        'surname' => 'Doe'
                    ),
            ),
            'business_details' => array (
                'phone_contacts' => array (
                    array (
                        'phone_number_details' => array (
                            'country_code' => '1',
                            'national_number' => '1111111111'
                        ),
                        'phone_type' => 'FAX'
                    ),
                ),
                'business_address' => array (
                    'line1' => '9999 N 90th Street',
                    'state' => 'AZ',
                    'city' => 'Scottsdale',
                    'country_code' => 'US',
                    'postal_code' => '85258'
                ),
                'business_type' => 'INDIVIDUAL',
                'category' => '1008',
                'sub_category' => '2076',
                'names' => array (
                    array (
                        'type' => 'LEGAL',
                        'name' => 'Legal Business Name'
                    )
                ),
                'business_description' => 'Sample pre-fill merchant for PayPal Marketplace Demo',
                'event_dates' => array (
                    array (
                        'event_type' => 'ESTABLISHED',
                        'event_date' => '2009-01-01T13:59:45Z'
                    )
                ),
                'website_urls' => array (
                    'https://paypal.com'
                ),
                'annual_sales_volume_range' => array (
                    'minimum_amount' => array (
                        'currency' => 'USD',
                        'value' => '60000'
                    ),
                    'maximum_amount' => array (
                        'currency' => 'USD',
                        'value' => '300000'
                    )
                ),
                'average_monthly_volume_range' => array (
                    'minimum_amount' => array (
                        'currency' => 'USD',
                        'value' => '5000'
                    ),
                    'maximum_amount' => array (
                        'currency' => 'USD',
                        'value' => '24999'
                    )
                ),
                'email_contacts' => array (
                    array (
                        'email_address' => 'omkar_mp_seller@us.com',
                        'role' => 'CUSTOMER_SERVICE'
                    )
                )
            ),
            'preferred_language_code' => 'en_US',
            'primary_currency_code' => 'USD',
            'partner_specific_identifiers' => array (
                array (
                    'type' => 'TRACKING_ID',
                    'value' => base64_encode($email),
                )
            )
        );
    }

    private static function _getNewMerchant() {
        $timestamp = time();
        return array (
            'partner_specific_identifiers' => array (
                array (
                    'type' => 'TRACKING_ID',
                    'value' => $timestamp,
                ),
            )
        );
    }

    private static function _getRequestedCapabilities() {
        return array (
            array (
                'capability' => 'API_INTEGRATION',
                'api_integration_preference' => array (
                    'partner_id' => MARKETPLACE['partner_id'],
                    'rest_api_integration' => array (
                        'integration_method' => 'PAYPAL',
                        'integration_type' => 'THIRD_PARTY'
                    ),
                    'rest_third_party_details' => array (
                        'partner_client_id' => PAYPAL_CREDENTIALS[PAYPAL_ENVIRONMENT]['client_id'],
                        'feature_list' => array (
                            'PAYMENT',
                            'REFUND',
                            'PARTNER_FEE',
                            'DELAY_FUNDS_DISBURSEMENT'
                        ),
                    )
                )
            )
        );
    }

    private static function _getWebExperiencePreference() {
        return array (
            'partner_logo_url' => 'http://leiphone.qiniudn.com/uploads/2014/05/Paypal.jpg',
            'return_url' => '',
            'action_renewal_url' => ''
        );
    }

    private static function _getCollectedConsents() {
        return array (
            array (
                'type' => 'SHARE_DATA_CONSENT',
                'granted' => true,
            )
        );
    }

    private static function _getProducts() {
        return array(
            'EXPRESS_CHECKOUT'
        );
    }

    public static function PartnerReferral($type) {
        $customerData = null;
        if($type === 'prefill') {
            $customerData = self::_getPrefillMerchant();
        }
        else if($type === 'new') {
            $customerData = self::_getNewMerchant();
        }
        return array(
            'customer_data' => $customerData,
            'requested_capabilities' => self::_getRequestedCapabilities(),
            'web_experience_preference' => self::_getWebExperiencePreference(),
            'collected_consents' => self::_getCollectedConsents(),
            'products' => self::_getProducts()
        );
    }

    public static function OrderDetails() {
        $merchantID = MARKETPLACE['seller']['id'];
        $sellerEmail = MARKETPLACE['seller']['email'];
        $timestamp = time();
        return array (
            'intent' => 'CAPTURE',
            'purchase_units' =>
                array (
                    0 =>
                        array (
                            'reference_id' => 'PU-'.$timestamp,
                            'description' => 'Camera Shop',
                            'amount' =>
                                array (
                                    'currency_code' => 'USD',
                                    'value' => '320.00',
                                    'breakdown' =>
                                        array (
                                            'item_total' =>
                                                array (
                                                    'currency_code' => 'USD',
                                                    'value' => '300.00',
                                                ),
                                            'shipping' =>
                                                array (
                                                    'currency_code' => 'USD',
                                                    'value' => '2',
                                                ),
                                            'handling' =>
                                                array (
                                                    'currency_code' => 'USD',
                                                    'value' => '5',
                                                ),
                                            'tax_total' =>
                                                array (
                                                    'currency_code' => 'USD',
                                                    'value' => '5',
                                                ),
                                            'insurance' =>
                                                array (
                                                    'currency_code' => 'USD',
                                                    'value' => '10',
                                                ),
                                            'shipping_discount' =>
                                                array (
                                                    'currency_code' => 'USD',
                                                    'value' => '2',
                                                ),
                                        ),
                                ),
                            'payee' =>
                                array (
                                    'merchant_id' => $merchantID,
                                    'email_address' => $sellerEmail,
                                ),
                            'items' =>
                                array (
                                    0 =>
                                        array (
                                            'name' => 'DSLR Camera',
                                            'sku' => '5158936',
                                            'description' => 'DSLR Camera, Auto-focus, A0123',
                                            'unit_amount' =>
                                                array (
                                                    'currency_code' => 'USD',
                                                    'value' => '300.00',
                                                ),
                                            'tax' =>
                                                array (
                                                    'currency_code' => 'USD',
                                                    'value' => '5.00',
                                                ),
                                            'quantity' => '1',
                                            'category' => 'PHYSICAL_GOODS',
                                        ),
                                ),
                            'shipping_method' => 'United Postal Service',
                            'payment_instruction' =>
                                array (
                                    'disbursement_mode' => 'DELAYED',
                                    'platform_fees' =>
                                        array (
                                            0 =>
                                                array (
                                                    'amount' =>
                                                        array (
                                                            'currency_code' => 'USD',
                                                            'value' => '2.00',
                                                        )
                                                ),
                                        ),
                                ),
                            'payment_group_id' => 1,
                            'custom_id' => 'custom_value_' . $timestamp,
                            'invoice_id' => 'invoice_number_' . $timestamp,
                            'soft_descriptor' => 'Payment Camera Shop',
                        ),
                ),
            'application_context' =>
                array (
                    'return_url' => '',
                    'cancel_url' => '',
                ),
        );
    }

    public static function PayPalAuthAssertion() {
        $temp = array(
            "alg" => "none"
        );
        $returnData = base64_encode(json_encode($temp)) . '.';
        $temp = array(
            "iss" => PAYPAL_CREDENTIALS[PAYPAL_ENVIRONMENT]['client_id'],
            "payer_id" => MARKETPLACE['seller']['id']
        );
        $returnData .= base64_encode(json_encode($temp)) . '.';
        return $returnData;
    }

}