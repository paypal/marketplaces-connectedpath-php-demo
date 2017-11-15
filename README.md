# PayPal for Marketplaces Connected Path PHP Demo

## Prerequisites

1. Update `PayConfig.php` with your "Partner credentials", "Seller emails", and "Seller Payer IDs". Reach out to your PayPal account manager or [contact us](https://www.paypal.com/us/webapps/mpp/partner-program/contact-us).
2. Verify that all the files are in place by running and passing the Unit tests (process shown below).

	```
	wget https://phar.phpunit.de/phpunit-5.7.phar 
	(Download a version of PHPunit consisent with your php version)

	mv phpunit-5.7.phar /usr/local/bin/phpunit

	chmod a+x  /usr/local/bin/phpunit

	phpunit --version 

	phpunit Tests/unit_test.php
	```

## Quick Start Demo Deployment Using XAMPP

1. Download PHP server.  Use a server such as [XAMPP](https://www.apachefriends.org/index.html) to be able to host the demo code sample.
2. Browse to the `htdocs` directory of XAMPP. Unzip the downloaded demo code folder and place it in this `htdocs` directory.
3. Start the Apache server in XAMPP from the XAMPP control panel.
4. Open the website in the browser and access it as: `http://<your_domain>/<php_code_folder_name>/index.php`
   Here, `your_domain` will be localhost if hosting on your local machine.
   The `php_code_folder_name` is the name of the folder under which the downloaded code resides.
5. Read further instructions when `index.php` in opened in a browser.

## How the code works

The starting point is `index.php`.

## License

Code released under [LICENSE](LICENSE.md).
