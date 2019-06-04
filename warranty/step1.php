<?php 
# start session
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

# check access
if(!isset($_SESSION['cid']) && !isset($_SESSION['name'])){
  header('location: '._BASE_URL.'/home/Login.php');
}
/*
print_r($_POST);
exit();
*/
# check if item was received 
if(isset($_POST['ITEM'])){
	
	# value is sent
	if($_POST['ITEM'] == TRUE){
		
		# update db		
		$warranty->ExecuteCurrentStep('ITEM RECEIVED',$_REQUEST['WarrantyClaimId']);
		
		# redirect
                #header('location: ' . _BASE_URL . '/warranty/ViewClaimWarranty.php?ViewClaimDetails=1&WarrantyClaimId='.$_REQUEST['WarrantyClaimId'].'');
		header('location: ' . _BASE_URL . '/warranty/ViewTechClaimWarranty.php');
	}
}else{

	# check for date on if date is null for tech then assing 
	$checktechId =DBi::$conn->query("SELECT 		            `tblWarrantyClaim`.`TechId` 
				    	 FROM `"._DB_NAME."`.`tblWarrantyClaim` 
				         WHERE 				    `tblWarrantyClaim`.`WarrantyClaimId`	= {$_REQUEST['WarrantyClaimId']}");


	# if tech value is null assign a tech Id
	if($checktechId->num_rows >= 0){
		$countTechUsers=DBi::$conn->query("UPDATE 	 `"._DB_NAME."`.`tblWarrantyClaim` 
						   SET 	  			`tblWarrantyClaim`.`TechServiceWorkDate`	= now(), 
							  			`tblWarrantyClaim`.`ClaimStatus`		='INSPECTION IN PROGRESS', 
							  			`tblWarrantyClaim`.`TechId`			={$_REQUEST['TechId']} 
					   	   WHERE  			`tblWarrantyClaim`.`WarrantyClaimId`		={$_REQUEST['WarrantyClaimId']}");
	}

	# run query infrmation for forms
	$db=DBi::$conn->query("SELECT 	* 	FROM 	 `"._DB_NAME."`.`tblPreTestResult` 
			       WHERE 			 		`tblPreTestResult`.`ClaimID`	= {$_POST['WarrantyClaimId']}");

	# fetch record
	$select=mysqli_fetch_array($db);

	# parse data to display 
	if($select){
		$ShutOFF   	= explode( '|', $select['ShutOFF']); 	
		$numberone 	= explode( '|', $select['One']);
		$numbertwo 	= explode( '|', $select['Two']);
		$opendisc 	= explode( '|', $select['OpenDISCHARGE']);
	}
}
#include header
echo $html->header();
?>
<body>
<div id="divPage">
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader">REPAIR SERVICE FORM : CLAIM <?echo $_REQUEST['WarrantyClaimId'];?></div>
		<hr>
		<?php include("../includes/tpl/WarrantyFormServiceStep01.tpl");?>	
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer(); ?>
</body>
</html>
