<h3>Readme</h3>

<br />
<b>Important:</b> PayPal for Marketplaces is a limited-release solution at this time. It is available to select partners for approved use cases. For more information, reach out to your PayPal account manager or <a href="https://www.paypal.com/us/webapps/mpp/partner-program/contact-us" target="_blank">contact us</a>.
<br/><br/>

<h4>Getting Started</h4>
This code sample serves as a reference for PayPal for Marketplaces APIs. You will need your own PayPal Sandbox Partner credentials to run the code sample.
Once you have your Partner credentials, refer to the steps below:
<br />
<br />


<h4>Sandbox Buyer Accounts</h4>

The following Sandbox Buyer Accounts are provided for convenience. Use these for testing the buyer's flow. DO NOT USE the merchant/seller's account just created in onboarding.

<br />
<br />

<div style="padding-left: 40px;"> 
	<table class="table table-striped" style="width: 260px;">
		<tr>
			<th>Email</th>
			<th>Password</th>
		</tr>
		<tr>
			<td>jack_potter@buyer.com</td>
			<td>123456789</td>
		</tr>
		<tr>
			<td>jen_jones@buyer.com</td>
			<td>qwer1234</td>
		</tr>
	   	<tr>
			<td>jack_chase@buyer.com</td>
			<td>qwer1234</td>
		</tr>							
	</table>
</div>

<br />

<h4>Code Sample Demonstration</h4>

<br/>

<strong><u>Connected Path</u></strong>: <br/>
A marketplace model in which each individual merchant must have a PayPal account.

<br/>
<br/>

<ol>
	<li>To run the code sample, first enter your own Partner credentials in paypalConfig.php
		<ul>
			<li>Update PARTNER_ID with your Partner Payer ID.</li>
			<li>Update PARTNER_BN_CODE with your PayPal Partner Attribution ID.</li>
			<li>Update PARTNER_CLIENT_ID with the Partner REST App Client Id and PARTNER_CLIENT_SECRET with the corresponding Client Secret.</li>
			<li>Update PARTNER_EMAIL with your Partner Account Email.</li>

		</ul>
	</li>
		<li> Verify that you have everything set up correctly by running PhP unit tests:
    		<ul>
    			<li> wget https://phar.phpunit.de/phpunit-5.7.phar (To get PHPUnit 5.7)    			</li>
    			<li>  mv phpunit-5.7.phar /usr/local/bin/phpunit    			</li>
                <li> chmod a+x  /usr/local/bin/phpunit
				<li>  phpunit --version (should return "PHPUnit 5.7.23 by Sebastian Bergmann and contributors.")</li>
				<li>   phpunit Tests/unit_test.php </li>

    		</ul>
    	</li>
	<li>Click on the "Onboarding" link in the "Connected Path" section of the web page.<br/>
		This step will show you the merchant onboarding experience for the Connected Path, with most form field values pre-filled already.
		<ul>
			<li>Click the "Call Prefill API" button.(Refer to the isu_2.php file for the API calls.)</li>
			<li>Click the "Enable PayPal" link to start the merchant's onboarding experience.</li>
			<li>It will open a mini-browser to start the merchant's onboarding experience. (Refer to isu_2.php to understand the script needed for the mini-browser/in-context experience.)</li>
			<li>Enter values for the blank entries like password, last four digits of SSN etc. For personal information, please use dummy information while running the demo.</li>
			<li>Once the flow is completed, you will see a success screen in the mini-browser. It will show the email-address of the onboarded seller. <br/>Please note down this email address. You will need this in the Checkout flow of the Order API request.
				<br/>Note: You may onboard a seller with a specific email address by changing the "email_address" parameter in the Onboarding request call.</li>
			<li>Follow the above processs to onboard one more seller.</li>
		</ul>
	</li>
	<li>Confirm the Seller Sandbox Emails for the Onboarded sellers. And update the seller emails in paypalConfig.php as follows:
		<ul>
			<li>Update SELLER_1_EMAIL and SELLER_2_EMAIL with emails for two sellers onboarded using Onboarding flow (noted from the previous step).</li>
			<li>Update SELLER_1_PAYER_ID and SELLER_2_PAYER_ID with the Payer IDs for the seller accounts. You can find the Payer id as the "Merchant account ID" found in <a href="https://www.sandbox.paypal.com/businessprofile/settings/" target="_blank">Sandbox account business profile page</a>.</li>
			<li>You can now try an Order call by purchasing items from these two sellers in the Checkout flow explained below.</li>
		</ul>
	</li>
	<li>Click the "Checkout" box in the "Connected Path Overview" section of the web page.
		<ul>
			<li>Click on the Yellow "PayPal Checkout" button. (Refer the checkout_1.php file for Checkout.js v4 script to render the Checkout button. <br/>Refer to checkout_2.php for the setting risk transaction context and create order API calls.)</li>
			<li>It will open a mini-browser with a login screen.</li>
			<li>Use the sample Sandbox Buyer accounts provided on index.php page or create new buyer Sandbox accounts  <a href="https://developer.paypal.com/developer/accounts/create" target="_blank">here</a>.</li>
			<li>On the Login page, enter Sandbox Buyer credentials and click the "Login" button.</li>
			<li>On the next page, click  "Pay Now" button. (Refer to checkout_3.php for the pay for order API call.)</li>
			<li>You will now land on the Order Confirmation page of the code sample.</li>
			<li>Now, the "Disburse" option box will be enabled on the right side of the web page.</li>
		</ul>
	</li>
	<li>Once Checkout is complete, you can run Disburse and/or the Refund flows. Click the 'Disburse' box in the "Connected Path Overview" section of the web page.
		<ul>
			<li>Once on the page, click the "Call Disburse API" button. (Refer to disburse_2.php for the pay for the get order status and disburse API calls.)</li>
			<li>A disburse completion page will be displayed after calling the Disburse API.</li>
			<li>Note: If you see the message "Capture ID is not yet generated", wait a few moments and then refresh the page. The Capture ID for a purchase unit could take a few moments to get generated.</li>
		</ul>
	</li>
	<li>Once you've tried the Disburse flow, the "Refund" flow is available to try next. Click on the "Refund" box in the "Connected Path Overview" section of the web page.
		<ul>
			<li>Once on the page, click the "Call Refund API" button. (Refer to refund_2.php for the pay for the get order status and refund API calls.)</li>
			<li>A refund completion page will be displayed after calling the Refund API.</li>
			<li>Note: If you see the message "Capture ID is not yet generated",wait a few moments and then refresh the page. The Capture ID for a purchase unit could take a few moments to get generated.</li>
		</ul>
	</li>
	<li>You can click the "Return Home" link at any time to go back to the code sample homepage.
	</li>

</ol>
*Note: The connected6Data.php has the data needed for the API calls and connected6.php has the functions to call APIs.
<br/><br/>


<!--<ol>
	<li>Describe step 1.
		<ul>
			<li>Describe sub-step.</li>
			<li>Describe sub-step.</li>

		</ul>
	</li>
	<li>Describe step 2.</li>
</ol>-->

<br />


<h4>Documentation</h4>

PayPal for Marketplaces: <a href="https://developer.paypal.com/docs/marketplaces/pp4mp/" target="_blank">https://developer.paypal.com/docs/marketplaces/pp4mp/</a>

<br />
<br />

<br />


