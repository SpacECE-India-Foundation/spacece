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
<div class="container" id="container"></div>

<!-- <a href="javascript:void(0)" onclick="start()">Start</a> -->

<!-- <script type="text/javascript">
	function start(){
	
		
 $(document).ready(function() {

 	

 	  var base_url='<?php echo BASE_URL;?>';
       $.ajax({
       	method:"GET",
       	url:base_url+"/Notification/noti_function.php?notifications",	
       //url:base_url+"/function.php?notifications",
        success:function(data){
       			//alert(data);
       		var data1=JSON.parse(data);
       		//var no_id=data1[0].notification_id;
       		//alert(data1[0].notification_subject);
       	var create=	Push.create("You have received New Notification!", { 
       			body:data1[0].ntfTitle,
       			onClick:function(){
       				window.location.href=base_url+'/Notification/notification.php?id='+no_id;
       			}
       		// push(data.notification_id, data.notification_subject);
       		});

       	}
       })
        
    });
	}


</script> -->
<script>
    $(document).ready(function() {
        // Call refresh page function after 5000 milliseconds (or 5 seconds).
        setInterval('refreshPage()',2000);
    });

    function refreshPage() { 
//alert("Hello");
        //location.reload(); 
          	var base_url='<?php echo BASE_URL;?>';
       $.ajax({
       	method:"POST",
       	url:base_url+"/Notification/noti_function?notifications",	
       	success:function(data){
       			//alert(data);
       		var data1=JSON.parse(data);
       		var no_id=data1[0].ntfID;
       		//alert(data1[0].notification_subject);
       	var create=	Push.create("You have received New Notification!", { 
       			body:data1[0].ntfTitle,
                 requireInteraction: true,
       			onClick:function(){
                    var container = document.getElementById("container");
                   
                    
           // var data1=JSON.parse(data);
            //var no_id=data1[0].notification_id;
            //alert(data1[0].notification_subject);
                var create= Push.create("You have received New Notification!", { 
                body:data1[0].ntfTitle,
                onClick:function(){
                     $.ajax({
                     method:"POST",
                     url:base_url+"/Notification/noti_function.php?get",  
                     data:{no_id:no_id}, 
      
                success:function(data){
                    var data1=JSON.parse(data);
                //alert(data1[0].id);
                var data2='<div class="card"><div><strong>activity_no : </strong>'+data1[0].activity_no+'<br></div><strong> activity_name : </strong> '+data1[0].activity_name+'<div> <strong>activity_level: </strong>' +data1[0].activity_level+'</div> <div><strong>activity_dev_domain : </strong>' +data1[0].activity_dev_domain +'</div> <div><strong>activity_objectives : </strong>'+data1[0].activity_objectives+' </div> <strong><div>activity_key_dev : </strong>'+data1[0].activity_key_dev+'</div> <div><strong>activity_material : </strong>'+data1[0].activity_material +'</div><div><strong>activity_assessment : </strong>'+data1[0].activity_assessment+'</div> <div><strong>activity_process : </strong>'+data1[0].activity_process+'</div><div><strong>activity_instructions: </strong>'+data1[0].activity_instructions+' </div><div><strong>activity_date : </strong>'+data1[0].activity_date+'</div>';

                var container = document.getElementById("container").innerHTML =data2;
     // container.requestFullscreen();
     // container.appendChild(data2);


                  // window.location.href='Notification/index.php';
                }
            });
        }
            
            });


                  



      container.requestFullscreen();
       				
       			}
       		// push(data.notification_id, data.notification_subject);
       		});

       	}
       })
    }
</script> 
</body>
</html>




