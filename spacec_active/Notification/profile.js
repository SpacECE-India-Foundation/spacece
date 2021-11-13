$(document).ready(function(){
	
		$.ajax({


		'method':'POST',
		'url':'function.php?geid',
		success:function(data){
			//alert(data);

			///var data1=JSON.parse(data);
			$('#tablebody').append(data);
		}

			})
	
})