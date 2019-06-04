<?php
# start session 
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

# check access
if(!isset($_SESSION['cid']) && !isset($_SESSION['name'])){
  header('location: '._BASE_URL.'/home/Login.php');
}

# update table based on step one
if(isset($_POST['step2'])){

        # get vars
        $txtUserID	= implode("|", $_POST['txtUserID']);
        $txtUserone	= implode("|", $_POST['txtUserone']);
        $txtUsertwo	= implode("|", $_POST['txtUsertwo']);
        $txtUseropen	= implode("|", $_POST['txtUseropen']);

	/* step no longer needed - leaving code for future use
        # update claim status
        DBi::$conn->query("UPDATE		`"._DB_NAME."`.`tblWarrantyClaim` 
			   SET 	 			       `tblWarrantyClaim`.`ClaimStatus` 		= 'STARTED' 
			   WHERE 			       `tblWarrantyClaim`.`WarrantyClaimId` 	= {$_REQUEST['WarrantyClaimId']}");
	*/
	# update claim status base on results we will update or insert record
        $db=DBi::$conn->query("SELECT * FROM 	 `"._DB_NAME."`.`tblPreTestResult` 
			       WHERE 				`tblPreTestResult`.`ClaimID`	= {$_REQUEST['WarrantyClaimId']}");
	
	# fetch record
	$select=mysqli_fetch_array($db);
	
	# check for record and update or insert based on return
	if($select){
		# update claim final results
        	DBi::$conn->query("UPDATE 		 `"._DB_NAME."`.`tblPreTestResult` 
				   SET 	  				`tblPreTestResult`.`ShutOFF` 	   	= '$txtUserID' , 
					  				`tblPreTestResult`.`One`      	   	= '$txtUserone', 
					  				`tblPreTestResult`.`Two`	   	= '$txtUsertwo', 
					  				`tblPreTestResult`.`OpenDISCHARGE` 	= '$txtUseropen' 
				   WHERE  				`tblPreTestResult`.`ClaimID` 	   	= {$_REQUEST['WarrantyClaimId']}");
	}else{	
		# insert new record 
		DBi::$conn->query("INSERT INTO `tblPreTestResult` (`ClaimID`, `ShutOFF`, `One`, `Two`, `OpenDISCHARGE`) 
				   VALUES ('{$_REQUEST['WarrantyClaimId']}','$txtUserID','$txtUserone','$txtUsertwo','$txtUseropen')");
			
	}
}


# you need to come from step one to see this information
# select record form claim for step 2
$db=DBi::$conn->query("SELECT * FROM 		 `"._DB_NAME."`.`tblWarrantyRepairServiceForm`
                       WHERE 					`tblWarrantyRepairServiceForm`.`ClaimID`	= {$_REQUEST['WarrantyClaimId']}");


# fetch record
$select=mysqli_fetch_array($db);

if($select){
	# get array for Report_After_Technical_Insepction field
	$Report_After_Technical_Insepction  = explode("|", $select["ReportAfterTechnicalINSPECTION"]);
	$Labor_Performed		    = explode("|", $select["LaborPERFORMED"]);
	$codeone        		    = explode("|", $select['Code1']);
	$codetwo      			    = explode("|", $select['Code2']);
	$codethree      		    = explode("|", $select['Code3']);
	$codefour      			    = explode("|", $select['Code4']);
}


#include header
echo $html->header();
?>
<body>
<div id="divPage">
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader">REPAIR SERVICE FORM : CLAIM <?php echo $_REQUEST['WarrantyClaimId'];?></div>
		<hr>
		<?php include("../includes/tpl/WarrantyFormServiceStep02.tpl");?>		
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer(); ?>
</body>
</html>
