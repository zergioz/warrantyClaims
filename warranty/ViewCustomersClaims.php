<?php 
# start session
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

# check access
if(!isset($_SESSION['customerid']) && !isset($_SESSION['customername'])){
  header('location: '._BASE_URL.'/home/Login.php');
}

#include header
echo $html->header();
?>
<body>
<div id="divPage">
	<?php echo $html->csidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader">Warranty Claims : List </div>
		<hr>
		<?php $warranty->ViewCustomerClaimsList();?>	
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer(); ?>
</body>
</html>
