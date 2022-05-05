<?php
session_start();
$_SESSION['id']='7';
include("./include/config.php");
$uid=$_SESSION['id'];
$sql1="SELECT users.id as user_id,tblchildren.ID as children_id,tblchildren.CreationDate FROM `tblchildren` join users WHERE tblchildren.parentEmail=users.email and users.id='$uid'";

$select1=mysqli_query($con,$sql1);
if($select1){

    while($row1=mysqli_fetch_assoc($select1)){
        $d1 = new DateTime($row1['CreationDate']);
        $d2 = new DateTime();
        $months = 0;
        
        $d1->add(new \DateInterval('P1M'));
        while ($d1 <= $d2){
            $months ++;
            $d1->add(new \DateInterval('P1M'));
        }
       // echo $months;
        //print_r($months);
        $days =0;
        if($months<2){
            $days ==2;
        }elseif( ($months < 6)){
            $days =6;
        }elseif( $months<18){
            $days =18;   
        }elseif( $months<48){
            $days =48;  
        }
        //echo $days;
$sql="SELECT * FROM `parents_questions` WHERE child_age='$days' ORDER BY q_id LIMIT 10";
$select=mysqli_query($con,$sql);
if($select){
    while($row=mysqli_fetch_assoc($select)){
       
        ?>
        <form id="answer" id="answer" method="POST">
            <h5><?php  echo $row['q_text']; ?></h5>
            <input type="hidden" id="children_id[]" name="children_id[]" value=<?php echo $row1['children_id'];  ?>/>
            <input type="hidden" id="children_age" name="children_age" value=<?php echo $days; ?>/>
            <input type="hidden" id="parent_id" name="parent_id" value=<?php echo $uid; ?>/>
        <input type="hidden" id="q_id" name="q_id" value=<?php echo $row['q_id'];  ?>/>
        <input type="text" id="answ[]"name="answ[]">
        <input type="submit" value="submit" id="submit">
        </form>
        <?php
        }
     }
}
}
?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script> 
<script type="text/javascript">
    $('#answer').on('submit',function(){
  

     var form=$("#answer");
     $.ajax({
        type:"POST",
        url:"./answer_ajax.php",
        data:form.serialize(),
        success:function(response){
        alert(response);
        }
    });
})
</script>