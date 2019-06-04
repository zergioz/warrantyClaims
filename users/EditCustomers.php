<?php 
# start session
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

# check for access
if(!isset($_SESSION['cid']) && !isset($_SESSION['name'])){
  header('location: '._BASE_URL.'/home/Login.php');
}

# fetch from db customers information to use
$db=DBi::$conn->query(" SELECT * FROM    `"._DB_NAME."`.`tblCustomer` 
			WHERE 				`tblCustomer`.`CustomerID`	=	{$_GET['CustomerID']}");

$select=mysqli_fetch_array($db);

# create html object
$html= new html();

# if action is update customer
if(isset($_POST['updateCustomer'])){
	$fileteredUserData = $html->filterEverything($_POST);
	$username = $fileteredUserData["txtUserID"];
	$txtUserName= $_POST["txtUserName"];
	$address= $_POST["address"];
	$city= $_POST["city"];
	$zip = $_POST["zip"];
	$phone= $_POST["phone"];
	$password = $fileteredUserData["txtPassword"];

 	#check for password changes
        if(!empty($_POST["txtPassword"])){
                $PassSqlString = ",`tblCustomer`.`CustomerPASSWORD`= md5('{$_POST[txtPassword]}')";
        }else{
                $PassSqlString = "";
        }
	DBi::$conn->query("UPDATE 	 `"._DB_NAME."`.`tblCustomer` 
			  SET 		  	        `tblCustomer`.`CustomerFullNAME`	= '$txtUserName',
							`tblCustomer`.`CustomerLoginID`		= '$username',
							`tblCustomer`.`CustomerADDRESS`		= '$address',
							`tblCustomer`.`CustomerCITY`		= '$city',
							`tblCustomer`.`CustomerPHONE`		= '$phone', 
							`tblCustomer`.`CustomerZipCODE`		= '$zip' 
							$PassSqlString 
			  WHERE 			`tblCustomer`.`CustomerID`		= {$_GET['CustomerID']}");

	# redirect to view customers page
	header('location: '._BASE_URL.'/users/ViewCustomers.php');
}
#include header
echo $html->header();
?>
<body>
<div id="divPage">
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader">Edit Customers</div>
		<hr>
		<?php include("../includes/tpl/EditCustomers.tpl");?>
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer();; ?>
</body>
</html>
<?php 

?>
