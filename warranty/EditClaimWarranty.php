<?php 
# start session 
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

#include header
echo $html->header();
?>
<body>
<div id="divPage">
	<!-- side bar -->
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel">
		<div id="divHeader"><?php echo _TITLE_HEADER_DEFAULT;?></div>
		<hr>
		<!-- include form templates -->
		<?php  $warranty->ViewEditClaimForm();?>
	</div>
</div>
<!-- footer -->
<?php echo $html->footer(); ?>
</body>
</html>
