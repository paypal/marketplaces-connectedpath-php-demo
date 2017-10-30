<?php

require_once('paypalConfig.php');

//Integrated Sign Up Partner Referral Request Data
$isuRequestData =
    '{
        "customer_data":{
            "customer_type":"MERCHANT",
            "person_details":{
                "email_address":"sellerEmailToBeUpdated@paypal.com",
                "name":{
                    "prefix":"Mr.",
                    "given_name":"Demo Portal",
                    "surname":"Seller",
                    "middle_name":""
                },
                "phone_contacts":[
                    {
                        "phone_number_details":{
                            "country_code":"1",
                            "national_number":"4089671000"
                        },
                        "phone_type":"HOME"
                    }
                ],
                "home_address":{
                    "line1":"2211 North First Street",
                    "state":"CA",
                    "city":"San Jose",
                    "country_code":"US",
                    "postal_code":"95131"
                },
                "date_of_birth":{
                    "event_type":"BIRTH",
                    "event_date":"1987-12-29T23:59:59.999Z"
                },
                "nationality_country_code":"US",
                "identity_documents":[
                    {
                        "type":"SOCIAL_SECURITY_NUMBER",
                        "value":"ABCDEF34646",
                        "partial_value":false,
                        "issuer_country_code":"US"
                    }
                ]
            },
            "business_details":{
                "phone_contacts":[
                    {
                        "phone_number_details":{
                            "country_code":"1",
                            "national_number":"4089671000"
                        },
                        "phone_type":"FAX"
                    }
                ],
                "business_address":{
                    "line1":"2211 North First Street",
                    "state":"CA",
                    "city":"San Jose",
                    "country_code":"US",
                    "postal_code":"95131"
                },
                "business_type":"INDIVIDUAL",
                "category":"1004",
                "sub_category":"2025",
                "names":[
                    {
                        "type":"LEGAL",
                        "name":"Demo Portal Seller Test Store"
                    }
                ],
                "business_description":"Business for selling Physical Goods",
                "event_dates":[
                    {
                        "event_type":"ESTABLISHED",
                        "event_date":"2009-01-31T13:59:45Z"
                    }
                ],
                "website_urls":[
                    "https://example.com"
                ],
                "annual_sales_volume_range":{
                    "minimum_amount":{
                        "currency":"USD",
                        "value":"2000"
                    },
                    "maximum_amount":{
                        "currency":"USD",
                        "value":"300"
                    }
                },
                "average_monthly_volume_range":{
                    "minimum_amount":{
                        "currency":"USD",
                        "value":200
                    },
                    "maximum_amount":{
                        "currency":"USD",
                        "value":300
                    }
                },
                "identity_documents":[
                    {
                        "type":"TAX_IDENTIFICATION_NUMBER",
                        "value":"ABCDEF34646",
                        "partial_value":false,
                        "issuer_country_code":"US"
                    }
                ],
                "email_contacts":[
                    {
                        "email_address":"customercare@paypal.com",
                        "role":"CUSTOMER_SERVICE"
                    }
                ]
            },
            "preferred_language_code":"en_US",
            "primary_currency_code":"USD",
            "referral_user_payer_id":{
                "type":"PAYER_ID",
                "value":"'.PARTNER_ID.'"
            },
            "partner_specific_identifiers":[
                {
                    "type":"TRACKING_ID",
                    "value":"DEMOPORTAL"
                }
            ]
        },
        "requested_capabilities":[
            {
                "capability":"API_INTEGRATION",
                "api_integration_preference":{
                    "rest_api_integration":{
                        "integration_method":"PAYPAL",
                        "integration_type":"THIRD_PARTY"
                    },
                    "rest_third_party_details":{
                        "partner_client_id":"'.PARTNER_CLIENT_ID.'",
                        "feature_list":[
                            "PAYMENT",
                            "REFUND",
                            "SWEEP_FUNDS_EXTERNAL_SINK",
                            "PARTNER_FEE",
                            "DELAY_FUNDS_DISBURSEMENT"
                        ]
                    },
                    "partner_id":"'.PARTNER_ID.'"
                }
            }
        ],
        "web_experience_preference":{
            "partner_logo_url":"https://demo.paypal.com/demo/img/merchants/partner/PartnerPlace/2x/logo_partnerplace_color@2x.png?locale.x=en_US",
            "return_url":"'.ISU_RETURN_URL.'",
            "action_renewal_url":"'.ISU_ACTION_RENEWAL_URL.'"
        },
        "collected_consents":[
            {
                "type":"SHARE_DATA_CONSENT",
                "granted":true
            }
        ],
        "products":[
            "EXPRESS_CHECKOUT"
        ]
    }';

//Set Risk Transaction Context Request Data
$riskRequestData =
    '{
        "additional_data":[
            {
                "key":"sender_account_id",
                "value":"'.SELLER_1_EMAIL.'"
            },
            {
                "key":"sender_first_name",
                "value":"'.SELLER_1_EMAIL.'"
            },
            {
                "key":"sender_last_name",
                "value":"'.SELLER_1_EMAIL.'"
            },
            {
                "key":"sender_create_date",
                "value":"2016-08-29T03: 42: 34Z"
            },
            {
                "key":"seller_account_id",
                "value":"'.SELLER_1_EMAIL.'"
            },
            {
                "key":"seller_create_date",
                "value":"2016-08-29T03: 42: 34Z"
            },
            {
                "key":"transaction_is_tangible",
                "value":"TRUE"
            }
        ]
    }';

//Create Order Request Data
$createOrderRequestData =
    '{
        "purchase_units":[
            {
                "reference_id":"pu1_forward fashions",
                "description":"Fashion goods from the Watch Shop",
                "amount":{
                    "currency":"USD",
                    "details":{
                        "subtotal":"100.00",
                        "shipping":"0.00",
                        "tax":"0.00"
                    },
                    "total":"100.00"
                },
                "payee":{
                    "email":"'.SELLER_1_EMAIL.'"
                },
                "items":[
                    {
                        "name":"Studded Watch",
                        "sku":"sku01",
                        "price":"100.00",
                        "currency":"USD",
                        "quantity":1,
                        "category":"PHYSICAL",
                        "supplementary_data":[

                        ],
                        "postback_data":[

                        ],
                        "item_option_selections":[

                        ]
                    }
                ],
                "shipping_address":{
                    "recipient_name":"John Doe",
                    "default_address":false,
                    "preferred_address":false,
                    "primary_address":false,
                    "disable_for_transaction":false,
                    "line1":"2211 N First Street",
                    "line2":"Building 17",
                    "city":"San Jose",
                    "country_code":"US",
                    "postal_code":"95131",
                    "state":"CA",
                    "phone":"(123) 456-7890"
                },
                "shipping_method":"United Postal Service",
                "partner_fee_details":{
                    "receiver":{
                        "email":"'.PARTNER_EMAIL.'"
                    },
                    "amount":{
                        "value":"5.00",
                        "currency":"USD"
                    }
                },
                "payment_linked_group":1,
                "custom":"custom_2548",
                "invoice_number":"invoice_2548",
                "payment_descriptor":"DemoPortal"
            },
            {
                "reference_id":"pu2_mobile world",
                "description":"Physical goods from the Camera Shop",
                "amount":{
                    "currency":"USD",
                    "details":{
                        "subtotal":"300.00",
                        "shipping":"0.00",
                        "tax":"0.00"
                    },
                    "total":"300.00"
                },
                "payee":{
                    "email":"'.SELLER_2_EMAIL.'"
                },
                "items":[
                    {
                        "name":"DSLR Camera",
                        "sku":"sku03",
                        "price":"300.00",
                        "currency":"USD",
                        "quantity":1,
                        "category":"PHYSICAL",
                        "supplementary_data":[

                        ],
                        "postback_data":[

                        ],
                        "item_option_selections":[

                        ]
                    }
                ],
                "shipping_address":{
                    "recipient_name":"John Doe",
                    "default_address":false,
                    "preferred_address":false,
                    "primary_address":false,
                    "disable_for_transaction":false,
                    "line1":"2211 N First Street",
                    "line2":"Building 17",
                    "city":"San Jose",
                    "country_code":"US",
                    "postal_code":"95131",
                    "state":"CA",
                    "phone":"(123) 456-7890"
                },
                "shipping_method":"United Postal Service",
                "partner_fee_details":{
                    "receiver":{
                        "email":"'.PARTNER_EMAIL.'"
                    },
                    "amount":{
                        "value":"25.00",
                        "currency":"USD"
                    }
                },
                "payment_linked_group":1,
                "custom":"custom_2548",
                "invoice_number":"custom_2548",
                "payment_descriptor":"DemoPortal"
            }
        ],
        "metadata":{
            "supplementary_data":[

            ],
            "postback_data":[

            ]
        },
        "redirect_urls":{
            "return_url":"'.CHECKOUT_RETURN_URL.'",
            "cancel_url":"'.CHECKOUT_START_URL.'"
        },
        "links":[

        ]
    }';

//Pay for Order Request Data
$payForOrderRequestData =
    '{
        "disbursement_mode": "DELAYED"
    }';

//Disburse Request Data
$disburseRequestData =
    '{
        "reference_id":"<capture-id>",
        "reference_type":"TRANSACTION_ID"
    }';

//Refund Request Data
$refundRequestData =
    '{
        "amount":{
            "currency":"<currency>",
            "details":{
            },
            "total":"<total>"
        },
        "invoice_number":"invoice_2548",
        "custom":"custom_2548"
    }';


?>