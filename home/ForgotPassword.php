<?php 
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
		<div class="col-md-4 col-md-offset-7" style="margin-left: 25.333333%;width: 50%;">
		<div class="panel panel-default">
			<div class="panel-heading"> <strong class="">Password Recovery</strong></div>
			<div class="panel-body" style=" margin-left: auto; margin-right: auto;">
				<form class="form-horizontal" role="form" method="post" action="<?php echo _BASE_URL ; ?>/home/frgtpassword.php">
					<div class="form-group" style=" margin-left: auto; margin-right: auto;" >

						<div>
							<input type="text" class="form-control" id="forget_email" name="forget_email" placeholder="USERNAME" required="">
						</div>
					</div>
					<div class="form-group last">
						<div>
							<button type="submit" class="btn btn-success btn-sm" name="forget_email_submit">Recover</button>
							<button type="reset" class="btn btn-default btn-sm">Reset</button>
						</div>
					</div>
				</form>
			</div>
			<div class="panel-footer">
				<a href="Login.php" class="">Login</a>
			</div>
			</div>
		</div>
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer();?>
<!-- end of Page -->
