<?php include '../Db_Connection/db_spacece.php'; ?>
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
                    <li><a href="index3.php?user=<?php echo $ref ?>">HOME</a></li>
                    <li><a href="show_appointment.php?user=<?php echo $ref ?>">SHOW MY APPOINTMENT</a></li>
                </ul>
            </div>
        </div>
        <!... menu section ends....>

        
        <! ... main section starts...>
        <div class="main-content text-centre" style="background-color: #c8d6e5;">
            <div class="wrapper ">
                <h2 > CONSULTANT_DETAIL</h2>
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
                 <a href="<?php echo SITEURL;?>chatbot/room.php?roomname=global1" class="btn-primary">CHAT_GLOBAL</a>
                 <br>
                 <br>

                <table class="tb-full">
                    <tr>
                        <th>S.NO.</th>
                        <th>IMAGE</th>
                        <th>FULL NAME:</th>
                        <th>CATEGORY:</th>
                        <th>OFFICE:</th>
                        <th>MOB.NO.</th>
                        <th>TIME:</th>
                    </tr>
                     
                    <?php
                    // showing admin added from database
                    $sql = "SELECT * FROM `consultant` where `name`= '$ref' ";
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
                                $mob=$row['mobile'];
                                $ctime=$row['ctime'];
                                $img = "https://doctoryouneed.org/wp-content/uploads/2020/05/dr-new-demo-image-57.png";
                                

                                
                                // displaying value in table
                        ?>
                     
                        <tr>
                        <td><?php echo $sno++; ?></td>
                        <td><img src="https://doctoryouneed.org/wp-content/uploads/2020/05/dr-new-demo-image-57.png" width="100" height="100"></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $category; ?></td>
                        <td><?php echo $office_location; ?></td>
                        <td><?php echo $mob; ?></td>
                        <td><?php echo $ctime; ?></td>
                        
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