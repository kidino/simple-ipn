<?php

$debug = 1;  // to enable debug mode. debug mode will dump IPN data and transaction
             // results on the thank you page. It will also create a submit button
             // instead of auto-redirect for Paypal Buy Button.
             
$paypal_sandbox = 1;  // 1 for test more, 0 for production mode
$expire_in_hours = 72;  // how many hours before download expires, in hours
$paypal_email_address = 'paypal@domain.com';  // your paypal email address
$support_email_address = 'support@domain.com';   // your email address for support
$support_email_name = 'My Website';   // name to appear in the From when email is sent

$get_shipping_address = 1;   // whether to get or not shipping address
                             // 1 - Yes, MUST enter shipping address
                             // 0 - No, shipping address field removed
                             // 2 - Optional, shipping address is optional

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