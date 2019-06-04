<?php 
#necessary files
include"../includes/html.php";
$html= new html();
#include header
echo $html->header();
?>
<!-- start page -->
<div id="divPage">
	<!-- guest sidebar -->
	<?php echo $html->guestsidebar();?>
	
	<div id="divBodyPanel" align="center" style="padding-top:100px;">
		<div id="divHeader">PD Water Systems : Warranties and Claims</div> 
		<hr>
		<?php if(isset($_GET['errorMssg'])){ ?>
	  <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $_GET['errorMssg']; ?></strong>
    </div>
	<?php } ?>
		<!-- include template to login -->
		<?php include"../includes/tpl/adminLogin.tpl";?>
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer();?>
<!-- end of Page -->
