<?php
# start session
session_start();

#necessary files
include("../includes/WarrantyConfig.php");


# update claim status base on results we will update or insert record
$db=DBi::$conn->query("SELECT PartCODE as part, PartDESCRIPTION as description 
		       FROM  `"._DB_NAME."`.`tlbRepairPart`");

$new = array();

# fetch record
while($select=mysqli_fetch_array($db)){
	$new[] = array('part'=>$select['part'], 'description' =>$select['description']);
}

# Cleaning up the term
$term = trim(strip_tags($_GET['term']));

# Rudimentary search
$matches = array();
foreach($new as $part){
	if(stripos($part['part'], $term) !== false){
		// Add the necessary "value" and "label" fields and append to result set
		$part['value'] = $part['part'];
		$part['label'] = "{$part['part']}, {$part['description']}";
		$matches[] = $part;
	}
}
// Truncate, encode and return the results
$matches = array_slice($matches, 0, 5);
print json_encode($matches);
?>
