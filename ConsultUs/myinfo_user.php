<?php include('indexDB.php') ?>
<?php //error_reporting(0); 
 $ref = $_GET['user']; 
//$nid = $_GET['id'];?>
<html>
    <head>
        <title>appointment-HOME PAGE</title>
        <link rel="stylesheet"  href="css/admin.css">
    </head>
    <body>
        <! ... menu section starts...>
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index2.php?user=<?php echo $ref ?>">HOME</a></li>
                             </ul>
            </div>
        </div>
        <!... menu section ends....>

        
        <! ... main section starts...>
        <div class="main-content text-centre" style="background-color: #c8d6e5;">
            <div class="wrapper ">
                <h2 > USER DETAIL</h2>
                <br>
                <?php
                if(isset($_SESSION['add'])){
                    echo  $_SESSION['add']; // displaying session add
                    unset($_SESSION['add']); // removing session  add
                }
                ?>
                 <?php
                if(isset($_SESSION['delete'])){
                    echo  $_SESSION['delete']; // displaying session delete
                    unset($_SESSION['delete']); // removing session  delete
                }

                ?>
                 <?php
                if(isset($_SESSION['update'])){
                    echo  $_SESSION['update']; // displaying session delete
                    unset($_SESSION['update']); // removing session  delete
                }

                ?>
                <?php
                if(isset($_SESSION['appointment'])){
                    echo  $_SESSION['appointment']; // displaying session update
                    unset($_SESSION['appointment']); // removing session  update
                }
                
                echo "<br>";
                echo "<br>";

                ?>


                 <!.... BUTTON TO ADD consultant...>
                 <a href="<?php echo SITEURL;?>chatbot/room.php?roomname=global1" class="btn-primary">CHAT GLOBAL</a>
                 <br>
                 <br>

                <table class="tb-full">
                    <tr>
                        <th>S.NO.:</th>
                        <th>IMAGE:</th>
                        <th>FULL NAME:</th>
                        <th>USERNAME:</th>
                        <th>MOB.NO:</th>
                        <th>EMAIL:</th>
                        <th>ACTION:</th>
                    </tr>
                     
                    <?php
                    // showing admin added from database
                    $sql = "SELECT * FROM `login` where `username`= '$ref' ";
                    $res = mysqli_query($conn,$sql);


                    //checking whether query is excuted or not
                    if($res){
                        // count that data is there or not in database
                        $count= mysqli_num_rows($res);
                        $sno =1;
                        if($count>0){
                            // we have data in database
                            while($row = mysqli_fetch_assoc($res))
                            {
                                // extracting values from dATABASE

                                $id=$row['UID'];
                                $full_name=$row['name'];
                                $user_name=$row['username'];
                                $mob=$row['phone'];
                                $email=$row['email'];
                                $img = $row['img'];
                                

                                
                                // displaying value in table
                        ?>
                     
                        <tr>
                        <td><?php echo $sno++; ?></td>
                        <td><img src="<?php echo $img ?>" width="100" height="100"></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $user_name; ?></td>
                         <td><?php echo $mob; ?></td>
                        <td><?php echo $email; ?></td>
       <td> <a href="<?php echo SITEURL;?>user_profile.php?id=<?php echo $id;?>&name=<?php echo $user_name;?>" class="btn-second" style="color:black;">Update Profile </a></td>


                        
                    </tr>
                   
                    <?php
                    /*<a href="<?php echo SITEURL;?>chatbot/room.php?roomname=uid<?php echo $uid;?>" class="btn-primary">CHAT</a>*/
                     }
                    }
                    }
                    else{
                        echo "sorry";
                    }
                    ?>

                </table>     
            </div>
        </div>
        <!... main section ends....>
        <! ... end section starts...>
         <div class="footer text-centre">
            <div class="wrapper">
                 <p class="text-center">DEVELOPED BY:<a href="#">yashasvi pundeer</a></p>
            </div>
         </div>
        <!... end section ends....>
    </body>


</html>