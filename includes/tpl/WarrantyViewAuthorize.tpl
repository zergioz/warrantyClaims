<form action="" name="rma" method="post" >
	<table  align="center" class="table table-striped table-bordered">
        	<tr>
                                <th>BARCODE</th>
                                <th>RMAID</th>
                                <th>CLAIMID</th>
				<th>CUSTOMERID</th>
                                <th>DATE</th>
                                <th>TYPE</th>
                </tr>
                                <td><center><img alt='barcode' src="../includes/barcode/barcode.php?size=20&text=<?php echo $this->RMA_ID;?>"/></center></td>
                                <td align="center"><?php echo $this->RMA_ID;?></td>
                                <td align="center"><?php echo $this->RMA_CLAIM_ID;?></td>
                                <td align="center"><?php echo $this->CUSTOMER_ID;?></td>
                                <td align="center"><?php echo $this->RMA_DATE;?></td>
				<td align="center"><?php echo $this->PUMP_TYPE;?></td>
                <tr>
				<th colspan='1'>RECIPIENTS</th>
                                <th colspan='5'>NOTES</th>
                </tr>
		<tr>
				<td>
					 <input type="text" name="RECIPIENTS" class="form-control"  id="RECIPIENTS" placeholder="[RECIPIENTS EMAIL]" value="<?php echo $this->CUSTOMER_EMAIL;?>" readonly/>
				</td>
				<td rowspan='7'  colspan='5'>
                                        <textarea cols="50" rows="30" name="INTERNAL_NOTES" id="INTERNAL_NOTES" placeholder="[INTERNAL NOTES]"><?php echo $this->RMA_INTERNAL_NOTE;?></textarea>
                                </td>
		</tr>		
                <tr>
				<td>
                                        <select name="WARRANTY" class="form-control"  id="WARRANTY" style="width: 270px">
                                        	<option value="" selected="" style="display:none;">[WARRANTY AUTHORIZATION]</option>
                                        	<option value="APPROVED_WARRANTY" <?php echo $this->SelectedOption($this->RMA_WARRANTY,'APPROVED_WARRANTY');?>>WARRANTY</option>
                                        	<option value="NO_WARRANTY"       <?php echo $this->SelectedOption($this->RMA_WARRANTY,'NO_WARRANTY');?>>NO WARRANTY</option>
                                        </select>
                                </td>			
                </tr>
                <tr>
                                <td>
                                        <select name="WARRANTY_TYPE" class="form-control"  id="WARRANTY_TYPE">
						<option value="" selected="" style="display:none;">[WARRANTY TYPE]</option>
                                        	<option value="CREDIT_NOTE" <?php echo $this->SelectedOption($this->RMA_WARRANTY_TYPE,'CREDIT_NOTE');?>>CREDIT NOTE</option>
                                        	<option value="NEW_PUMP"    <?php echo $this->SelectedOption($this->RMA_WARRANTY_TYPE,'NEW_PUMP');?>>NEW PUMP</option>
                                        	<option value="REPAIR_PUMP" <?php echo $this->SelectedOption($this->RMA_WARRANTY_TYPE,'REPAIR_PUMP');?>>REPAIR PUMP</option>
                                        </select>
                                </td>
                </tr>
		<tr>
				<td>
                                         <select name="WARRANTY_DECISION" class="form-control"  id="WARRANTY_DECISION">
                                                <option value="" selected="" style="display:none;">[FINAL DECISION]</option>
                                              	<option value="RETURNED ITEM"       <?php echo $this->SelectedOption($this->RMA_AUTHORIZE_DECISON,'RETURN ITEM');?>>RETURNED ITEM</option>
						<option value="REFURBISHED" 	    <?php echo $this->SelectedOption($this->RMA_AUTHORIZE_DECISON,'REFURBISHED');?>>REFURBISHED</option>
                                                <option value="SCRAP"               <?php echo $this->SelectedOption($this->RMA_AUTHORIZE_DECISON,'SCRAP');?>>SCRAP</option>
						<option value="NA"          	    <?php echo $this->SelectedOption($this->RMA_AUTHORIZE_DECISON,'NA');?>>N/A</option>
                                        </select>
                                </td>
		</tr>
                <tr>
                                <td colspan='5'>
					<textarea cols="31" rows="15" name="NOTIFICATION_BODY" id="NOTIFICATION_BODY" placeholder="[NOTIFICATION BODY]" readonly><?php echo $this->NOTIFICATION_BODY;?></textarea>
                                </td>
                </tr>
		<tr>
                                <td>
					<input type="text"   name="RECIPIENTS_NOTE" class="form-control"      id="RECIPIENTS_NOTE" placeholder="[RECIPIENTS NOTE]" value="<?php echo $this->RMA_AUTHORIZE_NOTE;?>">
				 	<input type="hidden" name="SEND_AUTHORIZE"       class="form-control" id="SEND_AUTHORIZE" value="SEND_AUTHORIZE">	
                                </td>
                </tr>
	</table>
        <div style="float:left;  width:45%;">
        	<a class="btn btn-primary btn-block" name="GO_BACK" id="GO_BACK" href="../warranty/ViewClaimWarranty.php?ViewClaimDetails=1&WarrantyClaimId=<?php echo $this->RMA_CLAIM_ID;?>">Go Back</a>
        </div>
	<div style="float:right;  width:45%;">
		<a class="btn btn-success btn-block" href="#" onclick="document.rma.submit()">Authorize Work </a>
	</div>
</form>
<script>
        <!-- vars -->

            $('#WARRANTY').change(function () {

        <!-- approved warranty option -->
                if ($('#WARRANTY').val() == 'APPROVED_WARRANTY') {

                        $('#WARRANTY_TYPE').removeAttr('disabled');
		        $('#WARRANTY_DECISION').removeAttr('disabled');

                } else {

                        $('#WARRANTY_TYPE').attr('disabled', 'disabled').val('');
			$('#WARRANTY_DECISION').attr('disabled', 'disabled').val('');
                }

        <!-- authorized button  and notes -->
                if ($('#WARRANTY').val() == 'APPROVED_WARRANTY' || $('#WARRANTY').val() == 'NO_WARRANTY') {
                 
		       $('#AUTHORIZE').removeAttr('disabled');
		       $('#INTERNAL_NOTES').attr('readonly',false);
		       $('#WARRANTY_DECISION').removeAttr('disabled');
                } else {
                	
		        $('#AUTHORIZE').attr('disabled', 'disabled').val('');
              		$('#INTERNAL_NOTES').attr('readonly', 'readonly');
			$('#WARRANTY_DECISION').attr('disabled', 'disabled').val('');
		  }


             })
        <!-- added trigger to calculate initial state -->
        .trigger('change');
</script>
<script>
    $(document).ready(function() {
        $("#WARRANTY_TYPE").change(function(){
            $.ajax({
                    url: '/includes/json.authorize.php',
                    type: 'GET',
                    data: { WARRANTY_TYPE: $("#WARRANTY_TYPE").val() },
                    success: function(response) {
                        var Answer   	 =   	JSON.parse(response);
			//alert(Answer.WARRANTY_NOTES);
                        $("#NOTIFICATION_BODY").val(Answer.WARRANTY_NOTES);
                    }
            });
        });
	
	 $("#WARRANTY").change(function(){
            $.ajax({
                    url: '/includes/json.authorize.php',
                    type: 'GET',
                    data: { WARRANTY_TYPE: $("#WARRANTY").val() },
                    success: function(response) {
                        var Answer       =      JSON.parse(response);
                        //alert(Answer.WARRANTY_NOTES);
                        $("#NOTIFICATION_BODY").val(Answer.WARRANTY_NOTES);
                    }
            });
        });
	
	$(document).ready(function(){
            $.ajax({
                    url: '/includes/json.authorize.php',
                    type: 'GET',
                    data: { WARRANTY_TYPE: $("#WARRANTY_TYPE").val() },
                    success: function(response) {
                        var Answer       =      JSON.parse(response);
                        //alert(Answer.WARRANTY_NOTES);
                        $("#NOTIFICATION_BODY").val(Answer.WARRANTY_NOTES);
                    }
            });
        });	
	
    });
</script>

