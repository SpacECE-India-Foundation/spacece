<?php
include_once './header_local.php';
include_once '../common/header_module.php';
//include_once '../common/banner.php';
//session_start();
$_SESSION['delivery_boy_id']='25';
if (isset($_SESSION["current_user_name"])) {
	header("location:profile.php");
}
?>

  
<div class="container-fluid">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<form method="POSt">
 <div class="row">
   <div class="col-sm-3">Filter</div>
   <div class="col-sm-3"><select class="form-control " id="filterOrder" name="filterOrder"><option value="all">All</option>
     <option value="Ordered">Ordered</option>
     <option value="Delivered">Delivered</option> 
   <option value="Rejected">Rejected</option></select></div>
   <div class="col-sm-3">
     <input type="submit" id="change" name="change">
   </div>
 </div>

  

</form>

 
<table id="BownerTable" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Order Id</th>
            <th>Name</th>
            <th>Address</th>
            <th>Mobile Number</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody id="tablebody">
        
        
    </tbody>
</table>

<div class="card1" id="card1"></div>


<div class="modal fade  " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg" role="document">
   
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal">View all Videos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
           
            <div class="card" id="card">
              

              
            </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once '../common/footer_module.php';


?>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src="js/scriptcall.js"></script> -->

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function(){
        var delivery_boy_id=<?php echo $_SESSION['delivery_boy_id'];?>;
        $.ajax({
            url : './deliboy_action.php',
            method : 'POST',
            data:{ delivery_boy_id: delivery_boy_id,
                   action: 'all' },
            success:function(result){
                $('#tablebody').append(result);
                //alert(result);
            }
        });


       
    });
    function view(id){
      $('#card').empty();
    $.ajax({
            url : './deliboy_action.php',
            method : 'POST',
            data:{ order_id:id,
                   action: 'View' },
            success:function(result){
                
                $('#card').append(result);
               
            }
        });

}

$('#change').on('click',function(e){
  $('#tablebody').empty();
  var filter=$('#filterOrder').val();
  var delivery_boy_id=<?php echo $_SESSION['delivery_boy_id'];?>;
  //alert(filter);
  e.preventDefault();
  $.ajax({
            url : './deliboy_action.php',
            method : 'POST',
            data:{ delivery_boy_id:delivery_boy_id,
                   action:filter,
                  
                   },
            success:function(result){
                
              $('#tablebody').append(result);
               
            }
        });
})

    </script>
<script>
 $(document).on("click", "#edit", function(e) {
  //$('#exampleModal').modal('show');
var id=$('#edit').data('text');

 var status=$('#status').val();
 e.preventDefault();
 $.ajax({
  url : './deliboy_action.php',
            method : 'POST',
            data:{ order_id:id,
              status:status,
              
                   action: 'changeStatus' },
            success:function(result){
                
               alert(result);
               
            }

 })
 


});
  
</script>