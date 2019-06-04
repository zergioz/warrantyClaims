<?php
ini_set("display_errors", 1);

# start session
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

# update claim status base on results we will update or insert record
$db=DBi::$conn->query(" SELECT                   `tblUser`.`UserFullNAME`
                        FROM      `"._DB_NAME."`.`tblUser`
			ORDER BY 		 `tblUser`.`UserID` ASC;");

# quick way to json encode - issues with dev env  -create array and run json_encode 
echo "[";
while($select=mysqli_fetch_array($db)){
	
       echo '"'.$select['UserFullNAME'].'",';
}
echo '"empty"]';

?>

