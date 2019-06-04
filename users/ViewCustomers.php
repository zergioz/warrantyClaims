<?php 
# start session 
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

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
		<div id="divHeader"><?php echo _TITLE_HEADER_DEFAULT_SHORT;?> : View Customers<p class=" lead text-right"i style="float:right;"><a href="<?php echo _BASE_URL ;?>/users/AddCustomers.php" class="btn btn-success btn-sm">Add Customer</a></p>
	</div>
	<hr>
		<?php $warranty->ViewCustomersList();?>
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer();?>
</body>
</html>
