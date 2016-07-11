<?php
set_time_limit(0);
include('settings.php');
include('products.php');
include('functions.php');
include_once('downloader.inc.php');

$no_files = array(
	"index.php", 
	"ipn.php", 
	"dl.php", 
	"page.php", 
	"settings.php", 
	"products.php", 
	"functions.php"
);

$txn_id = preg_replace("/[^0-9a-zA-Z]/", "", $_GET['id']);
$customer_file = basename($txn_id.'.php');

if (in_array($customer_file, $no_files)) {
    die('<h1>FATAL ERROR: Unauthorized Access</h1>');
}

if (file_exists($customer_file))
{ include($customer_file); }
else
{ die('Purchase Details Not Found. Contact Administrator.'); }

 if ($_GET['file'] == '')
{ die('Invalid File Information. Contact Administrator.'); }

$file_id = (int) $_GET['file'];

if (!isset($products[$customer_info['product_code']]['files'][$file_id]))
{ die('Invalid File Information. Contact Administrator.'); }

$file = $products[$customer_info['product_code']]['files'][$file_id];

if (download_is_expired($customer_info['expire_date']))
{ die('Download has expired.'); }
    
if (file_exists($file['source']))
{
    $download = new downloader();
    
    $download->set_byfile($file['source']);
    $download->mime = '';
    $download->use_resume = true; //Enable Resume Mode
    $download->filename = $file['filename'];
    
    $download->download();

    exit();
}
else
{ die("Download file ID $file_id is not valid. Please contact webmaster."); }
?>