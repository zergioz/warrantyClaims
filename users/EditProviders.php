<?php 
# start session
session_start();

# necessary files
include("../includes/WarrantyConfig.php");

# check access
if(!isset($_SESSION['cid']) && !isset($_SESSION['name'])){
  header('location: '._BASE_URL.'/home/Login.php');
}

# fetch record from db for providers
$db=DBi::$conn->query("SELECT * FROM 	`"._DB_NAME."`.`tblProvider` 
		       WHERE 			       `tblProvider`.`ProviderID`	= {$_GET['ProviderID']}");

# parse data
$select=mysqli_fetch_array($db);

# check to add provider 
if(isset($_POST['updateprovider'])){
	# filter output
	$fileteredUserData = $html->filterEverything($_POST);
	# few variables
	$username = $fileteredUserData["txtUserName"];
	$password = $fileteredUserData["txtPassword"];
 	
	#check for password changes
        if(!empty($_POST["txtPassword"])){
                $PassSqlString = ",`ProviderPASSWORD`= md5('{$_POST[txtPassword]}')";
        }else{
                $PassSqlString = "";
        }
	# execute update on db
	DBi::$conn->query("UPDATE `"._DB_NAME."`.`tblProvider` 
			   SET 			 `tblProvider`.`ProviderNAME`	=	'$username' 
						  $PassSqlString
			   WHERE 		 `tblProvider`.`ProviderID`	=	{$_GET['ProviderID']}");

	# redirect to provides list
	header('location: '._BASE_URL.'/users/ViewProviders.php');
}
# include header
echo $html->header();
?>
<body>
<div id="divPage">
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader">Edit Providers</div>
		<hr>
		<?php include("../includes/tpl/EditProviders.tpl");?>
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer();?>
</body>
</html>
