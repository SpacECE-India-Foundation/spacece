<?php
include '../../Db_Connection/db_libforsmall.php';
include_once '..//header_local.php';
include_once '../../common/header_module.php';
include_once './templates/sidebar.php';
//session_start();

// if (empty($_SESSION['uid'])) {
// 	header("location:index.php");
// }
if(isset($_POST['submit'])){
    $status=$_POST['status'];
    $uid= $_SESSION['uid'];
    //echo $status;
    $sql = "SELECT * from orders where owner_id='$uid' and order_status= '$status'";
    $res = $conn->query($sql);
}else{
$sql = "SELECT * from orders where owner_id='$uid'";
    $res = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
    <form method="POST" action="">
        <div class="row">
            <div class="col-sm-3"><label>Filter Statts</label></div>
<div class="col">
    <select name="status" id="status" class="form-control col-sm-4">
            <option value="Ordered" >Ordered</option>
            <option value="Accepted">Accepted</option>
            <option value="Rejected">Rejected</option>
            </select>
            </div>
           <div class="col-sm-4">
            <input type="submit" class="btn btn-primary" id="submit" name="submit"/>
            </div>
            </div>
    </form>



        <form method="POST" id="orders">
        <table class="table table-bordered table-hover table-responsive table-striped mt-4">
            <thead>
                <tr>
                    <td>Order id</td>
                    <td>User id</td>
                    <td>Product id</td>
                    <td>Transaction id</td>
                    <td>Product Status</td>
                    <td>Grand Total</td>
                    <td>Address</td>
                    <td>Mobile</td>
                    <td>User Name</td>
                    <td>User Note</td>
                    <td>Order Status</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
            <?php
    
    while($row=mysqli_fetch_assoc($res)){
         ?>
          <tr>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['product_id']; ?></td>
            <td><?php echo $row['qty']; ?></td>
            <td><?php echo $row['trx_id']; ?></td>
            <td>
            <select name="p_status" id="p_status-<?php echo $row['order_id']; ?>" class="form-control">
            <option value="Ordered" <?php if($row['p_status']=="Ordered") echo 'selected="selected"'; ?> >Ordered</option>
            <option value="Packed" <?php if($row['p_status']=="Packed") echo 'selected="selected"'; ?> >Packed</option>
            <option value="Dispatched" <?php if($row['p_status']=="Dispatched") echo 'selected="selected"'; ?> >Dispatched</option>
            <option value="Ready" <?php if($row['p_status']=="Ready") echo 'selected="selected"'; ?> >Ready to deliver</option>
            <option value="Delivered" <?php if($row['p_status']=="Delivered") echo 'selected="selected"'; ?> >Delivered</option>
            </select>
               
            </td>
            <td><?php echo $row['grand_total']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['mobile']; ?></td>
            <td><?php echo $row['user_name']; ?></td>
            <td><?php echo $row['u_note']; ?></td>
            <td>
            <select name="status" id="status-<?php echo $row['order_id']; ?>" class="form-control">
            <option value="Ordered" <?php if($row['order_status']=="Ordered") echo 'selected="selected"'; ?> >Ordered</option>
            <option value="Accepted" <?php if($row['order_status']=="Accepted") echo 'selected="selected"'; ?> >Accepted</option>
            <option value="Rejected" <?php if($row['order_status']=="Rejected") echo 'selected="selected"'; ?> >Rejected</option>
            </select>
            </td>
            <td><input type="button" id="<?php echo $row['order_id']; ?>" name="edit" value="edit" class="btn btn-sm btn-danger edit"> </td>
        </tr>
         <?php
          }

          ?>
               
            </tbody>
        </table>
        </form>
    </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script>
       $(document).ready(function(){
           $('.edit').on('click',function(){
            var id=$(this).prop('id');
            var p_status=($('#p_status-'+id).val());
            var status=$('#status-'+id).val();
            Swal.fire({
  title: 'Are you sure?',
  text: "Do you Want to change Status!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Update it!'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
                method:'POST',
                url:'./update_status.php',
                data:{
                    id:id,
                    p_status:p_status,
                    status:status,
                    action: 'update_status'
                },
                success:function(data){
                    if(data=="Success"){
                        Swal.fire(
                        'Updated!',
                        'Order has been Updated.',
                        'success'
                        )
                    }else{
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        
                        })
                        }    
                }
            });
   
  }
})     
           })
       })
       </script>
</body>
</html>
<?php include_once '../../common/footer_module.php'; ?>