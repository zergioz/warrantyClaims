<?php 
# start session
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

# check access
if(!isset($_SESSION['cid']) && !isset($_SESSION['name'])){
  header('location: '._BASE_URL.'/home/Login.php');
}

# do actions for prior step 
if(isset($_POST['step2'])){
	
	# store variabled to arrange prior to db entry
	$txtUserID    = implode("|", $_POST['txtUserID']);
	$txtUserLabor = implode("|", $_POST['txtUserLabor']);
	$txtUserCode1 = implode("|", $_POST['txtUserCode1']);
	$txtUserCode2 = implode("|", $_POST['txtUserCode2']);
	$txtUserCode3 = implode("|", $_POST['txtUserCode3']);
	$txtUserCode4 = implode("|", $_POST['txtUserCode4']);

	# check for record if it exist
	$select = DBi::$conn->query("SELECT * FROM 	`"._DB_NAME."`.`tblWarrantyRepairServiceForm`
			    	     WHERE 			       `tblWarrantyRepairServiceForm`.`ClaimID` ={$_POST['WarrantyClaimId']}");	

	# do insert or update based on results 
	if ($select->num_rows > 0){
		 DBi::$conn->query("UPDATE 			 `"._DB_NAME."`.`tblWarrantyRepairServiceForm` 
				    SET 					`tblWarrantyRepairServiceForm`.`ClaimID`				= {$_POST['WarrantyClaimId']},
										`tblWarrantyRepairServiceForm`.`ReportAfterTechnicalINSPECTION` 	= '$txtUserID',
										`tblWarrantyRepairServiceForm`.`LaborPERFORMED` 			= '$txtUserLabor',
										`tblWarrantyRepairServiceForm`.`Code1`					= '$txtUserCode1',
										`tblWarrantyRepairServiceForm`.`Code2`					= '$txtUserCode2',
										`tblWarrantyRepairServiceForm`.`Code3`					= '$txtUserCode3',
										`tblWarrantyRepairServiceForm`.`Code4`					= '$txtUserCode4'
				    WHERE  					`tblWarrantyRepairServiceForm`.`ClaimID` 				= {$_POST['WarrantyClaimId']}");
	}else{
		 DBi::$conn->query("INSERT INTO 		 `"._DB_NAME."`.`tblWarrantyRepairServiceForm` 
				  (					        `tblWarrantyRepairServiceForm`.`ClaimID`,
										`tblWarrantyRepairServiceForm`.`ReportAfterTechnicalINSPECTION`,
										`tblWarrantyRepairServiceForm`.`LaborPERFORMED`,
										`tblWarrantyRepairServiceForm`.`Code1`,
										`tblWarrantyRepairServiceForm`.`Code2`,
										`tblWarrantyRepairServiceForm`.`Code3`,
										`tblWarrantyRepairServiceForm`.`Code4`	) 
				   VALUES (					'{$_POST['WarrantyClaimId']}',
										'$txtUserID',
										'$txtUserLabor',
										'$txtUserCode1',
										'$txtUserCode2',
										'$txtUserCode3',
										'$txtUserCode4')			");
	}
}


# folllow step of it-self as last step
if(isset($_POST['step3'])){
			
	# get vars
        $txtUserID	=implode("|", $_POST['txtUserID']);
        $txtUserone	=implode("|", $_POST['txtUserone']);
        $txtUsertwo	=implode("|", $_POST['txtUsertwo']);
        $txtUseropen	=implode("|", $_POST['txtUseropen']);
	

        # update claim status base on results we will update or insert record
        $db=DBi::$conn->query("SELECT * FROM `"._DB_NAME."`.`tblFinalTestResult` 
			       WHERE 			    `tblFinalTestResult`.`ClaimID`	={$_REQUEST['WarrantyClaimId']}");

        # fetch record
        $select=mysqli_fetch_array($db);

        # check for record and update or insert based on return
        if(!empty($select)){
				
                # update claim final results
                DBi::$conn->query("UPDATE 	 `"._DB_NAME."`.`tblFinalTestResult`
                                   SET    		        `tblFinalTestResult`.`ShutOFF`       	= '$txtUserID' ,
                                          			`tblFinalTestResult`.`One`            	= '$txtUserone',
                                          			`tblFinalTestResult`.`Two`            	= '$txtUsertwo',
                                          			`tblFinalTestResult`.`OpenDISCHARGE` 	= '$txtUseropen'
                                   WHERE  			`tblFinalTestResult`.`ClaimID`       	= {$_REQUEST['WarrantyClaimId']}");

		
		# set to last step of inspection
                DBi::$conn->query("     UPDATE        `"._DB_NAME."`.`tblWarrantyClaim`
                                        SET                          `tblWarrantyClaim`.`ClaimStatus`        = 'INSPECTION COMPLETED'
                                        WHERE                        `tblWarrantyClaim`.`WarrantyClaimId`    = {$_REQUEST['WarrantyClaimId']}");
				

		# set review 
		if($_POST['step3'] == 'Finalize Review'){
			# update review 
		 	DBi::$conn->query("	UPDATE        `"._DB_NAME."`.`tblWarrantyRepairServiceForm`
						SET 			     `tblWarrantyRepairServiceForm`.`RepairREVIEW` 	= 	1 
						WHERE			     `tblWarrantyRepairServiceForm`.`ClaimID`		=	{$_REQUEST['WarrantyClaimId']}");

			/* step no longer needed - leaving code for future use
			# set to 100% after review is set
			DBi::$conn->query("	UPDATE        `"._DB_NAME."`.`tblWarrantyClaim`
                		           	SET                          `tblWarrantyClaim`.`ClaimStatus`        = 'FINALIZED'
                        		   	WHERE                        `tblWarrantyClaim`.`WarrantyClaimId`    = {$_REQUEST['WarrantyClaimId']}");				
			*/
		}
        }else{
                # insert new record
                DBi::$conn->query("INSERT INTO 	 `"._DB_NAME."`.`tblFinalTestResult` 
				 (				`tblFinalTestResult`.`ClaimID`, 
								`tblFinalTestResult`.`ShutOFF`, 
								`tblFinalTestResult`.`One`, 
								`tblFinalTestResult`.`Two`, 
								`tblFinalTestResult`.`OpenDISCHARGE` 	)
                                  VALUES (			'{$_REQUEST['WarrantyClaimId']}',
								'$txtUserID',
								'$txtUserone',
								'$txtUsertwo',
								'$txtUseropen'				)");
		
		
                # set to last step of inspection
                DBi::$conn->query("     UPDATE        `"._DB_NAME."`.`tblWarrantyClaim`
                                        SET                          `tblWarrantyClaim`.`ClaimStatus`        = 'INSPECTION COMPLETED'
                                        WHERE                        `tblWarrantyClaim`.`WarrantyClaimId`    = {$_REQUEST['WarrantyClaimId']}");                                
                


        }


       	# redirect to warranty form destination based on tech access or admin review
	if(isset($_SESSION['tech_id'])){
	        header('location: '._BASE_URL.'/warranty/ViewClaimWarranty.php');
	}else{
		 header('location: '._BASE_URL.'/warranty/ViewClaimWarranty.php?ViewClaimDetails=1&WarrantyClaimId='.$_REQUEST["WarrantyClaimId"].'');	
	}
}

# run query infrmation for forms
$db=DBi::$conn->query("SELECT * FROM 		`"._DB_NAME."`.`tblFinalTestResult` 
		       WHERE 				       `tblFinalTestResult`.`ClaimID`={$_POST['WarrantyClaimId']}");

# fetch record
$select=mysqli_fetch_array($db);

# parse data to display
if($select){
        $shutoff   	= explode( '|', $select['ShutOFF']);
        $numberone 	= explode( '|', $select['One']);
        $numbertwo 	= explode( '|', $select['Two']);
        $opendisc 	= explode( '|', $select['OpenDISCHARGE']);
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
		<?php include("../includes/tpl/WarrantyFormServiceStep03.tpl");?>		
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer();?>
</body>
</html>
