	<!-- ADMIN SECTION START --> 
	<tr>
        	<td colspan="5">
                	<hr>
        	</td>
	</tr>
	<tr>
        	<td colspan="5"><strong>ADMIN SECTION</strong></td>
                <td><input name="ADMIN_CLAIM_CHANGE" type="hidden" value="TRUE"></td>
                <td></td>
                <td></td>
                </tr>
	<tr>
        	<td colspan="1"><?php $this->ExecuteProviderListTwo($this->ADMIN_PUMP_PROVIDER_TWO);?></td>
                <td colspan="1"><input name="ADMIN_PUMP_CODE_DATE" type="text" size="80" class="form-control"  placeholder="[PUMP DATE]" value="<?php echo $this->ADMIN_PUMP_DATE;?>" title="CODE DATE"></td>
                <td colspan="1"><input name="ADMIN_PUMP_MOTOR_CODE_DATE" type="text" size="80" class="form-control"  placeholder="[MOTOR DATE]" value="<?php echo $this->ADMIN_MOTOR_DATE;?>" title="MOTOR CODE DATE"></td>
                <td></td>
                <td></td>
        </tr>
	<tr>
                <td colspan="1"><input name="ADMIN_PUMP_SERVICE_TAG" type="text" size="80" class="form-control"  placeholder="[SERVICE TAG]" value="<?php echo $this->ADMIN_SERVICE_TAG;?>" title="SERVICE TAG" style="text-transform:uppercase"></td>
                <td colspan="1"><input name="ADMIN_PUMP_REPORT" type="text" size="80" class="form-control"  placeholder="[REPORT NUMBER]" value="<?php echo $this->ADMIN_REPORT;?>" title="REPORT NUMBER" ></td>
                <td colspan="1"><input name="ADMIN_PUMP_REPAIR_BOOL" type="text" size="80" class="form-control"  placeholder="[REPAIR YES/NO]" value="<?php echo $this->ADMIN_REPAIR;?>" title="REPAIR YES/NO" style="text-transform:uppercase"></td>
                <td></td>
                <td></td>
        </tr>
	<tr>
                <td colspan="1"><input name="ADMIN_PUMP_FILED_BOOL" type="text" size="80" class="form-control"  placeholder="[FILED YES/NO]" value="<?php echo $this->ADMIN_FILED;?>" title="FILED YES/NO" style="text-transform:uppercase"></td>
                <td colspan="1"><input name="ADMIN_PUMP_SHIPPED" type="text" size="80" class="form-control"  placeholder="[SHIPPED DATE]" value="<?php echo $this->ADMIN_SHIPPED;?>" title="SHIPPED" style="text-transform:uppercase"></td>
                <td colspan="1"><input name="ADMIN_PUMP_TRACKING_NUMBER" type="text" size="80" class="form-control"  placeholder="[TRACKING]" value="<?php echo $this->ADMIN_TRACKING_NUMBER;?>" title="TRACKING NUMBER" style="text-transform:uppercase" ></td>
                <td></td>
                <td></td>
        </tr>
	<tr>
               <td colspan="2"><input name="ADMIN_PUMP_CHARGERS" type="text" size="80" class="form-control"  placeholder="[CHARGES]" value="<?php echo $this->ADMIN_CHARGES;?>" title="CHARGES IN DOLLARS"></td>
               <td colspan="2"><input name="ADMIN_PUMP_RETURENED_DATE" type="text" size="80" class="form-control"  placeholder="[RETURNED DATE]" value="<?php echo $this->ADMIN_RETURNED_DATE;?>" title="RETURENED DATE" ></td>
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
        	<td colspan="5"><strong>IMAGES</strong></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
	<tr>
    <tr>
               <td colspan="5"><input type="file" name="ADMIN_PUMP_IMAGE[]"  multiple="multiple" class="filestyle" data-buttonBefore="true"></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
    </tr> 	
	<!-- ADMIN SECTION END -->
