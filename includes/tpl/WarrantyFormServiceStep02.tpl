<form id="form1" name="form1" method="post" action="<?php echo _BASE_URL?>/warranty/step3.php">
	<TABLE border="0" summary="This table is used to format forms for pumps." align="center" class="table table-striped table-bordered">
		<tr>
					<th colspan='3'>REPORT AFTER TECHNICAL INSPECTION</th>
		</tr>
		<tr>
					<td style="width: 240px;"><input name="txtUserID[]" type="checkbox" value="CAPACITOR-FAILED"  <?php echo $warranty->CheckedOrNot('CAPACITOR-FAILED',$Report_After_Technical_Insepction);?> />CAPACITOR FAILED</td>
					<td style="width: 240px;"><input name="txtUserID[]" type="checkbox" value="OVERLOAD-SWITCH-IS-TRIPPED"  <?php echo $warranty->CheckedOrNot('OVERLOAD-SWITCH-IS-TRIPPED',$Report_After_Technical_Insepction);?>/>OVERLOAD SWITCH IS TRIPPED</td>
					<td style="width: 240px;"><input name="txtUserID[]" type="checkbox" id="txtUserID" value="DIFUSER-BROKEN-OR-CLOGGED"  <?php echo $warranty->CheckedOrNot('DIFUSER-BROKEN-OR-CLOGGED',$Report_After_Technical_Insepction);?>/>DIFUSER BROKEN OR CLOGGED</td>
		</tr>
		<tr>
					<td><input name="txtUserID[]" type="checkbox" value="SHORT-CIRCUIT-IN-THE-ROTOR"  <?php echo $warranty->CheckedOrNot('SHORT-CIRCUIT-IN-THE-ROTOR',$Report_After_Technical_Insepction);?>/>SHORT CIRCUIT IN THE ROTOR</td>
					<td><input name="txtUserID[]" type="checkbox" value="MECHANICAL-SEAL-IS-BROKEN-OR-SCRATCHED"  <?php echo $warranty->CheckedOrNot('MECHANICAL-SEAL-IS-BROKEN-OR-SCRATCHED',$Report_After_Technical_Insepction);?>/>MECHANICAL SEAL IS BROKEN OR SCRATCHED</td>
					<td><input name="txtUserID[]" type="checkbox" value="BEARING-FAILED"  <?php echo $warranty->CheckedOrNot('BEARING-FAILED',$Report_After_Technical_Insepction);?>/>BEARING FAILED</td>
		</tr>
		<tr>
					<td><input name="txtUserID[]" type="checkbox" value="BURNED-MOTOR-WINDING"  <?php echo $warranty->CheckedOrNot('BURNED-MOTOR-WINDING',$Report_After_Technical_Insepction);?>/>BURNED MOTOR WINDING (START WINDING)</td>
					<td><input name="txtUserID[]" type="checkbox" value="IMPELLER-CLOGGED"  <?php echo $warranty->CheckedOrNot('IMPELLER-CLOGGED',$Report_After_Technical_Insepction);?>/>IMPELLER CLOGGED</td>
					<td><input name="txtUserID[]" type="checkbox" value="SHAFT-CORRODED"  <?php echo $warranty->CheckedOrNot('SHAFT-CORRODED',$Report_After_Technical_Insepction);?>/>SHAFT CORRODED</td>
		</tr>
		<tr>
					<td><input name="txtUserID[]" type="checkbox" value="BURNED-MOTOR-WINDING"  <?php echo $warranty->CheckedOrNot('BURNED-MOTOR-WINDING',$Report_After_Technical_Insepction);?>/>BURNED MOTOR WINDING (RUNNING WINDING)</td>
					<td><input name="txtUserID[]" type="checkbox" value="THE-ELECTRONIC-BOARD-DAMAGED"  <?php echo $warranty->CheckedOrNot('THE-ELECTRONIC-BOARD-DAMAGED',$Report_After_Technical_Insepction);?>/>THE ELECTRONIC BOARD DAMAGED</td>
					<td><input name="txtUserID[]" type="checkbox" value="THE-CONTROLLER-CHECK-VALVE-CLOGGED-OR-DIRT"  <?php echo $warranty->CheckedOrNot('THE-CONTROLLER-CHECK-VALVE-CLOGGED-OR-DIRT',$Report_After_Technical_Insepction);?>/>THE CONTROLLER CHECK VALVE CLOGGED OR DIRT</td>
		</tr>
		</table>
		<TABLE border="0" summary="This table is used to format forms for pumps." align="center" class="table table-striped table-bordered">
		<tr>
					<th colspan='3'>LABOR PERFORMED</th>
		</tr>
			<td style="width: 240px;">
				<input name="txtUserLabor[]" type="checkbox"  value="INSPECTION-OR-ELECTRICAL-TEST" <?php echo $warranty->CheckedOrNot('INSPECTION-OR-ELECTRICAL-TEST',$Labor_Performed);?>/>INSPECTION OR ELECTRICAL TEST
			</td>
			<td style="width: 240px;">
				<input name="txtUserLabor[]" type="checkbox"  value="MOTOR-REPLACED" <?php echo $warranty->CheckedOrNot('MOTOR-REPLACED',$Labor_Performed);?>/>
				MOTOR REPLACED
			</td>
			<td style="width: 240px;">
				<input name="txtUserLabor[]" type="checkbox"  value="FINAL-TEST" <?php echo $warranty->CheckedOrNot('FINAL-TEST',$Labor_Performed);?>/>
				FINAL TEST
			</td>
		</tr>
		<tr>
			<td>
				<input name="txtUserLabor[]" type="checkbox" value="PRE-TEST" <?php echo $warranty->CheckedOrNot('PRE-TEST',$Labor_Performed);?>/>
				PRE TEST
			</td>
			<td>
				<input name="txtUserLabor[]" type="checkbox" value="DIFUSER-REPLACED" <?php echo $warranty->CheckedOrNot('DIFUSER-REPLACED',$Labor_Performed);?>/>
				DIFUSER REPLACED
			</td>
			<td>
				<input name="txtUserLabor[]" type="checkbox" value="CLEAN-UP" <?php echo $warranty->CheckedOrNot('CLEAN-UP',$Labor_Performed);?>/>
				CLEAN UP
			</td>
		</tr>
		<tr>
			<td>
				<input name="txtUserLabor[]" type="checkbox" value="MECHANICAL-SEAL-KIT-REPLACED" <?php echo $warranty->CheckedOrNot('MECHANICAL-SEAL-KIT-REPLACED',$Labor_Performed);?>/>
				MECHANICAL SEAL KIT REPLACED
			</td>
			<td>
				<input name="txtUserLabor[]" type="checkbox" value="PRESSURE-SWITCH-GAUGE-REPLACED" <?php echo $warranty->CheckedOrNot('PRESSURE-SWITCH-GAUGE-REPLACED',$Labor_Performed);?>/>
				PRESSURE SWITCH/GAUGE REPLACED
			</td>
			<td>
				<input name="txtUserLabor[]" type="checkbox" value="PAINTING" <?php echo $warranty->CheckedOrNot('PAINTING',$Labor_Performed);?>/>
				PAINTING
			</td>
		</tr>
		<tr>
			<td>
				<input name="txtUserLabor[]" type="checkbox" value="CAPACITOR-REPLACED" <?php echo $warranty->CheckedOrNot('CAPACITOR-REPLACED',$Labor_Performed);?>/>
				CAPACITOR REPLACED
			</td>
			<td>
				<input name="txtUserLabor[]" type="checkbox" value="IMPELLER-REPLACED"  <?php echo $warranty->CheckedOrNot('IMPELLER-REPLACED',$Labor_Performed);?>/>
				IMPELLER REPLACED
			</td>
			<td>
				<input name="txtUserLabor[]" type="checkbox" value="ELECTRONIC-BOARD-REPLACED"  <?php echo $warranty->CheckedOrNot('ELECTRONIC-BOARD-REPLACED',$Labor_Performed);?>/>
				ELECTRONIC BOARD REPLACED
			</td>
		</tr>

		<tr>
                	<td>
				<input name="txtUserLabor[]" type="checkbox" value="FAN-COVER-CONTROL-BOX-COVER-REPLACED" <?php echo $warranty->CheckedOrNot('FAN-COVER-CONTROL-BOX-COVER-REPLACED',$Labor_Performed);?>/>
				FAN/FAN COVER/CONTROL BOX COVER REPLACED
			</td>
                        <td>
				<input name="txtUserLabor[]" type="checkbox" value="BEARING-REPLACED" <?php echo $warranty->CheckedOrNot('BEARING-REPLACED',$Labor_Performed);?>/>
				DIFUSER REPLACED
			</td>
                        <td>
				<input name="txtUserLabor[]" type="checkbox" value="CHECK-VALVE-REPLACED" <?php echo $warranty->CheckedOrNot('CHECK-VALVE-REPLACED',$Labor_Performed);?>/>
				CHECK VALVE REPLACED
			</td>
                </tr>
		<tr>
                        <td>
				<input name="txtUserLabor[]" type="checkbox" value="SHAFT-REPLACED" <?php echo $warranty->CheckedOrNot('SHAFT-REPLACED',$Labor_Performed);?>/>
				SHAFT REPLACED
			</td>
                        <td>
				<input name="txtUserLabor[]" type="checkbox" value="CHECK-VALVE-CLEAN-UP" <?php echo $warranty->CheckedOrNot('CHECK-VALVE-CLEAN-UP',$Labor_Performed);?>/>
				CHECK VALVE CLEAN UP
			</td>
                        <td></td>
                </tr>

	</table>
	<TABLE border="0" summary="This table is used to format forms for pumps." align="center" class="table table-striped table-bordered">
		<tr>
					<th colspan="3">PARTS USED</th>
		</tr>		
		<tr>
					<td align="center" style="width: 240px;">PART</td>
					<td align="center"></td>
					<td align="center">QTY</td>
		</tr>
		<tr>
					<td align="center"><input     name="txtUserCode1[]" value="<?php echo $codeone[0];?>" type="text" id="PART_ONE" size="25"></td>
					<td align="center"><textarea  name="txtUserCode1[]" id="DESCRIPTION_ONE" rows="2" cols="50"><?php echo $codeone[1];?></textarea></td>
	  			        <td align="center"><input     name="txtUserCode1[]" value="<?php echo $codeone[2];?>" type="text" size="2" maxlength="2" ></td>
		</tr>
		<tr>
					<td align="center"><input     name="txtUserCode2[]" value="<?php echo $codetwo[0];?>" type="text" id="PART_TWO" size="25"></td>
					<td align="center"><textarea  name="txtUserCode2[]" id="DESCRIPTION_TWO" rows="4" cols="50"><?php echo $codetwo[1];?></textarea></td>
					<td align="center"><input     name="txtUserCode2[]" value="<?php echo $codetwo[2];?>" type="text"  size="2" maxlength="2" ></td>
		</tr>
		<tr>
					<td align="center"><input     name="txtUserCode3[]" value="<?php echo $codethree[0];?>" type="text" id="PART_THREE" size="25"></td>
					<td align="center"><textarea  name="txtUserCode3[]" id="DESCRIPTION_THREE" rows="4" cols="50"><?php echo $codethree[1];?></textarea></td>
					<td align="center"><input     name="txtUserCode3[]" value="<?php echo $codethree[2];?>" type="text" size="2" maxlength="2"></td>
		</tr>
		<tr>
					<td align="center"><input     name="txtUserCode4[]" value="<?php echo $codefour[0];?>" type="text" id="PART_FOUR" size="25"></td>
					<td align="center"><textarea  name="txtUserCode4[]" id="DESCRIPTION_FOUR" rows="4" cols="50"><?php echo $codefour[1];?></textarea></td>
					<td align="center"><input     name="txtUserCode4[]" value="<?php echo $codefour[2];?>" type="text"  size="2" maxlength="2"></td>
		</tr>
	</table>
	<hr>
	<!-- hidden value -->
	<input name="WarrantyClaimId" type="hidden" value="<?php echo $_REQUEST['WarrantyClaimId'];?>" />
	<input name="StartClaim" type="hidden" value="True" />
	<input name="StartClaimStep" type="hidden" value="3" />
	<!-- buttons -->
	<div style="float:left; width:45%;">
		<a class="btn btn-primary btn-block" href="<?php echo _BASE_URL?>/warranty/ViewClaimWarranty.php">Back</a></div>
	<div style="float:right;width:45%;">
		<input type="submit" name="step2" value="Step Three" class="btn btn-success btn-block">
	</div>
</form>

<!-- JS ajax autocomplete-->
<script type="text/javascript">
$(document).ready(function(){
        var part_one = {
                source: "/includes/json.parts.php",
                select: function(event, ui){
                        $("#PART_ONE").val(ui.item.part);
                        $("#DESCRIPTION_ONE").val(ui.item.description);
                },
                minLength:1
        };
        var part_two = {
                source: "/includes/json.parts.php",
                select: function(event, ui){
                        $("#PART_TWO").val(ui.item.part);
                        $("#DESCRIPTION_TWO").val(ui.item.description);
                },
                minLength:1
        };
         var part_three = {
                source: "/includes/json.parts.php",
                select: function(event, ui){
                        $("#PART_THREE").val(ui.item.part);
                        $("#DESCRIPTION_THREE").val(ui.item.description);
                },
                minLength:1
        };
         var part_four = {
                source: "/includes/json.parts.php",
                select: function(event, ui){
                        $("#PART_FOUR").val(ui.item.part);
                        $("#DESCRIPTION_FOUR").val(ui.item.description);
                },
                minLength:1
        };

        $("#PART_ONE").autocomplete(part_one);
        $("#PART_TWO").autocomplete(part_two);
        $("#PART_THREE").autocomplete(part_three);
        $("#PART_FOUR").autocomplete(part_four);
});
</script>

<!-- select at least one option -->
<script type="text/javascript">
        $(document).ready(function(){

        var checkboxes = $("input[type='checkbox']"),
            submitButt = $("input[type='submit']");

            checkboxes.click(function() {
                submitButt.attr("disabled", !checkboxes.is(":checked"));
                });
        });
</script>

