<?php 
# debug
ini_set("display_errors", 1);

# start session
session_start();
		
#necessary files
include("WarrantyConfig.php");
include("dompdf/dompdf_config.inc.php");

#check access
if(!isset($_SESSION['ProviderID']) && !isset($_SESSION['ProviderNAME'])){
       header('location: '._BASE_URL.'/home/Login.php');
}


if(isset($_GET['claimid'])){
	$id=$_GET['claimid'];
	$selectpdf =DBi::$conn->query("SELECT * FROM `"._DB_NAME."`.`tblWarrantyClaim` WHERE WarrantyClaimId=$id");
	while ($pdf = mysqli_fetch_array($selectpdf) ){
		$selectcus =DBi::$conn->query("SELECT * FROM `"._DB_NAME."`.`tblCustomer` WHERE CustomerID=$pdf[CustomerId]");
		while ($customer = mysqli_fetch_array($selectcus) ){	
			# I have not cliue the point of this snippet	
			if(isset($pdf['productImage'])){
				# check for images			
				$productImageRaw=$pdf['productImage'];
			
				# parse images in arrar if more than one
				$productImage_Array =  explode( '|',$productImageRaw );
			
				$productImage = '';		
				# sert array into images
				foreach ($productImage_Array as $value) {
					$productImage .= "<img src='http://".$_SERVER['HTTP_HOST']."/images/productImages/".$value."'><br/>";
				}												
							
			} else {
				$productImage="No Image Uploaded";
			}
								
	$html='<html>
			<head>
			<title>PUMPS WARRANTY PDF</title>
			<style>body { color: #7d7a7a; }</style>
			</head>
			<body>
				<table class="table" width="100%">
					<tr>
						<td colspan="3" width="50%">CLAIMID : '.$id.'</td>
						<td></td>
						<td colspan="3" width="50%">DATE: '.$pdf['WarrantyClaimDate'].'</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="6" width="100%"><hr></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</table>
				<table class="table" width="100%">
                 
					<tr>
						<td  colspan="3" width="20%">DISTRIBUTOR:</td>
						<td  colspan="3"  width="80%">'.$pdf['PumpDistrubutor'].'</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td  colspan="3" width="20%">REF:</td>
						<td  colspan="3" width="80%">'.$pdf['WarrantyClaimREF'].'</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td  colspan="3" width="20%">PUMP MODEL:</td>
						<td  colspan="3" width="80%">'.$pdf['PumpType'].'</td>
						<td></td>
                                                <td></td>
					</tr>	
					<tr>
						<td  colspan="3" width="20%">RECEIVED PUMP STATUS:</td>
						<td  colspan="3" width="80%">'.$pdf['PumpStatus'].'</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3" width="20%">INSTALLATION DESCRIPTION:</td>
						<td colspan="3" width="80%">'.$pdf['PumpInstallation'].'</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3" width="20%">PROBLEM DESCRIPTION:</td>
						<td colspan="3" width="80%">'.$pdf['PumpProblemDescription'].'</td>
				                <td></td>
					        <td></td>
					</tr>
				</table>
				<table class="table" width="100%">
					<tr>
                                        	<td alight="center" width="100%">UPLOADED IMAGES</td>
                                        </tr>
					<tr>
                                        	<td style="width:100%">'.$productImage.'</td>
                                       </tr>
				</table>
			</body>
		</html>';
						
			}
		}
	
	# create pdf output	
	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->render();
	$pdfoutput = $dompdf->output(); 
	$dompdf->stream("warrantyClaim".$id.".pdf");
	//echo $html;	
	//header('location: ../warranty/uploadimages.php?id='.$id);
}
?>
		
