<?php
include '../Db_Connection/db_libforsmall.php';


if($_POST['action'] =='all'){
   
  $delivery_boy_id=  $_POST["delivery_boy_id"];

    $query = "SELECT  * FROM `orders` WHERE   delivery_boy_id='$delivery_boy_id'";
   
    $statement = $conn->query($query);
    
    if($statement){
            while($row=mysqli_fetch_assoc($statement)){
         echo "<tr><td>".$row['order_id']."</td><td>".$row['user_name']."</td><td>".$row['address']."</td> <td>".$row['mobile']."</td>
         <td>".$row['grand_total']."</td> <td>".$row['p_status']."</td><td><input type='submit' data-id=".$row['order_id']." value='View' onClick='view(".$row['order_id'].")' name='view' id='view'  data-toggle='modal' data-target='#exampleModal'/> </td> </tr>";      
          
         
            }
    }else{
        echo "Error";
    }
   
    
   }else{
    $p_status=$_POST['action'];
   
        $delivery_boy_id=  $_POST["delivery_boy_id"];
      
          $query = "SELECT  * FROM `orders` WHERE   delivery_boy_id='$delivery_boy_id' and p_status='$p_status'";
         
          $statement = $conn->query($query);
          
          if($statement){
                  while($row=mysqli_fetch_assoc($statement)){
               echo "<tr><td>".$row['order_id']."</td><td>".$row['user_name']."</td><td>".$row['address']."</td> <td>".$row['mobile']."</td>
               <td>".$row['grand_total']."</td> <td>".$row['p_status']."</td><td><input type='submit' data-id=".$row['order_id']." value='View' onClick='view(".$row['order_id'].")' name='view' id='view'  data-toggle='modal' data-target='#exampleModal'/> </td> </tr>";      
                
               
                  }
          }else{
              echo "Error";
          }
         
          
         
   }
   















   if($_POST['action'] =='View'){
   
    $order_id=  $_POST["order_id"];
  
      $query = "SELECT  * FROM `orders` WHERE order_id='$order_id'";
   
      $statement = $conn->query($query);
      
      if($statement){
              while($row=mysqli_fetch_assoc($statement)){
                  if($row['p_status']=='Delivered'){

                  
           echo "<div class='row mb-3'><div class='col-sm-3'><input type=text class='form-control' value=".$row['order_id']." readonly /></div><div class='col-sm-3'><input type=text class='form-control' value=".$row['user_name']." readonly /></div><div class='col-sm-3'><input type=text class='form-control' value=".$row['address']." readonly/></div></div> <div class='row mb-3'> <div class='col-sm-3'><input type=text class='form-control' value=".$row['mobile']." readonly /></div>
          <div class='col-sm-3'><input type=text class='form-control' value=".$row['grand_total']." readonly /></div> <div class='col-sm-3'><input type=text class='form-control' value=".$row['p_status']." readonly /></div> </div> </div>";      
            
                  }else{
                    echo "<form method='POST' id='editform' name='editform'><div class='row mb-3'><div class='col-sm-3'><input type=text class='form-control' value=".$row['order_id']." readonly /></div><div class='col-sm-3'><input type=text class='form-control' value=".$row['user_name']." readonly /></div><div class='col-sm-3'><input type=text class='form-control' value=".$row['address']." readonly/></div></div> <div class='row mb-3'> <div class='col-sm-3'><input type=text class='form-control' value=".$row['mobile']." readonly /></div>
          <div class='col-sm-3'><input type=text class='form-control' value=".$row['grand_total']." readonly /></div> <div class='col-sm-3'><select class='form-control' id='status' name='status'> <option value='Ordered' <?php if(".$row['p_status']." == 'Ordered') echo('selected='selected'')?>Ordered</option><option value='Delivered' <?php if(".$row['p_status']." == 'Delivered') echo('selected=selected'')?>Delivered</option><option value='Rejected' <?php if(".$row['p_status']." == 'Rejected') echo('selected='selected'')?>Rejected</option></select></div> </div>
           </div><div class='row mb-3'><div class='col'><input type='submit'  class='form-control edit'   data-text=".$row['order_id']." value='Update'  name='edit' id='edit' /></div></form>";      
                  }
              }
      }else{
          echo "Error";
      }
     
      
     }
     if($_POST['action'] =='changeStatus'){
   
        $order_id=  $_POST["order_id"];
        $status=$_POST['status'];

      
          $query = "UPDATE orders SET p_status='$status' WHERE order_id='$order_id'";
       //echo $query;
          $statement = $conn->query($query);
          
          if($statement){
            echo "Success";
          }else{
              echo "Error";
          }
         
          
         }
        
     