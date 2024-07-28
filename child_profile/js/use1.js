$(document).ready(function(){
	emaillog = $("#emaillog");
	passlog  = $("#passlog");
	erroralert	=$("#erroralert");
	btx 	 = $("#signin");
	yes = 1;
	no =0;

	 hmm();
});

function hmm(){
	btx.on('click',function(){
		clean();
	})
}

// function disable(){
// 	window.history.backward();
// }

function clean(){
	emaila = emaillog.val();
	passy  = passlog.val();
	$.ajax({
				url:'relative/clerklogin.php',
				method:'POST',
				data:{
					up  : "now",
					email : emaila,
					pass  : passy
				},
				success: function(data){
					if(data == 5){
						
						// erroralert.html("");
						count = 3
						setsec = okay(count);
						setInterval(function(){
							yes = 1;
							erroralert.addClass("alert alert-success");
					erroralert.html("Details are correct. Loggin in " + "<span style='font-size:16px; color:green'><b>"+count+"</b></span>"+"   "+setsec);
								count--;
								if (count < 0){
									count = 0;
									erroralert.removeClass("alert alert-success");
										erroralert.html("");
								}
							},1000);
									setTimeout(function(){
										no = 0;
								location.assign('./home/cdashboard');
							}, 4000);
                    }else if(data == 2){
                    	erroralert.addClass("alert alert-danger");
						erroralert.html("UserName or Password is incorrect");
                    }else if(data == 1){
                    	erroralert.addClass("alert alert-danger");
						erroralert.html("Error occur");
                    }else if(data == 4){
                    	erroralert.addClass("alert alert-danger");
						erroralert.html("Data Not set");
                    }else if(data == 8){
                    	erroralert.addClass("alert alert-danger");
						erroralert.html("You are already logged in");
                    }
				}
				
	});
}

function okay(count) {
	if(count>=2){
		return "seconds";
	}else{
		return "second";
	}
}