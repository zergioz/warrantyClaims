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
                                
                                <th colspan='2'>RECIPIENTS</th>
                                <th colspan='4'>NOTES</th>

                </tr>
                <tr>
                                <td colspan='2' >
                                        <input type="text" name="RECIPIENTS" class="form-control"  id="RECIPIENTS" placeholder="[RECIPIENTS EMAIL]" value="<?php echo $this->CUSTOMER_EMAIL;?>" readonly/>
				</td>
                                <td rowspan='3'  colspan='4'>
                                        <textarea cols="60" rows="15" name="INTERNAL_NOTES" class="form-control"  id="INTERNAL_NOTES" placeholder="[INTERNAL NOTES]"><?php echo $this->RMA_INTERNAL_NOTE;?></textarea>
                                </td>
                 </tr>
                 <tr>
                                <td colspan='2'>
					<textarea cols="40" rows="10" name="NOTIFICATION_BODY"   class="form-control"  id="NOTIFICATION_BODY" placeholder="[NOTIFICATION_BODY]" readonly><?php echo $this->NOTIFICATION_BODY;?></textarea>
                                </td>
                 </tr>
                 <tr>
                                <td colspan='2'>
                                        <input type="text"   name="RECIPIENTS_NOTE" class="form-control"  id="RECIPIENTS_NOTE" placeholder="[RECIPIENTS NOTE]" value="<?php echo $this->RMA_NOTE;?>"/>
					<input type="hidden" name="SEND_RMA" class="form-control"  id="SEND_RMA"/>
                                </td>
                 </tr>
	</table>
	<div style="float:left;  width:45%;">
        	<a class="btn btn-primary btn-block"  href="../warranty/ViewClaimWarranty.php?ViewClaimDetails=1&WarrantyClaimId=<?php echo $_REQUEST['ClaimID'];?>">Go Back</a>
        </div>
        <div style="float:right; width:45%;">
        	<a class="btn btn-success btn-block" href="#" onclick="document.rma.submit()">Send RMA </a>
        </div>
</form>

