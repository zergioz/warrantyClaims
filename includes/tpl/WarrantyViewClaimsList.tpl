<table id="myTable" class="table table-hover table-striped" border="0" cellpadding="0" cellspacing="1" width="100%">         
    <thead>
        <tr> 
            <th align='center'>CLAIMID</th>  
            <th align='center'>SUBMITTED</th> 
            <th align='center'>TYPE</th> 
            <th align='center'>STATUS</th>
            <th align='center'>SERVICED</th> 
            <th align='center'>TECH</th>
	    <th align='center'>PDF</th> 
        </tr> 
    </thead>
    <tbody>  
    	<?php $this->ExecuteClaimsList();?>
    </tbody> 
</table>

<script>
$(document).ready(function() {
        $('#myTable').dataTable( {
		"order":[[1,"desc"]],	
                "aoColumns": [
                        { "asSorting": [ "asc", "desc"] },
                        { "asSorting": [ "asc", "desc"] },
                        { "asSorting": [ "asc", "desc"] },
                        { "asSorting": [ "asc", "desc"] },
                        null,null,null

                ]
        } );
} );
</script>
