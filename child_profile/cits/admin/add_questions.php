
<?php include('include/sidenav.html');?>

<?php include('include/head.php');?>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
integrity="sha384s-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script defer src="https://friconix.com/cdn/friconix.js"> </script>
<?php include('include/sidenav.html');?>


<div class="container">
  <h4>Add Questions</h4>
<form name="bulk" id="bulk" method="POST"> 
<div class="field_wrapper">
<div>

<div class="row mb-3">
<input type="text" id="q_text[]"  placeholder="Enter Questions" name="q_text[]" class="col-sm-3 form-control" required/>
<select name="category[]" id="category[]" class="col-sm-3 form-control" required >
                          <option value="">Select Category...</option>
                          <option value="Social">Social</option>
                          <option value="Physical">Physical</option>
                          <option value="Asthetic">Asthetic</option>
                          <option value="Cognitive">Cognitive</option>
                          <option value="Emotional">Emotional</option>
                          <option value="Language">Language</option>
                          </select>
                          <select name="age[]" id="age[]" class="col-sm-3 form-control" required >
                          <option value="">Select Age...</option>
                          <option value="2">0-2 Months</option>
                          <option value="6">5-6 Months</option>
                          <option value="18">13-18 Months</option>
                          <option value="48">37-48 Months</option>
                          </select>
                          <div class="col-sm-1 mt-2">

                          <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus"></i></a>
</div></div>
 

</div>
</div>
 <div class="mb-3">
   <input type="submit"  class="btn btn-primary">
  <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
  </div>
 

</form>

</div>
<?php include('include/footer.php');?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 5; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="row mb-3"><input type="text" id="q_text[]"  placeholder="Enter Questions" name="q_text[]" class="col-sm-3 form-control" required/><select name="category[]" id="category[]" class="col-sm-3 form-control" required ><option value="">Select Category...</option><option value="Social">Social</option><option value="Physical">Physical</option><option value="Asthetic">Asthetic</option><option value="Cognitive">Cognitive</option><option value="Emotional">Emotional</option><option value="Language">Language</option></select><select name="age[]" id="age[]" class="col-sm-3 form-control" required ><option value="">Select Age...</option><option value="2">0-2 Months</option><option value="6">5-6 Months</option><option value="18">13-18 Months</option><option value="48">37-48 Months</option></select><a href="javascript:void(0);" class="remove_button"><i class="fa fa-minus" ></i></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<script>
$('#bulk').on('submit',function(){
  
  // var id= [];
    //   $('input[name="video_code[]"]').each(function(i, item) {
    //      // alert($(item).val());
    //     id.push($(item).val()) ;
        
    //  });
     //alert(id);
     var form=$("#bulk");
     $.ajax({
        type:"POST",
        url:"./question_ajax.php",
        data:form.serialize(),

        success: function(response){
        alert(response);
        }
    });
})


</script>



