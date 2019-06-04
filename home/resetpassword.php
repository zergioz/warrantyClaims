<?php
# start session
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

# check for post to update with new passrod
if(isset($_POST["forget_email"])){

	#SQL string to update based on CustomerSECRET 
	$Result=DBi::$conn->prepare(" 	UPDATE 	`"._DB_NAME."`.`tblCustomer`
        	    	    		SET    		       `tblCustomer`.`CustomerPASSWORD` = md5( ? )
                            		WHERE   	       `tblCustomer`.`CustomerSECRET`   =      ? ");
		

	# bind results as mysqlnd driver is not istalled
        $Result->bind_param("ss",$_POST['re_new_password'],$_GET['newpass']);

     
        # run query
        $Result->execute();  
	
	# redirent to login sreen 
	header("location: Login.php?SucessMsg=".urlencode("Now Login with your new Password."));

}
?>

<script type="text/javascript">
	function myFunction(form) {
		var pass1 = document.getElementById("new_password").value;
		var pass2 = document.getElementById("re_new_password").value;
		var ok = true;
		if (pass1 != pass2) {
			alert("Passwords Do not match");
			document.getElementById("new_password").style.borderColor = "#E34234";
			document.getElementById("re_new_password").style.borderColor = "#E34234";
			ok = false;
		}
		else {
			alert("Your password has been changed");
		}
		return ok;
	}
</script>
<?php
#include header 
echo $html->header();
?>
<!-- start page -->
<div id="divPage">
	<!-- guest sidebar -->
	<?php echo $html->guestsidebar();?>
	<div id="divBodyPanel" align="center" style="padding-top:100px;">
		 <div id="divHeader"><?php echo _TITLE_HEADER_DEFAULT;?>  </div>	
		<hr>
		<!-- include template to login -->
		<div class="col-md-4 col-md-offset-7" style="margin-left: 25.333333%;width:60%;">
		<div class="panel panel-default">
			<div class="panel-heading"> <strong class="">Password Recovery</strong>

			</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" method="post" action="">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">Password</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="new_password" name="new_password" placeholder="Password" required="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">Re Password</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="re_new_password" name="re_new_password" placeholder="RE Password" required="">
						</div>
					</div>
					
					<div class="form-group last">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-success btn-sm" name="forget_email" onclick="return myFunction(this)">Recover</button>
							<button type="reset" class="btn btn-default btn-sm">Reset</button>
						</div>
					</div>
				</form>
			</div>
			</div>
		</div>
		</div>
	</div>
</div>
<!-- end divPage -->
<?php echo $html->footer();?>
<!-- end of Page -->		
