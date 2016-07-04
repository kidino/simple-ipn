<?php

$debug = 1;  // to enable debug mode. debug mode will dump IPN data and transaction
             // results on the thank you page. It will also create a submit button
             // instead of auto-redirect for Paypal Buy Button.
             
$paypal_sandbox = 1;  // 1 for test more, 0 for production mode
$expire_in_hours = 72;  // how many hours before download expires, in hours
$paypal_email_address = 'business@kengkawan.com';  // your paypal email address
$support_email_address = 'dino@iszuddinismail.com';   // your email address for support
$support_email_name = 'You - YourDomain.com';   // name to appear in the From when email is sent

$get_shipping_address = 1;   // whether to get or not shipping address
                             // 1 - Yes, MUST enter shipping address
                             // 0 - No, shipping address field removed
                             // 2 - Optional, shipping address is optional

$product_name = 'Sample Product';   // Product name, will appear in Paypal
$product_code = 'SPL101';   // Code, will appear in Paypal
$product_price = '19.95';   // product price, will appear in Paypal
$price_currency = 'USD';    // currency, Paypal only supports
                            // AUD CAD EUR GBP JPY USD NZD CHF HKD
                            // SGD SEK DKK PLN NOK HUF CZK ILS MXN
 
$product_files = array(); // do not change

$product_files[] = array( // DEFINE YOUR PRODUCT
		'name'     => 'Sample Audio MP3', // normal name of the file
		'filename' => 'audio-lesson.mp3', // filename the customer will gets
		'source'   => 'sample.mp3'        // actual location of the file
                                                  // does not need to be the same filename
                                                  // location can elsewhere too like:
                                                  // 'source'   => '../../store/sample.mp3'
	);

$product_files[] = array( // DEFINE ANOTHER PRODUCT
		'name'     => 'Sample PDF eBook',
		'filename' => 'workbook.pdf',
		'source'   => 'sample.pdf'
	);

$email_subject = 'Your Purchase: {PRODUCT NAME} ({PRODUCT CODE})'; // subject line for your email

// email body. you cannot have anything, even blank spaces after EOT

$email_body = <<<EOT
Dear {CUSTOMER NAME},

Thank you for purchasing {PRODUCT NAME}.

Below is the URL to your download page. You have
approximately {X} hours to download your purchase, in which
after that period the download page will be expired.

Download for {PRODUCT NAME} ({PRODUCT CODE})
{DOWNLOAD PAGE}

If the URL above is not clickable, just copy and paste the
URL into your browser.

Should you need any assistance, just reply to this email.


Your Name
Your Company

EOT;

// ALL DONE!!
?>