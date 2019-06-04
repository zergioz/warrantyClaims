<?php 
ini_set("display_errors", 1);

# start session
session_start();

# set buffer
ob_start();

#necessary files
include("../includes/WarrantyConfig.php");

#include header
echo $html->header();

?>
<!-- start page -->
<div id="divPage">
	<!-- guest sidebar -->
	<?php echo $html->sidebar();?>
	<div id="divBodyPanel" align="center">
		<div id="divHeader"><? echo _TITLE_HEADER_DEFAULT ;?></div>
		<hr>
		<?php $warranty->ViewMesg();?>
		<!-- include template to login -->
		<?php $warranty->ViewLogin();?>
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer();?>
<!-- end of Page -->
