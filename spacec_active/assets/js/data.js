


$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      
     var password=$('#password').val();
     var email=$('#email').val();
 var base_url='<?php echo BASE_URL;?>';
   $('.span').empty();
     $.ajax({
      	
      	type : "POST",
      	data:{
      		email : email,
      		password : password
      	},url:base_url+'/function.php?login',
      	success:function(data){

      		alert(data);
		if(data ==="Success"){
			window.location.href=base_url+'/profile.php';
		}else{
      $('.form-control').append('');
			//alert("Error");
			 $('#password').val('');
            $('.form-control').addClass('is-invalid');
             $('.form-control').append('Username Or Password Miss-Match');

             $('.form-group').css('color','red');
              $('.form-group').addClass('highlight');
		}
      
           
           

          }
      	

      });
    }
  });
  $('#formLogin').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
     
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
        password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long",
        matces:"Email and password missmatch"
      }
      
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-control').append(error);
     element.closest('.form-control').append('Invalid Username Or password');
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
      //$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
     //  $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
    }
  });
});





// $(document).on('submit','#formLogin',function(){
// 	var email=$('#email').val();
// var password=$('#password').val();
// $.ajax({
// 	'method':'POST',
// 	'data':{
// 		email:email,
// 		password:password
// 	},'url':'function.php?login',
// 	success:function(data){
// 		//alert(data);
// 		if(data ==="Success"){
// 			window.location.href='profile.php';
// 		}else{
// 			//alert("Error");
// 			$('#error').append('Invalid Username Or Password');
// 		}
// 	}
// });



// });
