<?php 
# check access
session_start();

# necessary files
include("../includes/WarrantyConfig.php");

# check access
if(!isset($_SESSION['cid']) && !isset($_SESSION['name'])){
  header('location: '._BASE_URL.'/home/Login.php');
}

# run adduser and do checks
if(isset($_POST['adduser'])){
	$fileteredUserData 	= $html->filterEverything($_POST);
	$username 	   	= $fileteredUserData["txtUserName"];
	$txtUserID 		= $fileteredUserData["txtUserID"];
	$email			= $fileteredUserData["txtEmail"];
	$password 		= $fileteredUserData["txtPass"];

	# look for existing record
        $find = DBi::$conn->query(" SELECT 		       `tblUser`.`UserNAME` 
				    FROM   	`"._DB_NAME."`.`tblUser` 
				    WHERE  		       `tblUser`.`UserNAME` = '{$_POST['txtUserID']}'");
 	 	
        if($find->num_rows > 0){
                # redirect back to user list with error mesg
                header('location: '._BASE_URL.'/users/AddUsers.php?ErrorMsg='._USER_EXIST.'');
 
        }else{
		# insert new record
		DBi::$conn->query("INSERT INTO 	`"._DB_NAME."`.`tblUser` 
				 (			       `tblUser`.`UserFullNAME`,
							       `tblUser`.`UserNAME`,
							       `tblUser`.`UserEMAIL`,
							       `tblUser`.`UserPASSWORD`		) 	
				 VALUES
				 (			       '$username',
							       '$txtUserID',
							       '$email',
							       md5('$password')			)");
	
		#redirect to user list
		header('location: '._BASE_URL.'/users/ViewUsers.php');
	}
}


#include header
echo $html->header();
?>
<body>
<div id="divPage">
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader">Add Users</div>
		<hr>
		<?php $warranty->ViewMesg();?>
		<?php include("../includes/tpl/AddUsers.tpl");?>
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer(); ?>
</body>
</html>
