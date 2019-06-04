<?php 
# start session 
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

# check for access
if(!isset($_SESSION['cid']) && !isset($_SESSION['name'])){
  header('location: '._BASE_URL.'/home/Login.php');
}

# check for 
if(isset($_POST['addCustomer'])){
	$fileteredUserData = $html->filterEverything($_POST);
	$username = $fileteredUserData["txtUserID"];
	$password= $fileteredUserData["txtPass"];
	$txtUserName= $_POST["txtUserName"];
	$address= $_POST["address"];
	$zip=$_POST["zip"];
	$city= $_POST["city"];
	$phone= $_POST["phone"];
	
	# look for existing record
	$find = DBi::$conn->query("SELECT 			`tblCustomer`.`CustomerLoginID` 
				   FROM 	 `"._DB_NAME."`.`tblCustomer` 
				   WHERE 			`tblCustomer`.`CustomerLoginID` = '{$_POST['txtUserID']}'");
 	
	if($find->num_rows > 0){
		# redirect back to customers list
                header('location: '._BASE_URL.'/users/AddCustomers.php?ErrorMsg='._USER_EXIST.'');

	}else{
		DBi::$conn->query("INSERT INTO `"._DB_NAME."`.`tblCustomer` 
				 (			      `tblCustomer`.`CustomerFullNAME`,
							      `tblCustomer`.`CustomerLoginID`, 
							      `tblCustomer`.`CustomerPASSWORD`,
							      `tblCustomer`.`CustomerADDRESS`,
							      `tblCustomer`.`CustomerZipCODE`,
							      `tblCustomer`.`CustomerCITY`,
							      `tblCustomer`.`CustomerPHONE`		) 
			  	 VALUES
				 (			      '$txtUserName',
							      '$username',
							      md5('$password'),
							      '$address',
							      '$zip',
							      '$city',
							      '$phone'					)");

		# redirect back to customers list
		header('location: '._BASE_URL.'/users/ViewCustomers.php');
	}
}
#include header
echo $html->header();
?>
<body>
<div id="divPage">
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader">Add Customers</div>
		<hr>
		<?php $warranty->ViewMesg();?>
		<?php include("../includes/tpl/AddCustomers.tpl");?>
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer();?>
</body>
</html>
