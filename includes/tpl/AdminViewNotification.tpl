<form action="" name="notification" method="post" >
	<table  align="center" class="table table-striped table-bordered">
        	<tr>
                	<th>TYPE</th>
			<th>RECIPIENTS</th>
                        <th>MESSAGE</th>
		</tr>
		<?php $this->ExecuteNotification();?>
		<input type="hidden" value="SAVE_NOTIFICATION" name="SAVE_NOTIFICATION">
        </table>
            
        <div style="float:right; width:100%;">
               	<a class="btn btn-success btn-block" name="SAVE_NOTIFICATION" id="SAVE_NOTIFICATION" href="#" onclick="document.notification.submit()">Save Notification Messages</a>
        </div>
</form>
<script type="text/javascript">
	$('#NOTIFICATION_TYPE_NEW_ACCOUNT').textext({
            		plugins : 'autocomplete tags ajax',
			tagsItems: [ <?=$this->ViewTags('NEW_ACCOUNT');?> ],
            		ajax : {
                		url : '/includes/json.notification.php',
                		dataType : 'json',
                		cacheResults : true
            		}
        	});
	
	 $('#NOTIFICATION_TYPE_NEW_CLAIM').textext({
                        plugins : 'autocomplete tags ajax',
			tagsItems: [ <?=$this->ViewTags('NEW_CLAIM');?> ],
                        ajax : {
                                url : '/includes/json.notification.php',
                                dataType : 'json',
                                cacheResults : true
                        }
                });	

	 $('#NOTIFICATION_TYPE_NEW_PUMP').textext({
                        plugins : 'autocomplete tags ajax',
			tagsItems: [ <?=$this->ViewTags('NEW_PUMP');?> ],
                        ajax : {
                                url : '/includes/json.notification.php',
                                dataType : 'json',
                                cacheResults : true
                        }
                });

	$('#NOTIFICATION_TYPE_REPAIR_PUMP').textext({
                        plugins : 'autocomplete tags ajax',
                        tagsItems: [ <?=$this->ViewTags('REPAIR_PUMP');?> ],
                        ajax : {
                                url : '/includes/json.notification.php',
                                dataType : 'json',
                                cacheResults : true
                        }
                });
	
	$('#NOTIFICATION_TYPE_CREDIT_NOTE').textext({
                        plugins : 'autocomplete tags ajax',
                        tagsItems: [  <?=$this->ViewTags('CREDIT_NOTE');?> ],
                        ajax : {
                                url : '/includes/json.notification.php',
                                dataType : 'json',
                                cacheResults : true
                        }
                });

	 $('#NOTIFICATION_TYPE_RMA').textext({
                        plugins : 'autocomplete tags ajax',
                        tagsItems: [  <?=$this->ViewTags('RMA');?> ],
                        ajax : {
                                url : '/includes/json.notification.php',
                                dataType : 'json',
                                cacheResults : true
                        }
                });

	 $('#NOTIFICATION_TYPE_NO_WARRANTY').textext({
                        plugins : 'autocomplete tags ajax',
                        tagsItems: [  <?=$this->ViewTags('NO_WARRANTY');?> ],
                        ajax : {
                                url : '/includes/json.notification.php',
                                dataType : 'json',
                                cacheResults : true
                        }
                });
</script>
