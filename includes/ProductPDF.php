<?php 
# debug
ini_set("display_errors", 1);
ini_set('memory_limit', '-1');

# start session
session_start();
		
#necessary files
include("WarrantyConfig.php");


# check access
if(!isset($_SESSION['GLOBAL_ACCESS'])){
        header('location: '._BASE_URL.'/home/Login.php');
}

if(isset($_GET['claimid'])){

	# vars
	$id=$_GET['claimid'];
	$productImage = "<img src='http://warranty.pdwatersystems.com/images/productImages/imagenotavailable.jpg'>";
	

	$selectpdf =DBi::$conn->query("	SELECT	CLAIM.*,
											PRE.*,
											REP.*,
											RMA.*,
											FIN.ShutOFF AS FShutOFF,
											FIN.One AS FOne,
											FIN.Two AS FTwo,
											FIN.OpenDISCHARGE AS FOpenDISCHARGE ,
											CUS.* 
									FROM  		`warranty`.`tblWarrantyClaim` 					AS CLAIM
									LEFT  JOIN  `warranty`.`tblPreTestResult` 					AS PRE		ON    	CLAIM.`WarrantyClaimId` = PRE.`ClaimID` 
									LEFT  JOIN	`warranty`.`tblWarrantyRepairServiceForm` 		AS REP		ON 	CLAIM.`WarrantyClaimId` = REP.`ClaimID`
									LEFT  JOIN	`warranty`.`tblFinalTestResult` 				AS FIN		ON 	CLAIM.`WarrantyClaimId` = FIN.`ClaimID`
									LEFT  JOIN	`warranty`.`tblReturnMerchandiseAuthorization`  AS RMA		ON 	CLAIM.`WarrantyClaimId` = RMA.`RmaClaimID`
									LEFT  JOIN  `warranty`.`tblCustomer`						AS CUS		ON	CLAIM.`CustomerId` 	= CUS.`CustomerID`
									WHERE	   	 CLAIM.`WarrantyClaimId` = $id");


	while ($pdf = mysqli_fetch_array($selectpdf) ){
				
		//echo "<pre>";
		//print_r($pdf);
		//echo "</pre>";
		
		$selectcus =DBi::$conn->query("SELECT * FROM `"._DB_NAME."`.`tblCustomer` WHERE CustomerID=$pdf[CustomerId]");
		while ($customer = mysqli_fetch_array($selectcus) ){	
			# I have not cliue the point of this snippet	
			if(!empty($pdf['productImage']) AND $pdf['productImage'] > 0){

				# check for images			
				$productImageRaw=$pdf['productImage'];
			
				# parse images in arrar if more than one
				$productImage_Array =  explode( '|',$productImageRaw );
				
				//print_r($productImage_Array);
				
				if(!empty($productImage_Array)){

					#empty image set
					$productImage = '';
						
					# sert array into images
					foreach ($productImage_Array as $value) {
						$productImage .= "<img width='300px' src='http://warranty.pdwatersystems.com/images/productImages/".$value."'><br/>";
					}															
				}
			}
		}
		# html code to parse /home/pdwarranty/public_html/ path
	$reportResult = '<table width="800" border="0" align="center" cellspacing="1" class="dataTables_wrapper no-footer"> 
			              <tbody>
		                  	<tr bgcolor="#fff">
	                     	  	<th align="left" class="tit">&nbsp;</th>
	                     	  	<td>&nbsp;</td>
	                     	  	<td>&nbsp;</td>
                     	  		<th align="left">&nbsp;</th>
		                     	<td align="right"><span class="tit"><img src="http://warranty.pdwatersystems.com/images/Logo.jpg"></span></td>
		                   	</tr>
		                     	<tr>
		                        <th width="96" align="left" bgcolor="#F3F3F3" class="tit">Claim id:</th>
		                        <td width="208" bgcolor="#F3F3F3"><span class="txt">'.$pdf['WarrantyClaimId'].'</span></td>
		                        <td width="45" bgcolor="#FFFFFF">&nbsp;</td>
		                        <th width="92" align="left" bgcolor="#F3F3F3"><span class="tit">Customer id:</span></th>
		                        <td width="341" bgcolor="#F3F3F3">'.$pdf['CustomerID'].'</td>
		                      	</tr>
		                      	<tr>
		                      	  <th align="left" bgcolor="#fdfdf7" class="tit">Status:</th>
		                      	  <td bgcolor="#fdfdf7"><span class="txt">'.$pdf['ClaimStatus'].'</span></td>
		                      	  <td bgcolor="#FFFFFF">&nbsp;</td>
		                      	  <th align="left" bgcolor="#fdfdf7"><span class="tit">Name:</span></th>
		                      	  <td bgcolor="#fdfdf7">'.$pdf['CustomerFullNAME'].'</td>
		           	    </tr>
		                      	<tr bgcolor="#FFFFFF">
		                        <th align="left" bgcolor="#FFFFFF" class="tit">Type:</th>
		                        <td bgcolor="#FFFFFF"><span class="txt">'.$pdf['PumpType'].'</span></td>
		                        <td bgcolor="#FFFFFF">&nbsp;</td>
		                        <th align="left"><span class="tit">Address:</span></th>
		                        <td bgcolor="#FFFFFF">' . $pdf['CustomerADDRESS'] . '<br/>' . $pdf['CustomerCITY'] . '<br/> ' . $pdf['CustomerZipCODE'] .'</td>
		                      	</tr>
		                      	<tr bgcolor="#fdfdf7">
		                      	  <th align="left" bgcolor="#fdfdf7" class="tit">Pump Model:</th>
		                      	  <td bgcolor="#fdfdf7"><span class="txt">'.$pdf['PumpModel'].'</span></td>
		                      	  <td bgcolor="#FFFFFF">&nbsp;</td>
		                      	  <th align="left"><span class="tit">Email:</span></th>
		                      	  <td bgcolor="#fdfdf7">'.$pdf['CustomerLoginID'].'</td>
		           	    </tr>
		                      	<tr bgcolor="#FFFFFF">
		                      	  <th align="left" bgcolor="#FFFFFF" class="tit">Ref:</th>
		                      	  <td bgcolor="#FFFFFF"><span class="txt">'.$pdf['WarrantyClaimREF'].'</span></td>
		                      	  <td bgcolor="#FFFFFF">&nbsp;</td>
		                      	  <th align="left"><span class="tit">Phone:</span></th>
		                      	  <td bgcolor="#FFFFFF">'.$pdf['CustomerPHONE'].'</td>
		           	    </tr>
		                      	<tr bgcolor="#fdfdf7">
		                        <th align="left" bgcolor="#fdfdf7" class="tit">Distributor:</th>
		                        <td bgcolor="#fdfdf7"><span class="txt">'.$pdf['PumpDistrubutor'].'</span></td>
		                        <td bgcolor="#FFFFFF">&nbsp;</td>
		                        <th align="left"><span class="tit">Date:</span></th>
		                        <td bgcolor="#fdfdf7">'.$pdf['WarrantyClaimDate'].'</td>
		                      	</tr>
		                    	
		                
		                      	<tr>
		                      	  <th align="left" bgcolor="#fdfdf7" class="tit">&nbsp;</th>
		                      	  <td width="208" bgcolor="#fdfdf7">&nbsp;</td>
		                      	  <td width="45" bgcolor="#FFFFFF">&nbsp;</td>
		                      	  <td width="92" align="left" bgcolor="#fdfdf7">&nbsp;</td>
		                      	  <td width="341" bgcolor="#fdfdf7">&nbsp;</td>
		           	    </tr>
	  				</tbody>
				</table>
				<hr>
				<table width="800" align="center" cellspacing="1" class="table table-striped table-bordered">
				  <tbody>
				  <tr align="left">
				   	<th colspan="2" bgcolor="#F3F3F3"><h1 style="text-align: center">CLAIM SUMMARY</h1></th>
				   </tr>
				    <tr>
				      <th width="109" align="left" bgcolor="#fdfdf7" class="tit">Status:</th>
				      <td width="682" bgcolor="#fdfdf7" class="txt">'.$pdf['PumpStatus'].'</td>
				    </tr>
				    <tr>
				      <th align="left" class="tit">Notes:</th>
				      <td bgcolor="#FFFFFF" class="txt">'.$pdf['PumpStatusOther'].'</td>
				    </tr>
				    <tr>
				      <th align="left" bgcolor="#fdfdf7" class="tit">Installation:</th>
				      <td bgcolor="#fdfdf7" class="txt">'.$pdf['PumpInstallation'].'</td>
				    </tr>
				    <tr>
				      <th align="left" class="tit"> Notes:</th>
				      <td bgcolor="#FFFFFF" class="txt">'.$pdf['PumpInstallationOther'].'</td>
				    </tr>
				    <tr>
				      <th align="left" bgcolor="#fdfdf7" class="tit">Operation:</th>
				      <th align="left" bgcolor="#fdfdf7" class="txt">PSI|GPM|FLUID</th>
				    </tr>
				    <tr>
				      <th align="left" class="tit">&nbsp;</th>
				      <td bgcolor="#FFFFFF" class="txt">'.$pdf['PumpOperation'].'</td>
				    </tr>
				    <tr>
				      <th align="left" bgcolor="#fdfdf7" class="tit">Description:</th>
				      <td bgcolor="#fdfdf7" class="txt">'.$pdf['PumpProblemDescription'].'</td>
				    </tr>
				    <tr>
				      <th align="left" class="tit">Notes:</th>
				      <td bgcolor="#FFFFFF" class="txt">'.$pdf['PumpProblemDescriptionOther'].'</td>
				    </tr>
				    <tr align="left">
				      <th  colspan="2">&nbsp;</th>
				    </tr>
				    <tr align="left">
				      <th  colspan="2" bgcolor="#F3F3F3"><h1 style="text-align: center">RMA</h1></th>
				    </tr>
				    <tr align="left">
				      <th align="left" bgcolor="#fdfdf7">Warranty:</th>
				      <td bgcolor="#fdfdf7">' .$pdf['RmaWarranty'].  '-->' .$pdf['RmaAuthorizeTYPE']. '</td>
				    </tr>
				    <tr align="left">
				      <th align="left">Final Decision:</th>
				      <td>'	.$pdf['RmaAuthorizeDECISION']. '</td>
				    </tr>
				    <tr align="left">
				      <th align="left" bgcolor="#fdfdf7">Note to Client:</th>
				      <td bgcolor="#fdfdf7">'.$pdf['RmaAuthorizeNOTE'].'</td>
				    </tr>
				    <tr align="left">
				      <th align="left">Internal Notes:</th>
				      <td>'.$pdf['RmaInternalNOTE'].'</td>
				    </tr>
				    <tr align="left">
				      <th colspan="2">&nbsp;</th>
				    </tr>
				    <tr align="left">
				   	<th colspan="2" bgcolor="#F3F3F3"><h1 style="text-align: center">PRE-TEST</h1></th>
				   </tr>
				    <tr>
				      <th width="109" align="left" bgcolor="#fdfdf7" class="tit">&nbsp;</th>
				      <th width="682" align="left" bgcolor="#fdfdf7" class="txt">PSI|GPM|AMPS|NOISE</th>
				    </tr>
				    <tr>
				      <th align="left" class="tit">Shut Off:</th>
				      <td bgcolor="#FFFFFF" class="txt">'.$pdf['ShutOFF'].'</td>
				    </tr>
				    <tr>
				      <th align="left" bgcolor="#fdfdf7" class="tit">#1:</th>
				      <td bgcolor="#fdfdf7" class="txt">'.$pdf['One'].'</td>
				    </tr>
				    <tr>
				      <th align="left" class="tit">#2:</th>
				      <td bgcolor="#FFFFFF" class="txt">'.$pdf['Two'].'</td>
				    </tr>
				    <tr>
				      <th align="left" bgcolor="#fdfdf7" class="tit"> Open Discharge:</th>
				      <td bgcolor="#fdfdf7" class="txt">'.$pdf['OpenDISCHARGE'].'</td>
				    </tr>
				    <tr align="left">
				    	<th colspan="2"><br/><br/><!-- BREAK --></th>
				    </tr>
				    <tr align="left">
				    	<th colspan="2" bgcolor="#F3F3F3"><h1 style="text-align: center">TECHNICAL INSPECTION</h1></th>
				    </tr>
				    <tr align="left">
				      <td colspan="2"  bgcolor="#fdfdf7" class="txt">'.$pdf['ReportAfterTechnicalINSPECTION'].'</td>
				    </tr>
				  	<tr align="left">
				  	  <th colspan="2">&nbsp;</th>
				    </tr>
				  	<tr align="left">
				     <th colspan="2" bgcolor="#F3F3F3"><h1 style="text-align: center">LABOR PERFORMED</h1></th>
				    </tr>
				    <tr align="left">
				      <td colspan="2" bgcolor="#fdfdf7" class="txt">'.$pdf['LaborPERFORMED'].'</td>
				    </tr>
				    <tr align="left">
				      <th colspan="2">&nbsp;</th>
				    </tr>
				    <tr align="left">
				    	<th colspan="2" bgcolor="#F3F3F3"><h1 style="text-align: center">PARTS</h1></th>
				    </tr>
				    <tr align="left">
				      <th colspan="2" align="left" bgcolor="#fdfdf7" class="tit">Serial | Description | Quantity:</th>
				    </tr>
				    <tr align="left">
				      <td colspan="2" class="tit">'.$pdf['Code1'].'</td>
				    </tr>
				    <tr align="left">
				      <td colspan="2" bgcolor="#fdfdf7" class="tit">'.$pdf['Code2'].'</td>
				    </tr>
				    <tr align="left">
				      <td colspan="2" class="tit">'.$pdf['Code3'].'</td>
				    </tr>
				    <tr align="left">
				      <td colspan="2" bgcolor="#fdfdf7" class="tit">'.$pdf['Code4'].'</td>
				    </tr>
				  	<tr align="left">
				  	  <th colspan="2">&nbsp;</th>
				    </tr>
				  	<tr align="left">
				    	<th colspan="2" bgcolor="#F3F3F3"><h1 style="text-align: center">FINAL-TEST</h1></th>
				    </tr>
				    <tr>
				      <th width="109" align="left" bgcolor="#fdfdf7" class="tit">&nbsp;</th>
				      <td width="682" bgcolor="#fdfdf7" class="txt">PSI|GPM|AMPS|NOISE</td>
				    </tr>
				    <tr>
				      <th align="left" class="tit">Shut Off:</th>
				      <td align="left" bgcolor="#FFFFFF" class="txt">'.$pdf['FShutOFF'].'</td>
				    </tr>
				    <tr>
				      <th align="left" bgcolor="#fdfdf7" class="tit">#1:</th>
				      <td align="left" bgcolor="#fdfdf7" class="txt">'.$pdf['FOne'].'</td>
				    </tr>
				    <tr>
				      <th align="left" class="tit">#2:</th>
				      <td align="left" bgcolor="#FFFFFF" class="txt">'.$pdf['FTwo'].'</td>
				    </tr>
				    <tr>
				      <th align="left" bgcolor="#fdfdf7" class="tit"> Open Discharge:</th>
				      <td align="left" bgcolor="#fdfdf7" class="txt">'.$pdf['FOpenDISCHARGE'].'</td>
				    </tr>
				    <tr align="left">
				    	<th colspan="2"><br/><br/><!-- BREAK --></th>
				    </tr>
				  	<tr align="left">
				    	<th colspan="2" bgcolor="#F3F3F3"><h1 style="text-align: center">ATTACHED IMAGES</h1></th>
				    </tr>
				    <tr align="center">
				      <td colspan="2" class="txt">'.$productImage.'</td>
				    </tr>
				  </tbody>
				</table>';
	}

	# RETURN
	echo $reportResult;	
}


?>
		
