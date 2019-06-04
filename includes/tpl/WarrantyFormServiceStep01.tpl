				
<form  method="post" action="<?php echo _BASE_URL?>/warranty/step2.php">
	<table border="0" summary="This table is used to format forms for pumps." align="center" class="table table-striped table-bordered">
		<caption align="top">PRE TEST RESULTS:</caption>
		<thead>
			<th></th>
			<th>PSI:</th>
			<th>GPM:</th>
			<th>AMPS:</th>
			<th>NOISE:</th>
		</thead>
		<tr>
			<th>SHUT OFF</th>
			<td><input name="txtUserID[]"  value="<?php  echo $ShutOFF[0];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
			<td><input name="txtUserID[]"  value="<?php  echo $ShutOFF[1];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
			<td><input name="txtUserID[]"  value="<?php  echo $ShutOFF[2];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
			<td><input name="txtUserID[]"  value="<?php  echo $ShutOFF[3];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
		</tr>
		<tr>
			<th># 1</th>
			<td><input name="txtUserone[]" value="<?php echo $numberone[0];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
			<td><input name="txtUserone[]" value="<?php echo $numberone[1];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
			<td><input name="txtUserone[]" value="<?php echo $numberone[2];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
			<td><input name="txtUserone[]" value="<?php echo $numberone[3];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
		</tr>
		<tr>
			<th># 2</th>
			<td><input name="txtUsertwo[]" value="<?php echo $numbertwo[0];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
			<td><input name="txtUsertwo[]" value="<?php echo $numbertwo[1];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
			<td><input name="txtUsertwo[]" value="<?php echo $numbertwo[2];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
			<td><input name="txtUsertwo[]" value="<?php echo $numbertwo[3];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
		</tr>
		<tr>
			<th>OPEN DISCHARGE</th>
			<td><input name="txtUseropen[]" value="<?php echo $opendisc[0];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
			<td><input name="txtUseropen[]" value="<?php echo $opendisc[1];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
			<td><input name="txtUseropen[]" value="<?php echo $opendisc[2];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
			<td><input name="txtUseropen[]" value="<?php echo $opendisc[3];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
		</tr>
		<tr>
			<td colspan="5"></td>
		</tr>
	</table>
		<hr>
		<!-- hidden value -->
		<input name="WarrantyClaimId" type="hidden" value="<?php echo $_REQUEST['WarrantyClaimId'];?>" />
		<input name="StartClaim" type="hidden" value="True" />
		<input name="StartClaimStep" type="hidden" value="2" />
		<input name="step2" type="hidden" value="step2" />
		<!-- buttons -->
		<div style="float:left; width:45%;">
		<a class="btn btn-primary btn-block" href="<?php echo _BASE_URL."/warranty/ViewClaimWarranty.php"?>">Back</a></div>
		<div style="float:right;width:45%;">
		<input type="submit" name="submit" value="Step Two" class="btn btn-success btn-block">
		</div>
</form>
