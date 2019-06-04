<div class="col-md-4 col-md-offset-7" style="margin-left: 25.333333%;width: 50%;">
	<div class="panel" style="background:#F3F3F3">	
		<div class="panel-body">
			<form class="form-horizontal" role="form" method="post" action="">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-3 control-label">Username</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="txtUserID" name="txtUserID" placeholder="USERNAME" required="">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-3 control-label">Password</label>
					<div class="col-sm-9">
						<input type="password" class="form-control" id="txtPass"  name="txtPass" placeholder="PASSWORD" required="">
					</div>
				</div>
				<div class="form-group">
      					<label for="accountType"  class="col-sm-3 control-label">Account</label>
      					 <div class="col-sm-9">
						<select class="form-control" id="accounType" name="accounType">
        						<option>Customer</option>
        						<option>Provider</option>
							<option>Technician</option>
        						<option>Administrator</option>
      						</select>
					</div>	
				</div>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
						<div class="checkbox">
							<label class="">
								<input type="checkbox" class="">Remember me</label>
						</div>
					</div>
				</div>
				<div class="form-group last">
					<div class="col-sm-offset-3 col-sm-9">
						<button type="submit" class="btn btn-success btn-sm" name="cmdLogin" value="Login">Sign in</button>
						<button type="reset" class="btn btn-default btn-sm">Reset</button>
					</div>
				</div>
			</form>
		</div>
		<div><a href="ForgotPassword.php" class="">Forgot Password</a>
		</div>
	</div>
</div>
