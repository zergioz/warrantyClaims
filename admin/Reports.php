<?php
# debug
//ini_set("display_errors", 1);
 
# start session 
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

#check for registered users.###
if(!isset($_SESSION['cid']) && !isset($_SESSION['name'])){
	header('location: '._BASE_URL.'/home/Login.php');
}

# report query
$GeneralReport=DBi::$conn->prepare("SELECT	tblWarrantyClaim.WarrantyClaimId,
											tblWarrantyClaim.ClaimStatus,
											tblProvider.ProviderNAME,
											tblWarrantyClaimAdmin.ProviderTWO, 
											tblWarrantyClaim.PumpDistrubutor,
											tblWarrantyClaim.PumpModel,
											tblWarrantyClaim.PumpSERIAL,
											tblWarrantyClaim.WarrantyClaimREF,
											tblWarrantyClaim.PartyCOMPANY,
											tblWarrantyClaim.PartyNAME,
											tblWarrantyClaim.PartyPHONE,
											tblCustomer.CustomerLoginID,
											tblWarrantyClaim.WarrantyClaimDate,
											tblWarrantyClaim.PumpStatus,
											tblWarrantyClaim.PumpStatusOther,
											tblWarrantyClaimAdmin.ClaimAdminIMAGES,
											tblWarrantyRepairServiceForm.LaborPERFORMED,
											tblWarrantyClaimAdmin.ServiceTAG,
											tblWarrantyRepairServiceForm.Code1,
											tblWarrantyRepairServiceForm.Code2,
											tblWarrantyRepairServiceForm.Code3,
											tblWarrantyRepairServiceForm.Code4,
											tblReturnMerchandiseAuthorization.RmaAuthorizeTYPE,
											tblReturnMerchandiseAuthorization.RmaAuthorizeNOTE,
											tblWarrantyClaimAdmin.ReportID,
											tblWarrantyClaimAdmin.RepairBOOL,
											tblWarrantyClaimAdmin.FiledBOOL,
											tblWarrantyClaimAdmin.ReturnedDATE,
											tblWarrantyClaimAdmin.ShippedTYPE,
											tblWarrantyClaimAdmin.TrackingBOL,
											tblWarrantyClaimAdmin.ChargeNUMBERS,
											tblWarrantyClaimAdmin.ReturnedDATE	


									FROM 				tblWarrantyClaim
									LEFT JOIN 		tblCustomer 		ON tblCustomer.CustomerID = tblWarrantyClaim.CustomerId 
									LEFT JOIN		tblProvider       ON tblProvider.ProviderID = tblWarrantyClaim.WarrantyProvider 
									LEFT JOIN		tblWarrantyRepairServiceForm ON tblWarrantyRepairServiceForm.ClaimID = tblWarrantyClaim.WarrantyClaimId
									LEFT JOIN		tblWarrantyClaimAdmin ON tblWarrantyClaim.WarrantyClaimId= tblWarrantyClaimAdmin.ClaimID
									LEFT JOIN		tblReturnMerchandiseAuthorization  ON tblReturnMerchandiseAuthorization.RmaClaimID =  tblWarrantyClaim.WarrantyClaimId
									WHERE tblWarrantyClaim.PumpDistrubutor != 'OCHOA'"); // FILTER OCHOA AS IT WAS THE TEST DISTRO NAME 



# run query
$GeneralReport->execute();

# store result
$GeneralReport->store_result();

# bind results to use
$GeneralReport->bind_result(				$myCLAIMWarrantyClaimId,
							$myCLAIMWarrantyStatus, 
											$myPROVIDERProviderNAME,
											$myADMINProviderTWO, 
											$myCLAIMPumpDistrubutor,
											$myCLAIMPumpModel,
											$myCLAIMPumpSERIAL,
											$myCLAIMWarrantyClaimREF,
											$myCLAIMPartyCOMPANY,
											$myCLAIMPartyNAME,
											$myCLAIMPartyPHONE,
											$myCUSTOMERCustomerLoginID,
											$myCLAIMWarrantyClaimDate,
											$myCLAIMPumpStatus,
											$myCLAIMPumpStatusOther,
											$myADMINClaimAdminIMAGES,
											$mySERVICELaborPERFORMED,
											$myADMINServiceTAG,
											$mySERVICECode1,
											$mySERVICECode2,
											$mySERVICECode3,
											$mySERVICECode4,
											$myRMARmaAuthorizeTYPE,
											$myRMARmaAuthorizeNOTE,
											$myADMINReportID,
											$myADMINRepairBOOL,
											$myADMINFiledBOOL,
											$myADMINReturnedDATE,
											$myADMINShippedTYPE,
											$myADMINTrackingBOL,
											$myADMINChargeNUMBERS,
											$myADMINReturnedDATE);


$data = "	ClaimId,ClaimStatus,ProviderNAME,ProviderTWO,PumpDistrubutor,PumpDistrubutor,PumpModel,PumpSERIAL,WarrantyClaimREF,PartyCOMPANY,PartyNAME,PartyPHONE,Customer,	ClaimDate,PumpStatus,PumpStatusOther,IMAGES,LaborPERFORMED,ServiceTAG,Code1,Code2,Code3,Code4,RmaAuthorizeTYPE,RmaAuthorizeNOTE,ReportID,RepairBOOL,FiledBOOL,ReturnedDATE,ShippedTYPE,TrackingBOL,ChargeNUMBERS,ReturnedDATE \n ";

# fetch information - this array is not being used and will be used to create bars charts
while ($GeneralReport->fetch()){
	$data 	.= 	str_replace(',', '',$myCLAIMWarrantyClaimId)	. 	"," .
			str_replace(',', '',$myCLAIMWarrantyStatus)	.	",".	
				str_replace(',', '',$myPROVIDERProviderNAME)	.	",".
				str_replace(',', '',$myADMINProviderTWO)		.	",".
				str_replace(',', '',$myCLAIMPumpDistrubutor)	.	",".
				str_replace(',', '',$myCLAIMPumpDistrubutor) .	",".
				str_replace(',', '',$myCLAIMPumpModel)		.	",".
				str_replace(',', '',$myCLAIMPumpSERIAL)		.	",".
				str_replace(',', '',$myCLAIMWarrantyClaimREF).	",".
				str_replace(',', '',$myCLAIMPartyCOMPANY)	.	",".
				str_replace(',', '',$myCLAIMPartyNAME)		.	",".
				str_replace(',', '',$myCLAIMPartyPHONE)		.	",".
				str_replace(',', '',$myCUSTOMERCustomerLoginID).	",".
				str_replace(',', '',$myCLAIMWarrantyClaimDate).	",".
				str_replace(',', '',$myCLAIMPumpStatus)  	.	",".
				str_replace(',', '',$myCLAIMPumpStatusOther).	",".
				str_replace(',', '',$myADMINClaimAdminIMAGES).	",".
				str_replace(',', '',$mySERVICELaborPERFORMED).	",".
				str_replace(',', '',$myADMINServiceTAG)		.	",".
				str_replace(',', '',$mySERVICECode1)			.	",".
				str_replace(',', '',$mySERVICECode2)			.	",".
				str_replace(',', '',$mySERVICECode3)			.	",".
				str_replace(',', '',$mySERVICECode4)			.	",".
				str_replace(',', '',$myRMARmaAuthorizeTYPE)	.	",".
				str_replace(',', '',$myRMARmaAuthorizeNOTE)	.	",".
				str_replace(',', '',$myADMINReportID)		.	",".
				str_replace(',', '',$myADMINRepairBOOL)		.	",".
				str_replace(',', '',$myADMINFiledBOOL)		.	",".
				str_replace(',', '',$myADMINReturnedDATE)	.	",".
				str_replace(',', '',$myADMINShippedTYPE)		.	",".
				str_replace(',', '',$myADMINTrackingBOL)		.	",".
				str_replace(',', '',$myADMINChargeNUMBERS)	.	",".
				str_replace(',', '',$myADMINReturnedDATE) 	. "\n";  
}

//$html= new html();
//#include header
//echo $html->header();
header('Content-Type: application/csv'); 
header('Content-Disposition: attachement; filename="'.date(Ymd).'.csv"');
echo $data; 
exit();

?>