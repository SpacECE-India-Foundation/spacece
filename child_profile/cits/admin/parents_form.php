<?php

include("./include/config.php");
$sql="SELECT * FROM `parents_questions` ORDER BY q_id LIMIT 10";
$select=mysqli_query($con,$sql);
if($select){
    while($row=mysqli_fetch_assoc($select)){
       
        ?>
        <form method="POST">
            <h5><?php  echo $row['q_text']; ?></h5>
        <input type="hidden" id="q_id" name="q_id" value=<?php echo $row['q_id'];  ?>/>
        <input type="text" id="answ"name="answ">
        <input type="submit" value="submit">
        </form>
        <?php
    }
}


