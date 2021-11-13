<?php
include_once('includes/header.php');


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/push.min.js"></script>
<script type="text/javascript" src="assets/js/serviceWorker.min.js"></script>
<script src="assets/js/push.js"></script>

</head>
<body>


<a href="javascript:void(0)" onclick="start()">Start</a>

<script type="text/javascript">
	function start(){
	
		
// 		Push.create("Hello world!", {
//     body: "How's it hangin'?",
    
//     timeout: 4000,
//     onClick: function () {
//         window.focus();

//         this.close();
//     }
// });

 $(document).ready(function() {

 	

 	  var base_url='<?php echo BASE_URL;?>';
       $.ajax({
       	method:"GET",
       	url:base_url+"/function.php?notifications",	
       //url:base_url+"/function.php?notifications",
        success:function(data){
       			alert(data);
       		var data1=JSON.parse(data);
       		//var no_id=data1[0].notification_id;
       		//alert(data1[0].notification_subject);
       	var create=	Push.create("You have received New Notification!", { 
       			body:data1[0].ntfTitle,
       			onClick:function(){
       				window.location.href=base_url+'/notification.php?id='+no_id;
       			}
       		// push(data.notification_id, data.notification_subject);
       		});

       	}
       })


      
     
       // 	var base_url='<?php echo BASE_URL;?>';
       // $.ajax({
       // 	method:"POST",
       // 	url:base_url+"/function.php?notifications",	
       // 	success:function(data){
       			
       // 		var data1=JSON.parse(data);
       // 		var no_id=data1[0].notification_id;
       // 		//alert(data1[0].notification_subject);
       // 	var create=	Push.create("You have received New Notification!", { 
       // 			body:data1[0].notification_subject,
       // 			onClick:function(){
       // 				window.location.href=base_url+'/notification.php?id='+no_id;
       // 			}
       // 		// push(data.notification_id, data.notification_subject);
       // 		});

       // 	}
       // })
        
    });
	}


</script>
<script>
    $(document).ready(function() {
        // Call refresh page function after 5000 milliseconds (or 5 seconds).
        setInterval('refreshPage()',1500000);
    });

    function refreshPage() { 
        //location.reload(); 
          	var base_url='<?php echo BASE_URL;?>';
       $.ajax({
       	method:"POST",
       	url:base_url+"/function.php?notifications",	
       	success:function(data){
       			
       		var data1=JSON.parse(data);
       		var no_id=data1[0].ntfID;
       		//alert(data1[0].notification_subject);
       	var create=	Push.create("You have received New Notification!", { 
       			body:data1[0].ntfTitle,
       			onClick:function(){
       				window.location.href=base_url+'/notification.php?id='+no_id;
       			}
       		// push(data.notification_id, data.notification_subject);
       		});

       	}
       })
    }
</script> 
</body>
</html>




