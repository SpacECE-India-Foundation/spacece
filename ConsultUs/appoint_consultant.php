<?php
include_once './includes/header1.php';
 include('../Db_Connection/indexDB.php'); ?>
<?php //error_reporting(0); 
$ref = $_GET['user']; ?>
<html>
    <head>
        <title>Appointment-HOME PAGE</title>
        <link rel="stylesheet"  href="css/admin.css">
    </head>
    <body>
        <! ... menu section starts...>
        <!-- <div class="menu text-center" style="background-color:orange;">
<img src="img/space.jpg" alt="" style="width:6%; ">
            <div class="wrapper">

                <ul>
                    <li><a href="index3.php?user=<?php echo $ref ?>">HOME</a></li>
                    <li><a href="appoint_consultant.php?user=<?php echo $ref ?>">CONSULTANT PAGE</a></li>
                    <li><a href="appoint2.php?user=<?php echo $ref ?>">SHOW APPOINTMENTS TAKEN</a></li>
                </ul>
            </div>
        </div> -->
        <!... menu section ends....>

        
        <! ... main section starts...>
        <div class="main-content text-centre" style="background: linear-gradient(to bottom right, #ffcc99 0%, #ffffff 100%);";">
            <div class="wrapper "><br>
                <u><center><h2 > CONSULTANT DETAIL</h2></center></u>
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
                if(isset($_SESSION['appointment'])){
                    echo  $_SESSION['appointment']; // displaying session update
                    unset($_SESSION['appointment']); // removing session  update
                }
                
                echo "<br>";
                echo "<br>";

                ?>


                 <!.... BUTTON TO ADD consultant...>
                 <a href="<?php echo SITEURL;?>chatbot/room.php?roomname=global1" class="btn-primary" style="background-color:orange;float:right;color:black;">CHAT GLOBAL</a><br><br>
                 <br>
                 <br>

                <table class="tb-full">
                    <tr>
                        <th>S.NO.:</th>
                        <th>IMAGE:</th>
                        <th>FULL NAME:</th>
                        <th>CATEGORY:</th>
                        <th>OFFICE:</th>
                        <th>LANGUAGE:</th>
                        <th>TIME(from):</th>
                        <th>TIME(to):</th>
                        <th>ACTION:</th>
                    </tr>
                    <?php
                    // schanges
                    $sql = "SELECT * FROM `consultant` WHERE `name`= '$ref'";
                    $res2 = mysqli_query($conn,$sql);


                    //checking whether query is excuted or not
                    if($res2){
                        // count that data is there or not in database
                        $count= mysqli_num_rows($res2);
                        $sno2 =1;
                        if($count>0){
                            // we have data in database
                            while($row2 = mysqli_fetch_assoc($res2))
                            {
                                // extracting values from dATABASE

                                $user_id=$row2['c_id'];
                                $user_name=$row2['name'];
                                $user_email=$row2['email'];
                                $user_mob=$row2['mobile'];          

                            }}}
                                // changes
                        ?>
                    <?php
                    // showing admin added from database
                    $sql = "SELECT * FROM `consultant` WHERE `name`!= '$ref' ";
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

                                $id=$row['c_id'];
                                $full_name=$row['name'];
                                $category=$row['category'];
                                $office_location=$row['office'];
                                $stime=$row['stime'];
                                $ctime=$row['ctime'];
                                $lang=$row['lang'];
                                $conmob=$row['mobile'];
                                $img = $row['img'];
                                $uid= rand(0,1000000);
                                

                                
                                // displaying value in table
                        ?>
                     
                        <tr>
                        <td><?php echo $sno++; ?></td>
                        <td><img src="<?php echo $img ?>" width="100" height="100"></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $category; ?></td>
                        <td><?php echo $office_location; ?></td>
                        <td><?php echo $lang; ?></td>
                        <td><?php echo $ctime; ?></td>
                        <td><?php echo $stime; ?></td>


                        <td>
                            <a href="<?php echo SITEURL;?>appoint.php?id=<?php echo $id;?>&ctime=<?php echo $ctime;?>&stime=<?php echo $stime;?>&name=<?php echo $full_name;?>&category=<?php echo $category;?>&conmob=<?php echo $conmob;?>&uid=<?php echo $uid;?>&user_name=<?php echo $user_name;?>&user_email=<?php echo $user_email;?>&user_mob=<?php echo $user_mob;?>" class="btn-second" style="color:black;background-color:lightgreen;">Book Appointment </a>
                            <br><br><br>
 <!-- <a href="<?php //echo SITEURL;?>instamojo_payment/index2.php?id=<?php echo $id;?>&user=<?php //echo $user_email;?>" class="btn-second" style="color:black;background-color:pink;"> Confirm Appointment </a> -->
                            <br><br><br>

                        </td>
                    </tr>
                   
                    <?php
                    /*<a href="<?php echo SITEURL;?>chatbot/room.php?roomname=uid<?php echo $uid;?>" class="btn-primary">CHAT</a>*/
                     }
                    }
                    }
                    ?>

                </table>     
            </div>
        </div>
        <?php
    include_once './includes/footer1.php';
        ?>
        
         <!-- <div class="footer text-centre" style="background-color:orange;">
            <div class="wrapper" >
                 <p class="text-center"><a href="#"></a></p>
            </div>
         </div> -->
        <!... end section ends....>
    </body>


</html>