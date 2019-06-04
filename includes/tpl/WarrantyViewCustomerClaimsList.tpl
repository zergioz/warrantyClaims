<table id="myTable" class="table table-hover table-striped" border="0" cellpadding="0" cellspacing="1" width="100%">            
    <thead>
        <tr> 
            <th align='center'>CLAIM ID</th>  
            <th align='center'>DATE</th> 
            <th align='center'>TYPE</th> 
            <th align='center'>STATUS</th>
            <th align='center'>SERVICE DATE</th> 
            <th align='center'>PDF</th> 
        </tr> 
    </thead>
    <tbody>  
    	<?php $this->ExecuteCustomerClaimsList();?>
    </tbody> 
</table>

<script>
$(document).ready(function() {
	$('#myTable').dataTable( {
		"aoColumns": [
			null,
			{ "asSorting": [ "asc" ] },
			{ "asSorting": [ "desc", "asc", "asc" ] },
			{ "asSorting": [ "desc" ] },
			null,null

		]
	} );
} );
</script>
