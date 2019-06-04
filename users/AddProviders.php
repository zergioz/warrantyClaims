<?php 
# start session
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

# check access
if(!isset($_SESSION['cid']) && !isset($_SESSION['name'])){
  header('location: '._BASE_URL.'/home/Login.php');
}

# check for request to add provider
if(isset($_POST['addprovider'])){
	# filter post and  set values
	$fileteredUserData = $html->filterEverything($_POST);
	$username = $fileteredUserData["txtUserName"];
	$password = $fileteredUserData["txtPassword"];	
	
	
	# look for existing record
        $find = DBi::$conn->query("SELECT 		 `tblProvider`.`ProviderNAME` 
				   FROM   `"._DB_NAME."`.`tblProvider` 
				   WHERE 		 `tblProvider`.`ProviderNAME` = '{$_POST['txtUserName']}'");
	
	# reirect with error or update based on result
        if($find->num_rows > 0){

                # redirect back to customers list
                header('location: '._BASE_URL.'/users/AddProviders.php?ErrorMsg='._USER_EXIST.'');

        }else{
		# run query to add provider
		DBi::$conn->query("INSERT INTO 	`"._DB_NAME."`.`tblProvider` 
				  (			      `tblProvider`.`ProviderNAME`,
							      `tblProvider`.`ProviderPASSWORD`) 
			  	  VALUES 
				  (		      	      '$username',
							      md5('$password')			)");

		# redirect to providers list
		header('location: '._BASE_URL.'/users/ViewProviders.php');
	}
}
# include header
echo $html->header();
?>
<body>
<div id="divPage">
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader">Add Providers</div>
		<hr>
		<?php $warranty->ViewMesg();?>
		<?php include("../includes/tpl/AddProviders.tpl");?>
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer(); ?>
</body>
</html>
