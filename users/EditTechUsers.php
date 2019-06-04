<?php 
# start session 
session_start();

# necessary files
include("../includes/WarrantyConfig.php");

# check access
if(!isset($_SESSION['cid']) && !isset($_SESSION['name'])){
  header('location: '._BASE_URL.'/home/Login.php');
}

#fetch information for user from db
$db=DBi::$conn->query("SELECT * FROM `"._DB_NAME."`.`tblTech` 
		       WHERE 			    `tblTech`.`TechID`	= {$_GET['TechID']}");
$select=mysqli_fetch_array($db);

# check for request to edit user
if(isset($_POST['edittechuser'])){

        # filter post
        $fileteredUserData = $html->filterEverything($_POST);

        #set variables
        $username = $fileteredUserData["txtUserName"];
        $txtUserID = $fileteredUserData["txtUserID"];

        #check for password changes
        if(!empty($_POST["txtPassword"])){
                $PassSqlString = ",`TechPASSWORD` = md5('{$_POST[txtPassword]}')";
        }else{
                $PassSqlString = "";
        }

        # update record for user on db
        DBi::$conn->query("UPDATE 	 `"._DB_NAME."`.`tblTech` 
			   SET 			        `tblTech`.`TechFullNAME` 	= '$username',
						        `tblTech`.`TechUserNAME`	= '$txtUserID' 
						        $PassSqlString  
			   WHERE 			`tblTech`.`TechID`		= {$_GET['TechID']}");

        # redirect back to user list
        header('location: '._BASE_URL.'/users/ViewTechUsers.php');

}

#include header
echo $html->header();
?>
<body>
<div id="divPage">
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader">Edit TechUsers</div>
		<hr>	
		<?php include("../includes/tpl/EditTechUsers.tpl");?>
	</div>
</div>
<!-- end divPage -->
<?php include "../includes/PageFooter.php"; ?>
</body>
</html>
