<?php


include_once('includes/header.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
       <div class="container">
       <div class="card  d-flex justify-content-center ">
              <div class="card-header" id="header"> </div>
              <div id="n_id" class="mb-2"><strong> Notification Id :</strong></div>
              <div id="n_text" class="mb-2"><strong>Notification text : </strong></div>
              <div id="ntfBody" class="mb-2"><strong>Notification Body : </strong></div>
              <div id="ntfProduct" class="mb-2"><strong>Product Notification : </strong></div>
              <div id="ntfTimeStamp" class="mb-2"><strong>Notification Date and Time :</strong></div>
       </div>
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function() {
 	 var base_url='<?php echo BASE_URL;?>';
 	var baseUrl = (window.location).href;
 	//$('#n_id').empty();
       		//$('#n_text').empty();
       		
 	//var id = GetUrlKeyValue("id", false, location.href);
 	var query = window.location.search.substring(1);
var vars = query.split("=");
var id= vars[1];
       $.ajax({
       	method:"POST",
       	data:{
       		id:id
       	},
       	url:base_url+"/Notification/noti_function.php?getNotification",	
       	success:function(data){
       			
       		var data1=JSON.parse(data);

       		$('#n_id').append(data1[0].ntfID);
       		$('#n_text').append(data1[0].ntfTitle);
                    
                     $('#ntfBody').append(data1[0].ntfBody);
                     $('#ntfProduct').append(data1[0].ntfProduct);
       		
                      $('#ntfTimeStamp').append(data1[0].ntfTimeStamp);
                       $('#header').append(data1[0].ntfTitle);
       	}
       })
    });

</script>