<form id="form" name="form" method="post" action="<?php echo _BASE_URL?>/warranty/step1.php">
<table cellspacing="1"  class="table table-striped table-bordered">  
              <tbody>
                <tr>
                  <td>
			<table width="340" border="0" align="left" cellpadding="5" cellspacing="1">
                    	<tbody>
                      	<tr>
                        <th width="110" bgcolor="#FDFDF7" class="tit">CLAIM ID:</th>
                        <td bgcolor="#FDFDF7"><span class="tit"><?=$this->CLAIM_ID;?></span></td>
                      	</tr>
                      	<tr>
                        <th bgcolor="#FFFFFF" class="tit">Customer ID:</th>
                        <td bgcolor="#FFFFFF"><span class="txt"><?=$this->CLAIM_CUSTOMER_ID;?></span></td>
                      	</tr>
                      	<tr>
                        <th align="left" bgcolor="#FDFDF7" class="tit">Type:</th>
                        <td bgcolor="#FDFDF7"><span class="txt"><?=$this->CLAIM_PUMP_TYPE;?></span></td>
                      	</tr>
                      	<tr>
                        <th align="left" bgcolor="#FFFFFF" class="tit">REF:</th>
                        <td bgcolor="#FFFFFF"><span class="txt"><?=$this->CLAIM_REF;?></span></td>
                      	</tr>
                    	</tbody>
                  	</table>
		</td>
                <td>
			<table width="340" border="0" align="right" cellpadding="5" cellspacing="1">
                    	<tbody>
                      	<tr>
                        <th width="110" bgcolor="#FDFDF7" class="tit">Customer:</th>
                        <td bgcolor="#FDFDF7"><span class="txt"><?=$this->CLAIM_CUSTOMER_NAME;?></span></td>
                      	</tr>
                      	<tr>
                        <th bgcolor="#FFFFFF" class="tit">Address:</th>
                        <td bgcolor="#FFFFFF"><span class="txt"><?=$this->CLAIM_CUSTOMER_ADDRESS;?> <?=$this->CLAIM_CUSTOMER_CITY;?> <?=$this->CLAIM_CUSTOMER_ZIP;?></span></td>
                      	</tr>
                      	<tr>
                        <th bgcolor="#FDFDF7" class="tit">Phone #</th>
                        <td bgcolor="#FDFDF7"><span class="txt"><?=$this->CLAIM_CUSTOMER_PHONE;?></span></td>
                      	</tr>
                      	<tr>
                        <th bgcolor="#FFFFFF" class="tit">Date:</th>
                        <td bgcolor="#FFFFFF"><span class="txt"><?=$this->CLAIM_DATE;?></span></td>
                      	</tr>
                      	</tbody>
                  	</table>
		</td>
              </tr>
             </tbody>
            </table>
	  </td>
          </tr>
          <tr>
            <td height="20"></td>
          </tr>
          <tr>
            <td>
		<table cellspacing="1"  class="table table-striped table-bordered">
              <tbody>
                <tr>
                  <th width="142" bgcolor="#FDFDF7" class="tit">Status:</th>
                  <td bgcolor="#FDFDF7" class="txt"><?=$this->CLAIM_PUMP_STATUS;?></td>
                </tr>
                <tr>
                  <th bgcolor="#FFFFFF" class="tit">Status notes:</th>
                  <td bgcolor="#FFFFFF" class="txt"><?=$this->CLAIM_PUMP_STATUS_OTHER;?></td>
                </tr>
                <tr>
                  <th bgcolor="#FDFDF7" class="tit">Installation:</th>
                  <td bgcolor="#FDFDF7" class="txt"><?=$this->CLAIM_PUMP_INSTALLATION;?></td>
                </tr>
                <tr>
                  <th bgcolor="#FFFFFF" class="tit">Operation:</th>
                  <td bgcolor="#FFFFFF" class="txt"><?=$this->CLAIM_PUMP_OPERATION;?></td>
                </tr>
                <tr>
                  <th bgcolor="#FDFDF7" class="tit">Installation notes:</th>
                  <td bgcolor="#FDFDF7" class="txt"><?=$this->CLAIM_PUMP_INSTALLATION_OTHER;?></td>
                </tr>
                <tr>
                  <th bgcolor="#FFFFFF" class="tit">Description:</th>
                  <td bgcolor="#FFFFFF" class="txt"><?=$this->CLAIM_PUMP_PROBLEM_DESCRIPTION;?></td>
                </tr>
                <tr>
                  <th bgcolor="#FDFDF7" class="tit">Description notes:</th>
                  <td bgcolor="#FDFDF7" class="txt"><?=$this->CLAIM_PUMP_PROBLEM_DESCRIPTION_OTHER;?></td>
                </tr>
                <tr>
                  <th bgcolor="#FDFDF7" class="tit">Images:</th>
                  <td bgcolor="#FDFDF7" class="txt"><?=$this->ViewAdminImages();?></td>
                </tr>
               </tbody>
            </table></td>
          </tr>
        </tbody>
    </table>

<!-- hidden value -->
<input name="TechId"          type="hidden"  value="<?php echo @$_SESSION['tech_id'];?>"/>
<input name="WarrantyClaimId" type="hidden" value="<?php echo $_REQUEST['WarrantyClaimId'];?>" />
<input name="StartClaim" type="hidden" value="True" />
<!-- buttons -->
<div style="float:right;width:100%;"> <?php $this->StartContinueWork();?></div>
</form>

