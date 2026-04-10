
<?php include('../../common/header_module.php');
//session_start();
if(empty($_SESSION['current_user_email'])){
	header('location:../../../spacece_auth/login.php');
}
?>

       
<?php


include("./include/config.php");
$uid=$_SESSION['current_user_id'];
					$email=$_SESSION['current_user_email'];
//$sql1="SELECT users.id as user_id,tblchildren.ID as children_id,tblchildren.childDoB FROM `tblchildren` join users WHERE tblchildren.parentEmail=users.email and users.id='$uid'";
$sql1="SELECT tblchildren.ID as children_id, tblchildren.childDoB,DATEDIFF(CURDATE(),tblchildren.childDoB) as diff,parents_answers.age from tblchildren JOIN parents_answers WHERE tblchildren.parentEmail='$email'";
$select1=mysqli_query($con,$sql1);
if($select1){

    while($row1=mysqli_fetch_assoc($select1)){
        if($row1['diff']>$row1['age']){

        
        $months=$row1['diff'];
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
        <div class="mt-3" style="margin-top:15%;">
	<?php include('include/sidenav.html');?>
	</div>
        <form id="answer" id="answer" method="POST">
            <h5><?php  echo $row['q_text']; ?></h5>
            <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['current_user_id'];  ?>">
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
}else{
    echo "No Data Found";
}
?>


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