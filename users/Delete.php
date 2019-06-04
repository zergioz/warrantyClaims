<?php 
#start ssession
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

# check access
if(!isset($_SESSION['cid']) && !isset($_SESSION['name'])){
	header('location: '._BASE_URL.'/home/Login.php');
}

# take action to erase 
if(isset($_GET['UserID'])){

	# run query to delete user	
	$userid=DBi::$conn->query("DELETE FROM `"._DB_NAME."`.`tblUser` 
				   WHERE 		      `tblUser`.`UserID`	= ".$_GET['UserID'].";");

	# redirect 	
	header('location: '._BASE_URL.'/users/ViewUsers.php');
}

# take action to erase tech
if(isset($_GET['TechID'])){

	# run query to delete tech
	$techuser=DBi::$conn->query("DELETE FROM `"._DB_NAME."`.`tblTech` 
				     WHERE 			`tblTech`.`TechID`	= ".$_GET['TechID'].";");


	# redirect 
	header('location: '._BASE_URL.'/users/ViewTechUsers.php');
}

# take action to erase customer
if(isset($_GET['CustomerID'])){
	
	# run query 
	$techuser=DBi::$conn->query("DELETE FROM `"._DB_NAME."`.`tblCustomer` 
				     WHERE 			`tblCustomer`.`CustomerID`	= ".$_GET['CustomerID'].";");


	# redirect to customers
	header('location: '._BASE_URL.'/users/ViewCustomers.php');
}

# take action to erase provider
if(isset($_GET['ProviderID'])){
	
	# run query
	$techuser=DBi::$conn->query("DELETE FROM `"._DB_NAME."`.`tblProvider` 
				     WHERE 			`tblProvider`.`ProviderID`	= ".$_GET['ProviderID'].";");


	# redirect 
	header('location: '._BASE_URL.'/users/ViewProviders.php');
}
?>
