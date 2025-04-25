<?php
//include("include/config.php");
?>
<form name="bulk" id="bulk" method="POST"> 
<div class="field_wrapper">
<div>
<input type="text" id="video_code[]" placeholder="Video id" name="video_code[]" class="col-sm-3" required > <input type="text" id="title[]" name="title[]" placeholder="vedio title" class="col-sm-3" required/>
<input type="text" name="desc[]" id="desc[]" class="col-sm-3"  placeholder="video description" required /> <input type="text" id="length[]"  placeholder="video length" name="length[]" class="col-sm-3" required/>
<input type="text" name="filter[]" id="filter[]"  placeholder="video filter" class="col-sm-3" required /> 
                          <select name="status[]" id="status[]" class="col-sm-3" required >
                          <option value="">Select...</option>
                          <option value="free">Free</option>
                          <option value="created">Created</option>
                          </select>

  <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus"></i></a>
</div>
</div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Save changes</button>

</div>
</form>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 5; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" id="video_code[]" name="video_code[]" placeholder="video id" class="col-sm-3" required > <input type="text" id="title[]" name="title[]" class="col-sm-3" placeholder="Video tiltle"  required /><input type="text" name="desc[]" id="desc[]" class="col-sm-3" placeholder="Video description" required/> <input type="text" id="length[]" name="length[]" placeholder="Enter length" class="col-sm-3" required/><input type="text" name="filter[]" id="filter[]" class="col-sm-3" placeholder="Insert Filter" required/> <select name="status[]" id="status[]" class="col-sm-3" required ><option value="">Select...</option><option value="free">Free</option><option value="created">Created</option> </select><a href="javascript:void(0);" class="remove_button"><i class="fa fa-minus" ></i></div>'; //New input field html 
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
        url:"Ajax/bulk_upload.php?bulk",
        data:form.serialize(),

        success: function(response){
        alert(response);
        }
    });
})


</script>



