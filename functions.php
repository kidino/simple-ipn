<?php
function download_is_expired($expire_time) {
    $today = time();
    if ($expire_time > $today) { return false; }
    else { return true; }
}

function display_products($products, $customer_info, $list_style=1, $expired_message) {
	$txn_id = $customer_info['txn_id'];
	if (download_is_expired($customer_info['expire_date']))
	{
	    if ($expired_message != '') { $download_list = "<p id='expired'>$expired_message</p>"; }
	    else { $download_list = "<p id='expired'>Your download has expired</p>"; }
	}
	else
	{
		$download_list = "<ul id='dlist'>\n";
	        foreach($products as $id => $product)
	        {
			if ($list_style == 1) { $download_list .= "<li>$product[name] <small>[ <a href='dl.php?id=$txn_id&file=$id'>DOWNLOAD</a> ]</small></li>\n"; }
			else  { $download_list .= "<li><a href='dl.php?id=$txn_id&file=$id'>$product[name]</a></li>\n"; }
		}
		$download_list .= "</ul>";
	}
	return $download_list;
}
	
function create_download_file($file_data) {
$file_content = "<?php\n";
$file_content .= "\$customer_info = array(\n";
$file_content .= "	'txn_id'         => '$file_data[txn_id]',\n";
$file_content .= "	'customer_name'  => '".addslashes($file_data['customer_name'])."',\n";
$file_content .= "	'business_name'  => '".addslashes($file_data['business_name'])."',\n";
$file_content .= "	'customer_email' => '$file_data[customer_email]',\n";
$file_content .= "	'purchase_amount'  => $file_data[purchase_amount],\n";
$file_content .= "	'purchase_date'  => '$file_data[purchase_date]',\n";
$file_content .= "	'download_page_url'  => '$file_data[download_page_url]',\n";
$file_content .= "	'expire_date'    => $file_data[expire_date],\n";
$file_content .= "	'expire_time'    => $file_data[expire_time],\n";
$file_content .= "	'product_name'    => '".addslashes($file_data['product_name'])."'\n";
$file_content .= ");\n\n";

$file_content .= "\$customer_info['time_left'] = sprintf(\"%.2f\",(\$customer_info['expire_date'] - time()) / 3600);\n\n";

$file_content .= "\$this_file = \$_SERVER['SCRIPT_NAME'];\n";
$file_content .= "\$parts = explode('/', \$this_file);\n";
$file_content .= "\$this_file = \$parts[count(\$parts) - 1];\n\n";

$file_content .= "\$this_file2 = \$customer_info['txn_id'].'.php';\n";

$file_content .= "if ((\$this_file == \$this_file2) && (\$_SERVER['QUERY_STRING']) == 'show')\n";
$file_content .= "{\n";
$file_content .= "	print \"<pre>\\n\";\n";
$file_content .= "	print_r(\$customer_info);\n";
$file_content .= "	print \"</pre>\\n\";\n";
$file_content .= "}\n";
$file_content .= "?>";

$fdx = fopen($file_data['txn_id'].'.php','w');

if ($err_data = fwrite($fdx, $file_content)) { return "Create File OK: $file_data[txn_id].php\n"; }
else { return "create file ERROR ($file_data[txn_id].php) : $err_data\n"; }
fclose($fdx);
}
	
function send_customer_email($email_data) {

    $mailFrom = $email_data['from_email'];
    $mailTo = $email_data['customer_email'];

    $mailSubject = $email_data['email_subject'];
    $mailSubject = str_replace('{PRODUCT NAME}', $email_data['product_name'], $mailSubject);
    $mailSubject = str_replace('{PRODUCT CODE}', $email_data['product_code'], $mailSubject);

    $mailBody = $email_data['email_body'];
    $mailBody = str_replace('{CUSTOMER NAME}', $email_data['customer_name'], $mailBody);
    $mailBody = str_replace('{PRODUCT NAME}', $email_data['product_name'], $mailBody);
    $mailBody = str_replace('{PRODUCT CODE}', $email_data['product_code'], $mailBody);
    $mailBody = str_replace('{DOWNLOAD PAGE}', $email_data['download_page'], $mailBody);
    $mailBody = str_replace('{X}', $email_data['expire_in_hours'], $mailBody);

    $mailHeader  = "From: ". '"'. $email_data['from_email_name'] .'" <'. $email_data['from_email'] .'>' ."\r\n";
    $mailHeader .= "Reply-To: $mailFrom\r\n";
    $mailHeader .= "X-Mailer: ".what_is_my_site()."\r\n";    
    $mailHeader .= "X-Sender-IP: {$_SERVER['REMOTE_ADDR']}\r\n";
	
    $mailParams = "-f$mailFrom";
    if ($mailResult = mail($mailTo,$mailSubject,$mailBody,$mailHeader,$mailParams)) { return "Send Email OK\n"; }
    else { return "Error at send email: $mailResult\n"; }
}

function what_is_my_site() {

    // protocol 
    if(isset($_SERVER['HTTPS']) and ("on" == $_SERVER['HTTPS'])) {
        $mysite = "https://";
    }
    else {
        $mysite = "http://";
    }
        
    // host            
    $mysite .= $_SERVER['HTTP_HOST'];
    
    // path
    $path = dirname($_SERVER['SCRIPT_NAME']);
    if("/" != $path) {
        $mysite .= $path;
    }
    return($mysite);
}
?>