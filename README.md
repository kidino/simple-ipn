SIMPLE IPN
==========

Some features:

[+] Expiring download link

[+] Expiring download page

[+] Minimum setup

[+] No database required

[+] Uses Paypal IPN

[+] Emails the customers with their download info

[+] Customizable download page, thank you page and email

[+] Multiple files product package

[+] Allows Paypal Sandbox testing

[+] Strict verification process - verifying price, paypal
    email address and currency.


HOW TO USE / INSTALLATION
=========================

1 - Update settings.php with your products info and Paypal
    details.

2 - Upload the files your chosen directory

3 - From your sales page, link your order button to:

    ipn.php?buy

DONE!

4 - Optionally, modify the template files to change the look
    and feel of the download page and thank you page.

5 - Optionally, send me $10 to remove the little ads credit
    on the download page and thank you page.


FILES
=====

- ipn.php               - handles IPN and buy button creation
- settings.php          - your product & Paypal settings
- dl.php                - handles file download
- page.php              - handles download and thank you page
- tpl_tqpage.html       - thank you page template
- tpl_dlpage.html       - download page template
- functions.php         - functions required
- style.css             - optional stylesheet

- sample.pdf            - sample download file
- sample.mp3            - sample download file
- XXXXXXXXXXXXXXXXX.php - generate customer info file


CHANGING SETTINGS.PHP
=====================

Most of the variables in settings.php are self-explanatory.


CUSTOMIZATION
=============

You can customize the look and feel of the script. To change
the download page, edit tpl_dlpage.html.

The following variables are available for the DOWNLOAD PAGE:
```
   {PAYPAL TXN ID} - transaction ID
   {CUSTOMER NAME} - customer name
   {CUSTOMER BUSINESS NAME} - business name, if any
   {CUSTOMER PAYPAL EMAIL} - customer's Paypal email
   {PAYPAL PURCHASE DATE} - purchase date
   {EXPIRE DATE} - expired date (in unix timestamp)
   {DOWNLOAD PAGE URL} - download page URL
   {DOWNLOAD TIME LEFT} - time left in hours
   {DOWNLOAD TIME} - time set in hours
   {PRODUCT PRICE} - price paid
   {PRODUCT NAME} - product name
   {SUPPORT EMAIL ADDRESS} - your support email address

   {DOWNLOADS1} - lists downloadable files style 1
   {DOWNLOADS2} - lists downloadable files style 2

   {DOWNLOADS1|expire message} - optional expire message
   {DOWNLOADS2|expire message} - optional expire message
```
The thank you page is the page the customer will arrive at
when the click on Return To Merchant at Paypal.com. You can
setup a squeeze page there, using the following variables
in redirect URL or custom fields.

To edit the THANK YOU page, edit tpl_tqpage.html. The
following variables are available for you in the thank you
page template:
```
   {PAYPAL TXN ID} - transaction ID
   {CUSTOMER NAME} - customer name
   {CUSTOMER BUSINESS NAME} - business name, if any
   {CUSTOMER PAYPAL EMAIL} - customer's Paypal email
   {PAYPAL PURCHASE DATE} - purchase date
   {PRODUCT PRICE} - price paid
   {PRODUCT NAME} - product name
   {SUPPORT EMAIL ADDRESS} - your support email address
   {DOWNLOAD PAGE URL} - download page URL
```
An email will be sent out to customers after the purchase.
You can customize this email from settings.php.


DOWNLOAD LIST STYLE
===================

To list out downloadable files, you can use the following
template variables.
```
   {DOWNLOADS1} - lists downloadable files style 1
   {DOWNLOADS2} - lists downloadable files style 2
```
```
   {DOWNLOADS1|expire message} - optional expire message
   {DOWNLOADS2|expire message} - optional expire message
```
{DOWNLOADS1} will output the files in this manner
```
   <ul id='dlist'>
   <li>Sample Audio MP3 <small>[ <a href='dl.php?id=6V001313X66714025&file=0'>DOWNLOAD</a> ]</small></li>
   <li>Sample PDF eBook <small>[ <a href='dl.php?id=6V001313X66714025&file=1'>DOWNLOAD</a> ]</small></li>
   </ul>
```
{DOWNLOADS2} will output the files in this manner
```
   <ul id='dlist'>
   <li><a href='dl.php?id=6V001313X66714025&file=0'>Sample Audio MP3</a></li>
   <li><a href='dl.php?id=6V001313X66714025&file=1'>Sample PDF eBook</a></li>
   </ul>
```
When the download link has expired, the expired message will
be put out in a <p> tag, with ID "expired". Here's an
example:
```
   <p id='expired'>Your download has expired</p>
```
You can use the ID's "dlist" and "expired" to style your
download page with CSS.


MULTIPLE PRODUCTS
=================

While Simple IPN can work with multiple files in your
product package, Simple IPN is not designed to cater for
multiple products.

To use Simple IPN on your other products, copy the files of
Simple IPN into a new folder and define your settings in the
settings.php file.

Just like how you previously link to ipn.php?buy, do the
same for this new product. Make sure you link to the right
file from the right folder.
