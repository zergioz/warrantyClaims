<?php
# start session
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

# update claim status base on results we will update or insert record
$db=DBi::$conn->query("SELECT 			`tblNotification`.NotificationTYPE AS WARRANTY_TYPE, 
						`tblNotification`.NotificationBODY AS WARRANTY_NOTES 
		       FROM  	 `"._DB_NAME."`.`tblNotification`");

$new = array();

# fetch record
while($select=mysqli_fetch_array($db)){
	$new[] = array('WARRANTY_TYPE'=>$select['WARRANTY_TYPE'], 'WARRANTY_NOTES' =>$select['WARRANTY_NOTES']);
}

# Cleaning up the term
$term = trim(strip_tags($_GET['WARRANTY_TYPE']));

# Rudimentary search
$matches = array();

# parse and to build json object
foreach($new as $result){
	if(stripos($result['WARRANTY_TYPE'], $term) !== false){
		# Add the necessary "value" and "label" fields and append to result set
		$result['value'] =   $result['WARRANTY_TYPE'];
		$result['label'] = "{$result['WARRANTY_TYPE']}, {$result['WARRANTY_NOTES']}";
		$matches[] = $result;
	}
}
# Truncate, encode and return the results
$matches = array_slice($matches, 0, 5);

# print json object trumming [] as it give problems in some json.parsers
print substr(json_encode($matches),1,-1);
?>
