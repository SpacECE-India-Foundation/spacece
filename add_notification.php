<?php

include_once("../includes/header1.php");
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
<!-- Stylesheets -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../css/animate.css" />
    <link rel="stylesheet" href="../../css/owl.carousel.css" />
    <link rel="stylesheet" href="../../css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../Styles.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/jquery.convform.css" />
    <link rel="stylesheet" type="text/css" href="../../css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css" />

</head>
<body>
  
<div class="container d-flex justify-content-center">
  <div class="card col-8">
    <div class="card-header d-flex justify-content-center">Add Notifications</div>
    <div class="card-body">
    <form name="notification" id="notification" class="d-flex justify-content-center">

      <div class=" col-md-6 justify-content-center">
        <div class="form-group">
           <input class="form-control form-control-sm" type="text" placeholder="Notification Title" name="ntfTitle" aria-label="ntfTitle" id="ntfTitle">
        </div>
        <div class="form-group">
           <input class="form-control form-control-sm" id="ntfProduct" placeholder="Notification Product" name="ntfProduct" aria-label="ntfProduct">
        </div>
        <div class="form-group">
       
     
      <input type="date" class=" form-control form-control-sm" id="ntfTimeStamp" name="ntfTimeStamp">
  
 
        </div>
      <div class="mb-3 ">
    
    <textarea class="form-control "  name="ntfBody" placeholder="Description.." name="ntfBody" aria-label="ntfBody" ></textarea>
    </div>
    <input class="form-control form-control-sm btn-outline-primary" type="submit" placeholder=".form-control-sm" aria-label=".form-control-sm example">
    </form>
    </div>
  </div>
  
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.9.0/jquery.validate.min.js" integrity="sha512-FyKT5fVLnePWZFq8zELdcGwSjpMrRZuYmF+7YdKxVREKomnwN0KTUG8/udaVDdYFv7fTMEc+opLqHQRqBGs8+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
  



  
  $(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      var ntfTitle=$('#ntfTitle').val();
      var ntfBody=$('#ntfTitle').val();
      var ntfTimeStamp=$('#ntfTimeStamp').val();
      var  ntfProduct=$('#ntfProduct').val();   
   
// base_url='<?php // BASE_URL;?>';
//    $('.span').empty();
      $.ajax({
        
       type : "POST",
         data:{
            ntfTitle : ntfTitle,
            ntfBody : ntfBody,
            ntfTimeStamp:ntfTimeStamp,
            ntfProduct:ntfProduct,
            addNotification:1
         },url:'noti_function.php?addNotification',
         success:function(data){
            if(data==="Success"){
              Swal.fire({
 
            icon: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 1500
          })
            }
         
      
           
           

          }
        

  });
  }
  });
  $('#notification').validate({
    rules: {
      ntfTitle: {
        required: true,
        minlength: 5
      },
      ntfProduct: {
        required: true,
        minlength: 5
      },
      ntfTimeStamp:{
         required: true,
      },
      ntfBody:{
        required: true,
      }

     
    },
    messages: {
      email: {
        ntfTitle: "Notification Title",
        
      },
        ntfProduct: {
        required: "Please Enter Product name",
       
      },
      ntfTimeStamp:{
        required:"Please choose notification Date",
      },
      ntfBody:{
        required:"please choose Notification Body",
      },
      
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-control').append(error);
     //.closest('.form-control').append('Invalid Username Or password');
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

</script>



<script type="text/javascript">


  //$(function () {
   //var bindDatePicker = function() {
 //    $(".date").datetimepicker({
 //        format:'YYYY-MM-DD',
 //      icons: {
 //        time: "fa fa-clock-o",
 //        date: "fa fa-calendar",
 //        up: "fa fa-arrow-up",
 //        down: "fa fa-arrow-down"
 //      }
 //    }).find('input:first').on("blur",function () {
 //      // check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
 //      // update the format if it's yyyy-mm-dd
 //      var date = parseDate($(this).val());

 //      if (! isValidDate(date)) {
 //        //create date based on momentjs (we have that)
 //        date = moment().format('YYYY-MM-DD');
 //      }

 //      $(this).val(date);
 //    });
 //  }
   
 //   var isValidDate = function(value, format) {
 //    format = format || false;
 //    // lets parse the date to the best of our knowledge
 //    if (format) {
 //      value = parseDate(value);
 //    }

 //    var timestamp = Date.parse(value);

 //    return isNaN(timestamp) == false;
 //   }
   
 //   var parseDate = function(value) {
 //    var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
 //    if (m)
 //      value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);

 //    return value;
 //   }
   
 //   bindDatePicker();
 // });
</script>


</body>
</html>