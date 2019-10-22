<?php
//error_reporting(0); 

/* start db credentials */
define('_DB_HOSTNAME','localhost');
define('_DB_NAME','warrantyClaims');
define('_DB_USERNAME','');
define('_DB_PASSWORD','');

/* Define the BASE URL */
define('_BASE_URL','/');

/* system alerts */
# passsword change 
define('_SHOWALERT','');
define('_SHOWALERT_PASSWORD_SUCCESS', 'Your password was changed successfully.');
define('_SHOWALERT_PASSWORD_ERROR', 'Change Password Error - Invalid password entry. Update failed.');
define('_SHOWALERT_PASSWORD_IDENTICAL', 'Change Password Error - Your new passwords need to be identical to each other. Please retry.');
# login
define('_SHOWALERT_SUCESS_LOGIN' ,'<h3>Welome...</h3> <p>You are now successfully logged in</p>');
define('_SHOWALERT_SUCESS_LOGOUT','<h3>You are now logged out.</h3>:Certain features may not be available to you until you log-in to the site.</p>');
define('_SHOWALERT_INVALID_LOGIN','Invalid Login. Please try again.');
#notes	
define('_SHOWALERT_DELETE_NOTE', '<h3>Item Deleted</h3><p>The selected item was deleted from this delvery note.</p>');
# warranty claims
define('_CLAIM_TEPLATE_ERROR', '<h3>We are sorry, but it seems, you have selected an invalid pump type.</h3>');
define('_CLAIM_CREATION_SUCCESS', 'Your Claim Was Created');
#user
define('_NOT_VALID_USER', 'Not a valid user - please login');
define('_USER_EXIST', 'Username already in record');
# screen titles
define('_TITLE_HEADER_DEFAULT', 'PD Water Systems : Warranties and Claims');
define('_TITLE_HEADER_DEFAULT_SHORT', 'Warranties and Claims');



/*  add include libraries - dbconnect strings and warranty class */
include ("PHPMailer/class.phpmailer.php");
include ("Warranty.php");
include ("HTML.php");
include ("DB.php");

/* start object */
//$mail	  = new PHPMailer();
$warranty = new warranty();
$html     = new html();

?>
