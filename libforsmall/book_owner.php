<?php
include_once './header_local.php';
include_once '../common/header_module.php';
//include_once '../common/banner.php';
//session_start();

if (isset($_SESSION["current_user_name"])) {
	header("location:profile.php");
}
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  
<div class="container-fluid">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js" defer></script>
<table id="BownerTable" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Order Id</th>
            <th>Name</th>
            <th>Address</th>
            <th>Total Price</th>
            <th>Mobile Number</th>
            <th>Note</th>
            <th>Status</th>
            <th>Payment id</th>
            
        </tr>
    </thead>
    <tbody>
        <tr>
            
        </tr>
        
    </tbody>
</table>
</div>

<?php
include_once '../common/footer_module.php';


?>
<script>
    $(document).ready(function() {
    $('#BownerTable').dataTable({
        "lengthChange": false,
		"processing":true,
		"serverSide":true,			
		'serverMethod': 'post',		
		
            "ajax" : {
    "url" : "./owner_ajax.php",
    "type" : "POST",
    "dataType" : "json"
   
},
        "columns": [
            {data: 'Order_id'},
            {data: 'Name'},
            {data: 'Address'},
            {data: 'GrandTotalPrice'},
            {data: 'MobileNumber'},
            {data: 'Note'},
            {data: 'Status'},
            {data: 'Payment_id'}
        ]
    });
    $('#BownerTable').on('draw.dt',function(){
        $('#BownerTable').Tabledit({
            url : './update_status.php',
           dataType : 'json',
            columns : {
               identifier: [0,'Order_id'],
               editable:[[6,'Status','{"Confirmed":"Confirmed","Ordered":"Ordered","Delivered":"Delivered"}']]
           },
           restoreButton:false,
   onSuccess:function(data, textStatus, jqXHR)
   {
    if(data.action == 'delete')
    {
     $('#' + data.id).remove();
     $('#sample_data').DataTable().ajax.reload();
    }
   }
 
        })
    })
});
</script>