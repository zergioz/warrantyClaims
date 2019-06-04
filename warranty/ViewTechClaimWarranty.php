<?php 
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
		<div id="divHeader">Warranty Claims : Details </div>
		<hr>
		<?php $warranty->ViewClaimsList();?>	
	</div>
</div>
<!-- end divPage -->
<?php include "../includes/PageFooter.php"; ?>
</body>
</html>
