<?php 
# staart session 
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

#include header
echo $html->header();
	# vars
	$id=$_GET['id'];
	$path = $_SERVER['DOCUMENT_ROOT'] ."/images/productImages/";
	$valid_formats = array("jpg", "png", "jpeg", "JPG", "JPEG","PNG");
	$max_file_size = 1024*100*50; //100 kb
	$count = 0;
	$dbimagename=array();

	# post to save image
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		
		# Loop $_FILES to exeicute all files
		foreach ($_FILES['files']['name'] as $f => $name) {     
		    if ($_FILES['files']['error'][$f] == 4) {
		        continue; // Skip file if any error found
		    }	       
		    if ($_FILES['files']['error'][$f] == 0) {	           
		        if ($_FILES['files']['size'][$f] > $max_file_size) {
		            $message[] = "$name is too large!.";
		            continue; // Skip large files
		        }
				elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
					$message[] = "$name is not a valid format";
					continue; // Skip invalid file formats
				}
		        else{ // No error found! Move uploaded files 
		        	$rand=mt_rand(1,1100000);
		        	$basename=basename($rand.$name);
		        	$target_file = $path . $basename;
		        	$dbimagename[]=$basename;
		            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $target_file))
		            $count++; // Number of successfully uploaded file
		        }
		    }
		}
	}
	# split image array by |
	$fimage=array();
	foreach ($dbimagename as $value) {
		$fimage[]=$value;
	}
	$image = implode("|", $fimage);

	# execute query to update claim id with image data	
	$Result = DBi::$conn->prepare("UPDATE  			 `"._DB_NAME."`.`tblWarrantyClaim` 
				       SET 					`tblWarrantyClaim`.`productImage`	= ?  
			     	       WHERE 					`tblWarrantyClaim`.`WarrantyClaimId`	= ? ");	

	

	 # bind results as mysqlnd driver is not istalled
         $Result->bind_param("ss",$image,$id);

         # run query
         $Result->execute();

	  
	 if (isset($_POST["submit"])){

		if (isset($_SESSION["myid"]) AND isset($_SESSION["cid"])){
                        header('location: '._BASE_URL.'/warranty/ViewClaimWarranty.php');
                }elseif (isset($_SESSION["tech_id"]) AND isset($_SESSION["customername"])){
			header('location: '._BASE_URL.'/warranty/ViewTechClaimWarranty.php');
		}elseif (isset($_SESSION["customerid"]) AND !isset($_SESSION["tech_id"])){
                        header('location: '._BASE_URL.'/warranty/ViewCustomersClaims.php');
                }else{
                	# redirect to warranty form 
			header('location: '._BASE_URL.'/warranty/SubmitClaimWarranty.php?SuccessMsg='._CLAIM_CREATION_SUCCESS.'');
		}
	}
?>
<body>
<div id="divPage">
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader">Submit Warranty Claim Form</div>
		<!-- include form templates -->
		 <ul class="list-group">
                          <li class="list-group-item list-group-item-danger">Only JPG,JPEG,PNG Images are allowed.</li>
                          <li class="list-group-item list-group-item-danger">No More than 5 MB in size.</li>
                        </ul>
		<form action="" method="POST" enctype="multipart/form-data">
			<table class="table">
				<tr>
					<td><input type="file" name="files[]"></td>
				<tr>
				<tr>
					<td><input type="file" name="files[]"></td>
				<tr>
				<tr>
					<td><input type="file" name="files[]"></td><tr>
				<tr>
					<td><input type="file" name="files[]"></td><tr>
				<tr>
					<td><input type="file" name="files[]"></td><tr>
				<tr>
					<td><input type="hidden" value="<?php echo $id ;?>"  name="id"></td><tr>
				<tr>
					<td><input type="submit" class="btn btn-primary btn-sm" name="submit" value="Submit Claim"></td>
				<tr>
			</table>
		</form>
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer(); ?>
</body>
</html>
