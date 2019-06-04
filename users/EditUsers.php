<?php 
#start ssession 
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

# check access
if(!isset($_SESSION['cid']) && !isset($_SESSION['name'])){
  header('location: '._BASE_URL.'/home/Login.php');
}

# fetch information for user from db
$db=DBi::$conn->query("SELECT * FROM `"._DB_NAME."`.`tblUser` WHERE UserID={$_GET['UserID']}");
$select=mysqli_fetch_array($db);

# check for request to edit user
if(isset($_POST['edituser'])){

	# filter post
	$fileteredUserData = $html->filterEverything($_POST);

	#set variables 
	$username 	= $fileteredUserData["txtUserName"];
	$txtUserID 	= $fileteredUserData["txtUserID"];
	$txtEMAIL 	= $fileteredUserData["txtEMAIL"];

	#check for password changes
	if(!empty($_POST["txtPassword"])){
		$PassSqlString = ",`UserPASSWORD`= md5('{$_POST[txtPassword]}')";
	}else{
		$PassSqlString = "";
	}
	
	# update record for user on db
	DBi::$conn->query("UPDATE `"._DB_NAME."`.`tblUser` 
			   SET UserFullNAME ='$username', UserNAME ='$txtUserID', `UserEMAIL` = '$txtEMAIL' $PassSqlString  
			   WHERE UserID={$_GET['UserID']}");
	
	# redirect back to user list
	header('location: '._BASE_URL.'/users/ViewUsers.php');

}
#include header
echo $html->header();
?>
<body>
<div id="divPage">
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader">Edit Users</div>
		<hr>
		<?php include("../includes/tpl/EditUsers.tpl");?>
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer();?>
</body>
</html>
