<?php

include('settings.php');
include('products.php');
include('functions.php');

if (isset($_GET['tx']) || isset($_POST['txn_id'])) {
	
	$txn = (isset($_GET['tx'])) ? $_GET['tx'] : $_POST['txn_id'];
	$product_code = (isset($_GET['item_number'])) ? $_GET['item_number'] : $_POST['item_number'];
	$product = isset($products[$product_code]) ? $products[$product_code] : false;
	
	if ($product) {
		$script_uri = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

		$this_file = 'thankyou.php';
		$download_page_url = str_replace($this_file, 'page.php?dl-'.$txn, $script_uri);

		$filename = 'tpl_tqpage.html';
		$fhandle = fopen($filename, "r");
		$page_html = fread($fhandle, filesize($filename));
		fclose($fhandle);

		$page_html = str_replace('{PAYPAL TXN ID}', $txn, $page_html);
		$page_html = str_replace('{DOWNLOAD PAGE URL}', $download_page_url, $page_html);
		$page_html = str_replace('{PRODUCT NAME}', $product['name'], $page_html);
		$page_html = str_replace('{PRODUCT PRICE}', $product['price'], $page_html);
		$page_html = str_replace('{SUPPORT EMAIL ADDRESS}', $support_email_address, $page_html);		
	} else {
		$page_html = '<h1>Product Details Not Found</h1>';
		$page_html .= '<p>We could not find the details for the product that you are paying for.</p>';
		$page_html .= '<p>If you believe this is a mistake, contact as at '.$support_email_address.'</p>';
	}
	

	echo $page_html;
} else { ?>

<h1>Transaction Details Not Found</h1>
<p>You may have arrived here by mistake, or we did not receive enough information about your purchase from Paypal.</p>

<p>If you indeed made a payment, your transaction may be marked as <strong>Pending</strong> by Paypal.</p>

<p>Check your email for any purchase details from us. And get in touch with us if you still cannot download your purchase after 48 hours.</p>

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