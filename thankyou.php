<?php
include('settings.php');
include('functions.php');
$script_uri = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

	$this_file = 'thankyou.php';
	$download_page_url = str_replace($this_file, 'page.php?dl-'.$_POST['txn_id'], $script_uri);

	$filename = 'tpl_tqpage.html';
	$fhandle = fopen($filename, "r");
	$page_html = fread($fhandle, filesize($filename));
	fclose($fhandle);

	$page_html = str_replace('{PAYPAL TXN ID}', $_POST['txn_id'], $page_html);
	$page_html = str_replace('{CUSTOMER NAME}', $_POST['first_name'].' '.$_POST['last_name'], $page_html);
	$page_html = str_replace('{CUSTOMER BUSINESS NAME}', $_POST['payer_business_business'], $page_html);
	$page_html = str_replace('{CUSTOMER PAYPAL EMAIL}', $_POST['payer_email'], $page_html);
	$page_html = str_replace('{PAYPAL PURCHASE DATE}', $_POST['payment_date'], $page_html);
	$page_html = str_replace('{DOWNLOAD PAGE URL}', $download_page_url, $page_html);
	$page_html = str_replace('{PRODUCT NAME}', $_POST['item_name'], $page_html);
	$page_html = str_replace('{PRODUCT PRICE}', $_POST['mc_gross'], $page_html);
	$page_html = str_replace('{SUPPORT EMAIL ADDRESS}', $support_email_address, $page_html);

echo $page_html;

if ($debug == 1) {
	echo "<pre>";
	var_dump($_REQUEST);
	echo "</pre>";	
}