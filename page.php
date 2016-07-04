<?php
include('settings.php');
include('functions.php');
$script_uri = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

	$p = explode('-',$_SERVER['QUERY_STRING']);
	if($p[0] == 'dl')
	{
		$filename = 'tpl_dlpage.html';
		$fhandle = fopen($filename, "r");
		$page_html = fread($fhandle, filesize($filename));
		fclose($fhandle);

		$no_files = array(
			"index.php", 
			"ipn.php", 
			"dl.php", 
			"page.php", 
			"settings.php", 
			"thankyou.php", 
			"functions.php"
		);
		
		$txn_id = preg_replace("/[^0-9a-zA-Z]/", "", $p[1]);
		$customer_file = basename($txn_id.'.php');
		
		if (in_array($customer_file, $no_files)) {
		    die('<h1>FATAL ERROR: Unauthorized Access</h1>');
		}

		if (file_exists($customer_file))
		{ include($customer_file); }
		else
		{ die('Purchase Details Not Found. Contact Administrator.'); }

		$page_html = str_replace('{PAYPAL TXN ID}', $customer_info['txn_id'], $page_html);
		$page_html = str_replace('{CUSTOMER NAME}', $customer_info['customer_name'], $page_html);
		$page_html = str_replace('{CUSTOMER BUSINESS NAME}', $customer_info['business_name'], $page_html);
		$page_html = str_replace('{CUSTOMER PAYPAL EMAIL}', $customer_info['customer_email'], $page_html);
		$page_html = str_replace('{PAYPAL PURCHASE DATE}', $customer_info['purchase_date'], $page_html);
		$page_html = str_replace('{EXPIRE DATE}', $customer_info['expire_date'], $page_html);
		$page_html = str_replace('{DOWNLOAD PAGE URL}', $customer_info['expire_date'], $page_html);
		$page_html = str_replace('{PRODUCT PRICE}', $customer_info['purchase_amount'], $page_html);
		$page_html = str_replace('{DOWNLOAD TIME LEFT}', $customer_info['time_left'], $page_html);
		$page_html = str_replace('{DOWNLOAD TIME}', $customer_info['expire_time'], $page_html);

		$page_html = str_replace('{PRODUCT NAME}', $customer_info['product_name'], $page_html);
		$page_html = str_replace('{SUPPORT EMAIL ADDRESS}', $support_email_address, $page_html);
	
		preg_match_all("/\{(DOWNLOADS[12])\|?(.*)\}/", $page_html, $dlmatches);
		
		if (is_array($dlmatches))
		{
			foreach($dlmatches[1] as $dlkey => $dlvalue)
			{
				if ($dlvalue == 'DOWNLOADS1') $download_style = 1;
				if ($dlvalue == 'DOWNLOADS2') $download_style = 2;
	
				$dl_list = display_products($product_files, $customer_info, $download_style, $dlmatches[2][$dlkey]);
				$page_html = str_replace($dlmatches[0][$dlkey], $dl_list, $page_html);
			}
		}
	}
	else
	{ die("Invalid Page Request."); }

echo $page_html;
?>