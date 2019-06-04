<?php
/* start session */ 
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

if(!isset($_SESSION['cid']) && !isset($_SESSION['name'])){
	header('location: '._BASE_URL.'/home/Login.php');
}

/* create hml */
$html= new html();

/* disable user accounts */
if (isset($_GET['UserID'])){
	
	# construct query	
	$db=DBi::$conn->query("SELECT * FROM `"._DB_NAME."`.`tblUser` 
			       WHERE 			    `tblUser`.`UserID`	= '{$_GET['UserID']}'");
         	
	# fetch data fro DB	
	$select=mysqli_fetch_array($db);


	# check currenty status then change	
	if( $select["UserSTATUS"] == 1){
		$status = 0;	
	}else{
		$status = 1; 
	}
	
	# run query
	DBi::$conn->query("UPDATE 	 `"._DB_NAME."`.`tblUser` 
			   SET 				`tblUser`.`UserSTATUS`	= $status  
			   WHERE                        `tblUser`.`UserID`	= '{$_GET['UserID']}'");
	
	# redirect back to location
	header('location: '._BASE_URL.'/users/ViewUsers.php');
	
}


/* disable customers accounts */
if (isset($_GET['CustomerID'])){

	# construct query
        $db=DBi::$conn->query("SELECT * FROM `"._DB_NAME."`.`tblCustomer` 
			       WHERE 			    `tblCustomer`.CustomerID ='{$_GET['CustomerID']}'");

        # fetch data fro DB
        $select=mysqli_fetch_array($db);

        
                
	# check currenty status then change
        if( $select["CustomerSTATUS"]== 1){
        	$status = 0;
        }else{
        	$status = 1;
        }
		
	# run query
        DBi::$conn->query("UPDATE `"._DB_NAME."`.`tblCustomer` 
			   SET 			 `tblCustomer`.`CustomerSTATUS`	= $status 
			   WHERE 		 `tblCustomer`.`CustomerID` 	='{$_GET['CustomerID']}'");
		
	# redirect back to location
        header('location: '._BASE_URL.'/users/ViewCustomers.php');	
	
	
}

/* disable provider accounts */
if (isset($_GET['ProviderID'])){
         # construct query
        $db=DBi::$conn->query("SELECT * FROM `"._DB_NAME."`.`tblProvider` 
			       WHERE 	  		    `tblProvider`.`ProviderID` ='{$_GET['ProviderID']}'");

        # fetch data fro DB
        $select=mysqli_fetch_array($db);


	# check currenty status then change
        if( $select["ProviderSTATUS"]== 1){
                $status = 0;
        }else{
        	$status = 1;
        }

        # run query
        DBi::$conn->query("UPDATE 	  `"._DB_NAME."`.`tblProvider` 
			   SET 				 `tblProvider`.`ProviderSTATUS`	= $status 
			   WHERE 			 `tblProvider`.`ProviderID` 	='{$_GET['ProviderID']}'");

        # redirect back to location
        header('location: '._BASE_URL.'/users/ViewProviders.php');


}

/* disable tech accounts */
if (isset($_GET['TechID'])){
         # construct query
        $db=DBi::$conn->query("SELECT * FROM `"._DB_NAME."`.`tblTech` 
			       WHERE 			    `tblTech`.`TechID` = '{$_GET['TechID']}'");

        # fetch data fro DB
        $select=mysqli_fetch_array($db);

	# check currenty status then change
        if( $select["TechSTATUS"]== 1){
        	$status = 0;
        }else{
                $status = 1;
        }

        # run query
        DBi::$conn->query("UPDATE `"._DB_NAME."`.`tblTech` 
			   SET 			 `tblTech`.`TechSTATUS`	= $status 
			   WHERE 		 `tblTech`.`TechID` 	='{$_GET['TechID']}'");

        # redirect back to location
        header('location: '._BASE_URL.'/users/ViewTechUsers.php');

        }


?>
