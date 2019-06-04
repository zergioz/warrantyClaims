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
if(isset($_POST['addTechUser'])){
	
	#filter datta
        $fileteredUserData = $html->filterEverything($_POST);
        
	# set a few variables 
	$username = $fileteredUserData["txtUserID"];
        $password= $fileteredUserData["txtPass"];
	$txtUserName= $_POST["txtUserName"];


	$find = DBi::$conn->query("SELECT                     `tblTech`.`TechUserNAME`
                                    FROM        `"._DB_NAME."`.`tblTech`
                                    WHERE                      `tblTech`.`TechUserNAME` = '{$_POST['txtUserID']}'");

        if($find->num_rows > 0){

                # redirect back to user list with error mesg
                header('location: '._BASE_URL.'/users/AddTechUsers.php?ErrorMsg='._USER_EXIST.'');

        }else{

		# run query to add new tech user
        	DBi::$conn->query("INSERT INTO `"._DB_NAME."`.`tblTech` 
		 	 	 (			      `tblTech`.`TechFullNAME`,
							      `tblTech`.`TechUserNAME`,
							      `tblTech`.`TechPASSWORD`	) 
			 	 VALUES 	 
			 	 ( 	  		      '$txtUserName',
							      '$username',
					        	       md5('$password')		)");
        
	# redirect back to customers list
        header('location: '._BASE_URL.'/users/ViewTechUsers.php');

	}
}

#include header
echo $html->header();
?>
<body>
<div id="divPage">
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		 <div id="divHeader">Add Tech Users</div>
		<hr>
		<?php $warranty->ViewMesg();?>
		<?php include("../includes/tpl/AddTechUsers.tpl");?>
	</div>
</div>
<!-- end divPage -->
<?php include "../includes/PageFooter.php"; ?>
</body>
</html>
