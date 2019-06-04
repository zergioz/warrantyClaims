<form id="form" name="form" method="post" action="" enctype="multipart/form-data">
	<TABLE border="0" summary="This table is used to format forms for pumps." align="center">
		<tr>
			<td colspan="5"><strong>CUSTOMER [DISTRIBUTOR] INFORMATION</strong></td>
		</tr>
		<tr>
			<td colspan="1">
				<input name="DISTRIBUTOR" type="text" maxlength="20" size="4" class="form-control" required  placeholder="[COMPANY NAME]" value="<?php echo $this->CLAIM_PUMP_DISTRIBUTOR;?>" title="DISTRIBUTOR"/>
			</td>
                </tr>
		<tr>
			<td colspan="1">
				<input name="CUSTOMER_FNAME"  type="text"  maxlength="40" size="10"  class="form-control"  required placeholder="[FIRST NAME]" value="<?php echo $this->CUSTOMER_FIRST_NAME;?>" readonly title="CUSTOMER FIRST NAME"/>
			</td>
			<td colspan="1">
				<input name="CUSTOMER_LNAME"  type="text"  maxlength="40" size="10"  class="form-control"  required placeholder="[LAST NAME]"  value="<?php echo $this->CUSTOMER_LAST_NAME;?>" readonly title="CUSTOMER LAST NAME"/>
			</td>
			<td colspan="1">
				<input name="CUSTOMER_EMAIL"  type="email" maxlength="40" size="36"  class="form-control"  required placeholder="[EMAIL]"      value="<?php echo  $this->CUSTOMER_LOGIN_ID;?>" readonly title="CUSTOMER EMAIL"/>
			</td>
		</tr>
		<tr>
			<td colspan="5"></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="1">
				<input name="CUSTOMER_ADDRESS" type="text" maxlength="40" size="10" class="form-control"   required placeholder="[ADDRESS]" value="<?php echo $this->CUSTOMER_ADDRESS;?>" readonly title="CUSTOMER ADDRESS"/>
			</td>
			<td colspan="1">
				<input name="CUSTOMER_CITY"    type="text" maxlength="40" size="10" class="form-control"   required placeholder="[CITY]"    value="<?php echo $this->CUSTOMER_CITY;?> " readonly title="CUSTOMER CITY" />
			</td>
			<td colspan="1">
				<input name="CUSTOMER_PHONE"   type="text" maxlength="40" size="10" class="form-control"   required placeholder="[PHONE]"   value="<?php echo $this->CUSTOMER_PHONE;?>" readonly title="CUSTOMER PHONE" />
			</td>
		</tr>
		<tr>
			<td colspan="5">
				<hr>
			</td>	
		</tr>
		<tr>
                	<td colspan="5"><strong>CLIENT [CONTRACTOR/INSTALLERS/DEALER/OTHER] INFORMATION</strong></td>
                        <td></td>
		</tr>
                <tr>
                	<td colspan="1"><input name="PARTY_COMPANY" type="text" maxlength="20" size="4" class="form-control" required  placeholder="[COMPANY NAME]" value="<?php echo $this->PARTY_COMPANY;?>" title="CLIENT"/></td>
                        <td>    <select name="PARTY_TYPE" class="form-control" required="" style="width: 200px;" title="CLIENT TYPE">
                        	        <option value="" selected="" style="display:none;">[CLIENT TYPE]</option>
                                        <option value="CONTRACTOR" <?php echo $this->SelectedOption('CONTRACTOR',$this->PARTY_TYPE); ?>>Contractor</option>
                                        <option value="INSTALLER"  <?php echo $this->SelectedOption('INSTALLER',$this->PARTY_TYPE);  ?>>Installer</option>
                                        <option value="ENDUSER"    <?php echo $this->SelectedOption('ENDUSER',$this->PARTY_TYPE);    ?>>EndUser</option>
                                        <option value="OEM"        <?php echo $this->SelectedOption('OEM',$this->PARTY_TYPE);        ?>>OEM</option>
                                        <option value="DEALER"     <?php echo $this->SelectedOption('DEALER',$this->PARTY_TYPE);     ?>>Dealer</option>
                               </select>
                      </td>
		</tr>
             	<tr>
                      <td colspan="1"><input name="PARTY_FNAME"  type="text"  maxlength="40" size="10"  class="form-control"  required placeholder="[FIRST NAME]" value="<?php echo $this->PARTY_FNAME;?>" title="CLIENT FIST NAME"/></td>
                      <td colspan="1"><input name="PARTY_LNAME"  type="text"  maxlength="40" size="10"  class="form-control"  required placeholder="[LAST NAME]"  value="<?php echo $this->PARTY_LNAME;?>" title="CLIENT LAST NAME"/></td>
                      <td colspan="1"><input name="PARTY_PHONE"  type="tel"  maxlength="40" size="36"  class="form-control"  required placeholder="[PHONE]"       value="<?php echo $this->PARTY_PHONE;?>" title="CLIENT PHONE NUMBER"/></td>
            	</tr>
           	<tr>
            		<td colspan="5"><hr></td>
		</tr>
		<tr>
                	<td colspan="5"><strong>PUMP INFORMATION</strong></td>
		</tr>
		<tr>
			<td><?php $this->ExecuteProviderList($this->CLAIM_PUMP_PROVIDER);?></td>
			<td>
				<input name="PUMP_SERIAL" type="text" maxlength="60" size="4" class="form-control"  placeholder="[SERIAL #]" value="<?php echo $this->PUMP_SERIAL;?>" title="PUMP SERIAL NUMBER"/>
			</td>					
			<td colspan="1">
				<input name="REF" type="text" maxlength="60" size="20" class="form-control" placeholder="[REF #: INVOICE / P.O]"	value="<?php echo $this->CLAIM_REF;?>" title="PUMP REF NUMBER"/>
			</td>
		</tr>
		<tr>
			<td colspan="1">
				<input name="PUMP_MODEL" type="text" maxlength="40" size="26" class="form-control" placeholder="[PUMP MODEL]"     value="<?php echo $this->PUMP_MODEL;?>" title="PUMP MODEL NUMBER"/>
			</td>
		</tr>
		<tr>
			<td colspan="5">
				<hr>
			</td>	
		</tr>
		<tr>
			<td colspan="5">
				<strong>RECEIVED PUMP STATUS</strong>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_STATUS[]" type="checkbox" value="VISIBILY BEEN INSTALLED"	<?php echo $this->Checked('VISIBILY BEEN INSTALLED',$this->CLAIM_PUMP_STATUS);?> />VISIBILY BEEN INSTALLED:
			</td>
			<td colspan="2">
				<input name="PUMP_STATUS[]" type="checkbox" value="TERMINAL BOX BROKEN OR CRACKED"  <?php echo $this->Checked('TERMINAL BOX BROKEN OR CRACKED',$this->CLAIM_PUMP_STATUS);?>/>TERMINAL BOX BROKEN OR CRACKED:
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_STATUS[]" type="checkbox" value="THREAD SEALER TRACES"	<?php echo $this->Checked('THREAD SEALER TRACES',$this->CLAIM_PUMP_STATUS);?>	/>THREAD SEALER TRACES:
			</td>
			<td colspan="2">
				<input name="PUMP_STATUS[]" type="checkbox" value="ACCESORY BROKEN OR CRACKED"	<?php echo $this->Checked('ACCESORY BROKEN OR CRACKED',$this->CLAIM_PUMP_STATUS);?>	/>ACCESORY BROKEN OR CRACKED:
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_STATUS[]" type="checkbox" value="FOOT LOST OR BROKEN"		<?php echo $this->Checked('FOOT LOST OR BROKEN',$this->CLAIM_PUMP_STATUS);?>/>FOOT LOST OR BROKEN:
			</td>
			<td colspan="2">
				<input name="PUMP_STATUS[]" type="checkbox" value="FAN COVER BROKEN OR CRACKED"	<?php echo $this->Checked('FAN COVER BROKEN OR CRACKED',$this->CLAIM_PUMP_STATUS);?>/>FAN/FAN COVER BROKEN OR CRACKED:
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_STATUS[]" type="checkbox" value="PUMP BODY BROKEN OR CRACKED"	<?php echo $this->Checked('PUMP BODY BROKEN OR CRACKED',$this->CLAIM_PUMP_STATUS);?>	/>PUMP BODY BROKEN OR CRACKED:
			</td>
			<td colspan="2">
				<input name="PUMP_STATUS[]" type="checkbox" value="MOTOR BROKEN OR CRACKED"	<?php echo $this->Checked('MOTOR BROKEN OR CRACKED',$this->CLAIM_PUMP_STATUS);?>	/>MOTOR BROKEN OR CRACKED:
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_STATUS[]" type="checkbox" value="GOOD CONDITION"	<?php echo $this->Checked('GOOD CONDITION',$this->CLAIM_PUMP_STATUS);?>	/>GOOD CONDITION:
			</td>
			<td colspan="2">
				<input name="PUMP_STATUS[]" type="checkbox" value="PUMP CONTROLLER BROKEN OR CRAKED"	<?php echo $this->Checked('PUMP CONTROLLER BROKEN OR CRAKED',$this->CLAIM_PUMP_STATUS);?>	/>PUMP CONTROLLER BROKEN OR CRAKED:
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="5">
				<input name="PUMP_STATUS_OTHER" type="text" size="80" class="form-control"  placeholder="[OTHER/NOTES]" value="<?php echo $this->CLAIM_PUMP_STATUS_OTHER;?>" title="PUMP STATUS NOTES" style="text-transform:uppercase">
			</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="5">
				<hr>
			</td>	
		</tr>
		<tr>
			<td colspan="5">
				<strong>INSTALLATION DESCRIPTION</strong>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2"><u>APPLICATION</u></td>
			<td colspan="2"><u>CONDITION</u></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_INSTALLATION[]" type="checkbox" value="IRRIGATION SYSTEM"	 <?php echo $this->Checked('IRRIGATION SYSTEM',$this->CLAIM_PUMP_INSTALLATION);?>	/>IRRIGATION SYSTEM
			</td>
			<td colspan="2">
				<input name="PUMP_INSTALLATION[]" type="checkbox" value="OUTDOOR"	<?php echo $this->Checked('OUTDOOR',$this->CLAIM_PUMP_INSTALLATION);?>	/>OUTDOOR
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_INSTALLATION[]" type="checkbox" value="WELL SYSTEM"	<?php echo $this->Checked('WELL SYSTEM',$this->CLAIM_PUMP_INSTALLATION);?>	/>WELL SYSTEM
			</td>
			<td colspan="2">
				<input name="PUMP_INSTALLATION[]" type="checkbox" value="INDOOR"	<?php echo $this->Checked('INDOOR',$this->CLAIM_PUMP_INSTALLATION);?>	/>INDOOR
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_INSTALLATION[]" type="checkbox" value="MACHINE OEM PRODUCT CONDITION"	<?php echo $this->Checked('MACHINE OEM PRODUCT CONDITION',$this->CLAIM_PUMP_INSTALLATION);?>	/>MACHINE OEM PRODUCT CONDITION
			</td>
			<td colspan="2">
				<u>SUCTION CONDITION</u>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_INSTALLATION[]" type="checkbox" value="BOOSTING SYSTEM"	<?php echo $this->Checked('BOOSTING SYSTEM',$this->CLAIM_PUMP_INSTALLATION);?>	/>BOOSTING SYSTEM
			</td>
			<td colspan="2">
				<input name="PUMP_INSTALLATION[]" type="checkbox" value="LIFTING FROM A POND"	 <?php echo $this->Checked('LIFTING FROM A POND',$this->CLAIM_PUMP_INSTALLATION);?>	/>LIFTING FROM A POND
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_INSTALLATION[]" type="checkbox" value="BOOSTING PRESSURE COMING FROM OTHER PUMP"	 <?php echo $this->Checked('BOOSTING PRESSURE COMING FROM OTHER PUMP',$this->CLAIM_PUMP_INSTALLATION);?>	/>BOOSTING PRESSURE COMING FROM OTHER PUMP
			</td>
			<td colspan="2">
				<input name="PUMP_INSTALLATION[]" type="checkbox" value="LIFTING FROM A WELL"	<?php echo $this->Checked('LIFTING FROM A WELL',$this->CLAIM_PUMP_STATUS);?>	/>LIFTING FROM A WELL
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td colspan="2">
				<input name="PUMP_INSTALLATION[]" type="checkbox" value="FLOODED SUCTION"	<?php echo $this->Checked('FLOODED SUCTION',$this->CLAIM_PUMP_INSTALLATION);?>	/>FLOODED SUCTION
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td colspan="2">
				<input name="PUMP_INSTALLATION[]" type="checkbox" value="CITY PRESSUR"	<?php echo $this->Checked('CITY PRESSUR',$this->CLAIM_PUMP_INSTALLATION);?>	/>CITY PRESSURE
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<u>OPERATION</u>
			</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>
				<input name="PUMP_OPERATION['PSI']" 	type="text"  maxlength="6" size="4"  class="form-control" placeholder="[PRESSURE (PSI)]"	value="<?php echo $this->CLAIM_PUMP_OPERATION_PSI;?>"	/>
			</td>
			<td>
				<input name="PUMP_OPERATION['GPM']" 	type="text"  maxlength="6" size="4"  class="form-control" placeholder="[FLOW (GPM)]"	value="<?php echo $this->CLAIM_PUMP_OPERATION_GPM;?>"		/>
			</td>
			<td>
				<input name="PUMP_OPERATION['LIQUID_TYPE']" type="text"  maxlength="60" size="4"  class="form-control" placeholder="[LIQUID TYPE]"	value="<?php echo $this->CLAIM_PUMP_OPERATION_LIQUID;?>"	/>
			</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="5">
				<input name="PUMP_INSTALLATION_OTHER" type="text" size="80"  class="form-control" placeholder="[OTHER/NOTES]" value="<?php echo $this->CLAIM_PUMP_INSTALLATION_OTHER;?>" title="PUMP INSTALLATION NOTES" style="text-transform:uppercase">
			</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="5">
				<hr>
			</td>	
		</tr>
		<tr>
			<td colspan="5">
				<strong>PROBLEM DESCRIPTION</strong>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="THE PUMP DOES NOT MEET THE PRESSURE"  <?php echo $this->Checked('THE PUMP DOES NOT MEET THE PRESSURE',$this->CLAIM_PUMP_PROBLEM_DESCRIPTION);?>/>THE PUMP DOES NOT MEET THE PRESSURE
			</td>
			<td colspan="2">
				<input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="THE MOTOR HUMS" <?php echo $this->Checked('THE MOTOR HUMS',$this->CLAIM_PUMP_PROBLEM_DESCRIPTION);?>/>THE MOTOR - HUMS
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="THE PUMP DOES NOT MEET THE FLOW" <?php echo $this->Checked('THE PUMP DOES NOT MEET THE FLOW',$this->CLAIM_PUMP_PROBLEM_DESCRIPTION);?>/>THE PUMP DOES NOT MEET THE FLOW
			</td>
			<td colspan="2">
				<input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="THERE IS LEAK COMING OUT OF THE" <?php echo $this->Checked('THERE IS LEAK COMING OUT OF THE',$this->CLAIM_PUMP_PROBLEM_DESCRIPTION);?>/>THERE IS LEAK COMING OUT OF THE
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="THE PUMP MAKES NOISE" <?php echo $this->Checked('THE PUMP MAKES NOISE',$this->CLAIM_PUMP_PROBLEM_DESCRIPTION);?>/>THE PUMP MAKES NOISE
			</td>
			<td colspan="2">
				<input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="MECHANICAL SEAL" <?php echo $this->Checked('MECHANICAL SEAL',$this->CLAIM_PUMP_PROBLEM_DESCRIPTION);?>/>MECHANICAL SEAL
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="INLET" <?php echo $this->Checked('INLET',$this->CLAIM_PUMP_PROBLEM_DESCRIPTION);?>/>INLET
			</td>
			<td colspan="2">
				<input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="OUTLET" <?php echo $this->Checked('OUTLET',$this->CLAIM_PUMP_PROBLEM_DESCRIPTION);?>/>OUTLET
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="THE PUMP DOES NOT START" <?php echo $this->Checked('THE PUMP DOES NOT START',$this->CLAIM_PUMP_PROBLEM_DESCRIPTION);?>/>THE PUMP DOES NOT START
			</td>
			<td colspan="2">
				<input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="BACK COVER" <?php echo $this->Checked('BACK COVER',$this->CLAIM_PUMP_PROBLEM_DESCRIPTION);?>/>BACK COVER
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="BOOSTING PRESSURE COMING FROM OTHER PUMP" <?php echo $this->Checked('BOOSTING PRESSURE COMING FROM OTHER PUMP',$this->CLAIM_PUMP_PROBLEM_DESCRIPTION);?>/>BOOSTING PRESSURE COMING FROM OTHER PUMP
			</td>
			<td colspan="2">
				<input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="LIFTING FROM A WELL" <?php echo $this->Checked('LIFTING FROM A WELL',$this->CLAIM_PUMP_PROBLEM_DESCRIPTION);?>/>LIFTING FROM A WELL
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="THE SYSTEM DOES NOT START" <?php echo $this->Checked('THE SYSTEM DOES NOT START',$this->CLAIM_PUMP_PROBLEM_DESCRIPTION);?>/>THE SYSTEM DOES NOT START
			</td>
			<td colspan="2">
				<input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="MOTOR DRAWS HIGH AMPS" <?php echo $this->Checked('MOTOR DRAWS HIGH AMPS',$this->CLAIM_PUMP_PROBLEM_DESCRIPTION);?>/>MOTOR DRAWS HIGH AMPS
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="5">
				<input name="PUMP_PROBLEM_DESCRIPTION_OTHER" type="text"/ size="80"  class="form-control" placeholder="[OTHER/NOTES]" value="<?php echo $this->CLAIM_PUMP_PROBLEM_DESCRIPTION_OTHER;?>" title="PUMP DESCRIPTION NOTES" style="text-transform:uppercase">
			</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<!-- include only admin section -->
		<?php  $this->ViewEditClaimFormAdmin();?>
		<!-- admin section ends --> 
	</table>
	<hr>
	<br/>
	<!-- hidden value -->
	<input name="cmdClaim" type="hidden" value="Review Claim" />
	<!-- send claim information to be processed -->
	<div style="float:left;  width:45%;">
		<a      class="btn btn-primary btn-block" href="../warranty/ViewClaimWarranty.php?ViewClaimDetails=1&WarrantyClaimId=<?php echo $this->CLAIM_ID;?>">Back</a>
	</div>
	<div style="float:right;  width:45%;">
		<a      class="btn btn-warning btn-block"  href="#" onclick="document.form.submit()">Save Review</a>		
	</div>
</form>
<!-- JS -->
<script type="text/javascript">
$(function() {

	/* PUMP */
	$('input[name="ADMIN_PUMP_CODE_DATE"]').daterangepicker({
        	singleDatePicker: true,
        	showDropdowns: true,
		locale: {
            		format: 'YYYY-MM-DD'
		}
	});

	/* MOTOR */
        $('input[name="ADMIN_PUMP_MOTOR_CODE_DATE"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                        format: 'YYYY-MM-DD'
                }
        });

	 /* RETURNED */
        $('input[name="ADMIN_PUMP_RETURENED_DATE"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                        format: 'YYYY-MM-DD'
                }
        });
	


});
</script>
