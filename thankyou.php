<?php

include('settings.php');
include('functions.php');

if (isset($_GET['tx'])) {
	$script_uri = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

	$this_file = 'thankyou.php';
	$download_page_url = str_replace($this_file, 'page.php?dl-'.$_GET['tx'], $script_uri);

	$filename = 'tpl_tqpage.html';
	$fhandle = fopen($filename, "r");
	$page_html = fread($fhandle, filesize($filename));
	fclose($fhandle);

	$page_html = str_replace('{PAYPAL TXN ID}', $_GET['tx'], $page_html);
	$page_html = str_replace('{DOWNLOAD PAGE URL}', $download_page_url, $page_html);
	$page_html = str_replace('{PRODUCT NAME}', $product_name, $page_html);
	$page_html = str_replace('{PRODUCT PRICE}', $_GET['amt'], $page_html);
	$page_html = str_replace('{SUPPORT EMAIL ADDRESS}', $support_email_address, $page_html);

	echo $page_html;
} else { ?>

<h1>404 Not Found</h1>

<?php }

if ($debug == 1) {
	echo "<pre>";
	var_dump($_REQUEST);
	echo "</pre>";
	
	if (file_exists($_GET['tx'].'.php')) {
		echo "<pre>";
		echo file_get_contents($_GET['tx'].'.php');
		echo "</pre>";
	} 
	
}