<?php 
# start session
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

 #check access
if(!isset($_SESSION['ProviderID']) && !isset($_SESSION['ProviderNAME'])){
	header('location: '._BASE_URL.'/home/Login.php');
}


#include header
echo $html->header();
?>
<body>
<div id="divPage">
	<?php echo $html->psidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader">Warranty Claims : List </div>
		<hr>
		<?php $warranty->ViewProviderClaimsList();?>	
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer(); ?>
</body>
</html>
