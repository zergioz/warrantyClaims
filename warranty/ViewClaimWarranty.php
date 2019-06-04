<?php 
ini_set("display_errors", 0);


# start session
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

# check access 
if(!isset($_SESSION['cid']) && !isset($_SESSION['name'])){
  header('location: '._BASE_URL.'/home/Login.php');
}

#include header
echo $html->header();
?>
<body>
<div id="divPage">
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader"><?php echo _TITLE_HEADER_DEFAULT_SHORT;?> : Claims List </div>
		<hr></hr>
		<?php  $warranty->ViewClaimsList();?>	
	</div>
</div>
<!-- footer -->
<?php echo $html->footer(); ?>
</body>
</html>
