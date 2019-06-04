<form id="form" name="form" method="post" action="" enctype="multipart/form-data">
			<TABLE border="0" summary="This table is used to format forms for pumps." align="center">
				<tr>
					<td colspan="5"><hr></td>
				</tr>

				<tr>
					<td colspan="5"><strong>CUSTOMER [DISTRIBUTOR] INFORMATION</strong></td>
					<td><input name="PUMP_TYPE" type="hidden" value="<?php echo $_REQUEST["selectpumptype"] ;?>" readonly></td>
				</tr>
				<tr>
					<td colspan="1"><input name="DISTRIBUTOR" type="text" maxlength="20" size="4" class="form-control" required  placeholder="[COMPANY NAME]"/></td>
				</tr>
				<tr>
					<td colspan="1"><input name="CUSTOMER_FNAME"  type="text"  maxlength="40" size="10"  class="form-control"  required placeholder="[FIRST NAME]" 
							        value="<?php echo $this->CUSTOMER_FIRST_NAME;?>"/></td>
					<td colspan="1"><input name="CUSTOMER_LNAME"  type="text"  maxlength="40" size="10"  class="form-control"  required placeholder="[LAST NAME]"  
								value="<?php echo $this->CUSTOMER_LAST_NAME;?>" /></td>
					<td colspan="1"><input name="CUSTOMER_EMAIL"  type="email" maxlength="40" size="36"  class="form-control"  required placeholder="[EMAIL]"      
								value="<?php echo $this->CUSTOMER_LOGIN_ID;?>"/></td>
				</tr>
				<tr>
					<td colspan="1"><input name="CUSTOMER_ADDRESS" type="text" maxlength="40" size="10" class="form-control"   required placeholder="[ADDRESS]" 
							       	value="<?php echo $this->CUSTOMER_ADDRESS;?>"/></td>
					<td colspan="1"><input name="CUSTOMER_CITY"    type="text" maxlength="40" size="10" class="form-control"   required placeholder="[CITY]"    
								value="<?php echo $this->CUSTOMER_CITY;?>"></td>
					<td colspan="1"><input name="CUSTOMER_PHONE"   type="tel" maxlength="40" size="10" class="form-control"   required placeholder="[PHONE]"  
								 value="<?php echo $this->CUSTOMER_PHONE;?>"/></td>
				</tr>
				<tr>
					<td colspan="5"><hr></td>	
				</tr>
				<tr>
                                        <td colspan="5"><strong>CLIENT [CONTRACTOR/INSTALLERS/DEALER/OTHER] INFORMATION</strong></td>
                                        <td></td>
                                </tr>
                                <tr>
                                        <td colspan="1"><input name="PARTY_COMPANY" type="text" maxlength="20" size="4" class="form-control" required  placeholder="[COMPANY NAME]"/></td>
					<td>	<select name="PARTY_TYPE" class="form-control" required="" style="width: 200px;">
							<option value="" selected="" style="display:none;">[CLIENT TYPE]</option>
							<option value="CONTRACTOR">Contractor</option>
							<option value="INSTALLER">Installer</option>
							<option value="ENDUSER">EndUser</option>
							<option value="OEM">OEM</option>
							<option value="DEALER">Dealer</option>
						</select>
					</td>
                                </tr>
                                <tr>
                                        <td colspan="1"><input name="PARTY_FNAME"  type="text"  maxlength="40" size="10"  class="form-control"  required placeholder="[FIRST NAME]"/></td>
                                        <td colspan="1"><input name="PARTY_LNAME"  type="text"  maxlength="40" size="10"  class="form-control"  required placeholder="[LAST NAME]"/></td>
                                        <td colspan="1"><input name="PARTY_PHONE"  type="tel"  maxlength="40" size="36"  class="form-control"  required placeholder="[PHONE]"/></td>
                                </tr>
                                <tr>
                                        <td colspan="5"><hr></td>
                                </tr>
				<tr>
                                        <td colspan="5"><strong>PUMP INFORMATION</strong></td>
                                        <td><input name="PUMP_TYPE" type="hidden" value="<?php echo $_REQUEST["selectpumptype"] ;?>" readonly></td>
                                </tr>

				<tr>
					<td><?php $this->ExecuteProviderList(NULL);?>
					<td><input name="PUMP_SERIAL" type="text" maxlength="60" size="4" class="form-control"  placeholder="[SERIAL #]"/></td>					
					<td colspan="1"><input name="REF" type="text" maxlength="10" size="20" class="form-control" placeholder="[REF #: INVOICE / P.O]"/></td>
				</tr>
				<tr>
					
					<td colspan="1"><input name="PUMP_MODEL" type="text" maxlength="40" size="26" class="form-control" placeholder="[PUMP MODEL]"/></td>
					
					
				</tr>
				<tr>
					<td colspan="5"><hr></td>	
				</tr>
				<tr>
				<tr>
					<td colspan="5"><strong>RECEIVED PUMP STATUS</strong></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><input name="PUMP_STATUS[]" type="checkbox" value="VISIBILY BEEN INSTALLED"/>VISIBILY BEEN INSTALLED:</td>
					<td colspan="2"><input name="PUMP_STATUS[]" type="checkbox" value="TERMINAL BOX BROKEN OR CRACKED"/>TERMINAL BOX BROKEN OR CRACKED:</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><input name="PUMP_STATUS[]" type="checkbox" value="THREAD SEALER TRACES"/>THREAD SEALER TRACES:</td>
					<td colspan="2"><input name="PUMP_STATUS[]" type="checkbox" value="ACCESORY BROKEN OR CRACKED"/>ACCESORY BROKEN OR CRACKED:</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><input name="PUMP_STATUS[]" type="checkbox" value="FOOT LOST OR BROKEN"/>FOOT LOST OR BROKEN:</td>
					<td colspan="2"><input name="PUMP_STATUS[]" type="checkbox" value="FAN COVER BROKEN OR CRACKED"/>FAN/FAN COVER BROKEN OR CRACKED:</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><input name="PUMP_STATUS[]" type="checkbox" value="PUMP BODY BROKEN OR CRACKED"/>PUMP BODY BROKEN OR CRACKED:</td>
					<td colspan="2"><input name="PUMP_STATUS[]" type="checkbox" value="MOTOR BROKEN OR CRACKED"/>MOTOR BROKEN OR CRACKED:</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><input name="PUMP_STATUS[]" type="checkbox" value="GOOD CONDITION"/>GOOD CONDITION:</td>
					<td colspan="2"><input name="PUMP_STATUS[]" type="checkbox" value="PUMP CONTROLLER BROKEN OR CRAKED"/>PUMP CONTROLLER BROKEN OR CRAKED:</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="5"><input name="PUMP_STATUS_OTHER" type="text"/ size="80" class="form-control"  placeholder="[OTHER/NOTES]"></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="5"><hr></td>	
				</tr>
				<tr>
					<td colspan="5"><strong>INSTALLATION DESCRIPTION</strong></td>
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
					<td colspan="2"><input name="PUMP_INSTALLATION[]" type="checkbox" value="IRRIGATION SYSTEM"/>IRRIGATION SYSTEM</td>
					<td colspan="2"><input name="PUMP_INSTALLATION[]" type="checkbox" value="OUTDOOR"/>OUTDOOR</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><input name="PUMP_INSTALLATION[]" type="checkbox" value="WELL SYSTEM"/>WELL SYSTEM</td>
					<td colspan="2"><input name="PUMP_INSTALLATION[]" type="checkbox" value="INDOOR"/>INDOOR</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><input name="PUMP_INSTALLATION[]" type="checkbox" value="MACHINE OEM PRODUCT CONDITION"/>MACHINE OEM PRODUCT CONDITION</td>
					<td colspan="2"><u>SUCTION CONDITION</u></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><input name="PUMP_INSTALLATION[]" type="checkbox" value="BOOSTING SYSTEM"/>BOOSTING SYSTEM</td>
					<td colspan="2"><input name="PUMP_INSTALLATION[]" type="checkbox" value="LIFTING FROM A POND"/>LIFTING FROM A POND</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><input name="PUMP_INSTALLATION[]" type="checkbox" value="BOOSTING PRESSURE COMING FROM OTHER PUMP"/>BOOSTING PRESSURE COMING FROM OTHER PUMP</td>
					<td colspan="2"><input name="PUMP_INSTALLATION[]" type="checkbox" value="LIFTING FROM A WELL"/>LIFTING FROM A WELL</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan="2"><input name="PUMP_INSTALLATION[]" type="checkbox" value="FLOODED SUCTION"/>FLOODED SUCTION</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan="2"><input name="PUMP_INSTALLATION[]" type="checkbox" value="CITY PRESSUR"/>CITY PRESSURE</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><u>OPERATION</u></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><input name="PUMP_OPERATION['PSI']" type="text" maxlength="6" size="4"  class="form-control" placeholder="[PRESSURE (PSI)]"/></td>
					<td><input name="PUMP_OPERATION['GPM']" type="text"  maxlength="6" size="4"/  class="form-control" placeholder="[FLOW (GPM)]"></td>
					<td><input name="PUMP_OPERATION['LIQUID_TYPE']" type="text"  maxlength="60" size="4"  class="form-control" placeholder="[LIQUID TYPE]"/></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="5"><input name="PUMP_INSTALLATION_OTHER" type="text"/ size="80"  class="form-control" placeholder="[OTHER/NOTES]"></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="5"><hr></td>	
				</tr>
				<tr>
					<td colspan="5"><strong>PROBLEM DESCRIPTION</strong></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="THE PUMP DOES NOT MEET THE PRESSURE"/>THE PUMP DOES NOT MEET THE PRESSURE</td>
					<td colspan="2"><input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox"/>THE MOTOR -HUMS-</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="THE PUMP DOES NOT MEET THE FLOW"/>THE PUMP DOES NOT MEET THE FLOW</td>
					<td colspan="2"><u>THERE IS LEAK COMING OUT OF THE</u></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="THE PUMP MAKES NOISE"/>THE PUMP MAKES NOISE</td>
					<td colspan="2"><input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="MECHANICAL SEAL"/>MECHANICAL SEAL</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="THE PUMP DOES NOT START"/>THE PUMP DOES NOT START</td>
				 	<td colspan="2"><input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="INLET"/>INLET</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="MOTOR DRAWS HIGH AMPS"/>MOTOR DRAWS HIGH AMPS</td>
					<td colspan="2"><input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="OUTLET"/>OUTLET</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="THE SYSTEM DOES NOT START"/>THE SYSTEM DOES NOT START</td>
					<td colspan="2"><input name="PUMP_PROBLEM_DESCRIPTION[]" type="checkbox" value="BACK COVER"/>BACK COVER</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="5"><input name="PUMP_PROBLEM_DESCRIPTION_OTHER" type="text"/ size="80"  class="form-control" placeholder="[OTHER/NOTES]"></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
                                        <td colspan="5"><hr></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                </tr>

				<tr>
                                        <td colspan="5">
							 <!-- hidden value -->
							<input name="cmdClaim" type="hidden" value="Submit Claim" />
                        				<!-- send claim information to be processed -->
                        				<input type="submit" class="btn btn-success btn-block" value="Create Claim"/>   
					</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                </tr>
			
			</table>
		</form>
		<script type="text/javascript">
			$(document).ready(function (e) {
			// Function to preview image after validation
			$(function() {
			$("#file").change(function() {
			$("#message").empty(); // To remove the previous error message
			var file = this.files[0];
			var imagefile = file.type;
			var match= ["image/jpeg","image/png","image/jpg"];
			if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
			{
			$('#previewing').attr('src','noimage.png');
			$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
			return false;
			}
			else
			{
			var reader = new FileReader();
			reader.onload = imageIsLoaded;
			reader.readAsDataURL(this.files[0]);
			}
			});
			});
			function imageIsLoaded(e) {
			$("#file").css("color","green");
			$('#image_preview').css("display", "block");
			$('#previewing').attr('src', e.target.result);
			$('#previewing').attr('width', '250px');
			$('#previewing').attr('height', '230px');
			};
			});
	</script>
