<div class="col-md-4 col-md-offset-7" style="margin-left: 25.333333%;width: 50%;">
	<div class="panel">
		
		<div class="panel-body">
			<form class="form-horizontal" role="form" method="post" action="">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-3 control-label">Name</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="txtUserName" name="txtUserName" placeholder="[FULL NAME]" value="<?php echo $select["TechFullNAME"];?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-3 control-label">Username</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="txtUserID" name="txtUserID" placeholder="[USERNAME]" value="<?php echo $select["TechUserNAME"];?>" readonly>
					</div>
				</div>
				<div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Password</label>
                                        <div class="col-sm-9">
                                                <input type="text" class="form-control" id="txtPassword" name="txtPassword" placeholder="[PASSWORD]" value="">
                                        </div>
                                </div>
				<div class="form-group last">
					<div class="col-sm-offset-3 col-sm-9">
						<button type="submit" class="btn btn-success btn-sm" name="edittechuser">Update User</button>
						<button type="reset" class="btn btn-default btn-sm">Reset</button>
					</div>
				</div>
			</form>
		</div>
		
		</div>
	</div>
</div>
