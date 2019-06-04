<form id="form1" name="form1" method="post" action="">
	<table border="0" summary="This table is used to format forms for pumps." align="center" class="table table-striped table-bordered">
		<caption align="top">FINAL TEST RESULTS:</caption>
		<thead>
			<th></th>
			<th>PSI:</th>
			<th>GPM:</th>
			<th>AMPS:</th>
			<th>NOISE:</th>
		</thead>
		<tr>
			<th>SHUT OFF</th>
			<td><input name="txtUserID[]" value="<?php echo $shutoff[0];?>" type="text" id="txtUserID" maxlength="6" size="4" /></td>
			<td><input name="txtUserID[]" value="<?php echo $shutoff[1];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
			<td><input name="txtUserID[]" value="<?php echo $shutoff[2];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
			<td><input name="txtUserID[]" value="<?php echo $shutoff[3];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
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
			<td><input name="txtUseropen[]" value="<?php echo $opendisc[0];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
			<td><input name="txtUseropen[]" value="<?php echo $opendisc[0];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
			<td><input name="txtUseropen[]" value="<?php echo $opendisc[0];?>" type="text" id="txtUserID" maxlength="6" size="4"/></td>
		</tr>
		<tr>
			<td colspan="5"></td>
		</tr>
	</table>
	<hr>
	<input name="WarrantyClaimId" type="hidden" value="<?php echo $_REQUEST['WarrantyClaimId'];?>" />
	<!-- buttons -->
	<div style="float:left; width:45%;">
		<a class="btn btn-primary btn-block" href="<?php echo _BASE_URL?>/warranty/ViewClaimWarranty.php">Back</a></div>
		<div style="float:right;width:45%;">
			<?php $warranty->FinalizeReviewWork();?>
		
	</div>
</form>
