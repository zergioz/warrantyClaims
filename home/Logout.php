<?php
session_start();
include "../VerifyUser.php";

$_SESSION["cid"] = NULL;
unset($_SESSION["cid"]);
$_SESSION["name"] = NULL;
unset($_SESSION["name"]);
$_SESSION["customername"] = NULL;
unset($_SESSION["customername"]);
$_SESSION["customerid"] = NULL;
unset($_SESSION["customerid"]);
session_destroy();
header( 'Location: ../home/Login.php' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Warranty Tracking System</title>

</head>

<body>
You have logged out
</body>
</html>
