<?php
include_once('includes/header.php');
session_start();
if(isset($_SESSION['u_id'])){
    header('Location:profile.php');
    exit();
}
?>




<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css" integrity="sha512-8wU/gsExpTv8PS32juUjuZx10OBHgxj5ZWoVDoJKvBrFy524wEKAUgS/64da3Qg4zD5kVwQh3+xFmzzOzFDAtg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="login_form_container">
    <h1>Login</h1>
    <form class="login_form"  name="formLogin" id="formLogin">
       <div class="form-group">
             <label for="exampleInputEmail1">Email address</label>
             <input type="email" name="email" class="form-control col-md-5" id="email" placeholder="Enter email">
                <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" id="password" class="form-control col-md-5" placeholder="Password">
            <button type="submit">Login</button>
        </div>

        

            
       
  <!-- <span id="error" class="error text-danger" style="color:red;"></span> -->
    </form>
</div>

<?php
include_once('includes/footer.php');

?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/jquery.form-validator.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
 <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script> 
 
 <script type="text/javascript">
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      
    
     var email=$('#email').val();
      var password=$('#password').val();
var base_url='<?php echo BASE_URL;?>';
   $('.span').empty();
     $.ajax({
        
        type : "POST",
        data:{
            email : email,
            password : password,
		login: 1
        },url:base_url+'/function',
        success:function(data){

            alert(data);
        if(data ==="Success"){
            window.location.href=base_url+'space';
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
//  var email=$('#email').val();
// var password=$('#password').val();
// $.ajax({
//  'method':'POST',
//  'data':{
//      email:email,
//      password:password
//  },'url':'function.php?login',
//  success:function(data){
//      //alert(data);
//      if(data ==="Success"){
//          window.location.href='profile.php';
//      }else{
//          //alert("Error");
//          $('#error').append('Invalid Username Or Password');
//      }
//  }
// });



// });
</script>


