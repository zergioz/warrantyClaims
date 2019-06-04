<?php
	if(isset($_POST["submit"])){

		echo "HERE";
		exit();
		$secret_key=$_GET['newpass'];
		$password=$_POST["re_new_password"];
		$sqlh = "UPDATE tblCustomers SET cCustomerPassword='$password' WHERE cSecret_key='$secret_key'";
		 // Selecting Database
		$conn = mysqli_connect('localhost', 'pwswarranty', 'P@ssword305!','pws_warranty') or die( "warranty system: Can't connect to server.<br>". mysql_error());
		$results=mysql_query($conn,$sqlh);
		header("location: Login.php?errorMssg=".urlencode("Now Login with your new Password."));

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
			alert("Passwords Match!!!");
		}
		return ok;
	}
</script>
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
		PD Water Systems - Warranties and Claims 
		<hr>
		<!-- include template to login -->
		<div class="col-md-4 col-md-offset-7" style="margin-left: 25.333333%;width:60%;">
		<div class="panel panel-default">
			<div class="panel-heading"> <strong class="">Password Recovery</strong>

			</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" method="post" action="<?php echo _BASE_URL ; ?>/home/frgtpassword.php">
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
