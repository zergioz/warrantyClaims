<table id="myTable" class="table table-hover table-striped" border="0" cellpadding="0" cellspacing="1" width="100%">            
    <thead>
        <tr> 
            <th align='center'>USERNAME</th>
	    <th align='center'>NAME</th> 
            <th align='center'>STATUS</th> 
            <th align='center'>ACTIONS</th>             
        </tr> 
    </thead>
    <tbody>  
    	<?php $this->ExecuteViewTechUserList();?>
    </tbody> 
</table>

<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>
