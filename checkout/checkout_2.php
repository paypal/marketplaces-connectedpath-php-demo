<?php
                        if (session_id() == "")
                            session_start();

						include_once('../businessLogic/paypalFunctions.php');
                        include_once('../businessLogic/connected6.php');
                        include_once('../businessLogic/connected6Data.php');
                        include('../businessLogic/utilFunctions.php');
                        $access_token = buildAndProcessGetAccessToken();

                        //Make set risk transaction context call for Physical Goods
                        $riskResult = buildAndProcessRiskContextCall($access_token, $riskRequestData);

                        //Call create order API and get Approval URL to redirect the User/Buyer to for getting Buyer's approval for Payment
                        $approval_url = buildAndProcessCreateOrderCall($access_token, $createOrderRequestData);

                        //Get and print EC token from the Approval URL, needed for Checkout.js v4 script to open mini-browser
                        $ec_token= substr($approval_url, strpos($approval_url, 'token=')+6);
                        echo $ec_token;

?>
