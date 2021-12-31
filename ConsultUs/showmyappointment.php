<?php include('indexDB.php');
$main_logo = "../img/logo/SpacECELogo.jpg";
$module_logo = "../img/logo/ConsultUs.jpeg";
$module_name = "ConsultUs";

include_once '../common/header_module.php'; ?>
<?php
$user = '';
if(isset($_SESSION['current_user_email'])){
    $email = $_SESSION['current_user_email'];
    $user= $_SESSION['current_user_name'];
} else{
    header('location:../spacece_auth/login.php');
    exit();
}


 ?>
<html>
    <head>
        <title>appointment-HOME PAGE</title>
        <link rel="stylesheet"  href="css/admin.css">
    </head>
    <body style="background: linear-gradient(to bottom right, #ffcc99 0%, #ffffff 100%);">
        <! ... menu section starts...>
        <!-- <div class="menu text-center" style="background-color:orange;">
            <div class="wrapper">
<img src="img/space.jpg" alt="" style="width:6%;"><br><br>
                <ul>
                    <li><a href="index2.php?user=<?php // $user ?>">HOME</a></li>
                    <li><a href="alldoc.php?user=<?php // echo $user ?>">CONSULTANT</a></li>
                </ul>
            </div>
        </div> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
                <table class="tb-full">
                    <tr>
                        <th>S.NO.</th>
                        <th>CID:</th>
                        <th>CATEGORY:</th>
                        <th>USERNAME:</th>
                        <th>CONSULTANT NAME</th>
                        <th>MOBILE NUMBER:</th>
                        <th>A_DATE:</th>
                        <th>A_TIME:</th>
                        <th>STATUS:</th>
                        <th>BID:</th>
                        <th>ACTION:</th>
                    </tr>
                    <?php
                    error_reporting(0);
                    // showing admin added from database
                    $sql = "SELECT * FROM `appointment` where `username`='$user'";
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

                                $id=$row['cid'];
                                $full_name=$row['username'];
                                $category=$row['category'];
                                $cname=$row['cname'];
                                $cmob=$row['com_mob'];
  
                                $date_appointment=$row['date_appointment'];
                                $time_appointment=$row['time_appointment'];
                                $email=$row['email'];
                                $mobile=$row['mobile'];
                                $uid=$row['bid'];
                                $status = $row['status'];
                                

                                
                                // displaying value in table
                        ?>
                        <tr>
                        <td><?php echo $sno++; ?></td>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $category; ?></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $cname; ?></td>
                         <td><?php echo $cmob; ?></td>
                        <td><?php echo $date_appointment; ?></td>
                        <td><?php echo $time_appointment; ?></td>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $mobile; ?></td>
                        <td><?php echo $uid; ?></td>
                        <td><a href="<?php echo SITEURL;?>delete_appointment.php?id=<?php echo $uid;?>&user=<?php echo $user;?>&email=<?php echo $email;?>" class=" btn btn-sm ">DELETE APPOINTMENT</a>
            
                            <br><br>
                            <a href="./instamojo_payment/index.php?id=<?php echo $id;?>&user=<?php echo $user_name;?>" class="btn btn-sm" style="color:black;background-color:pink"> Confirm Appointment </a><br><br><br>
                            <a href="<?php echo SITEURL;?>chatbot/room.php?roomname=bid<?php echo $uid;?>" class="btn-primary">CHAT</a>
                        </td>

                    </tr>

                    <?php
                    }
                }
                        else{
                            echo "sorry no appointment found";
                        }
                    }
                    ?>

                </table>     
            </div>
        </div>
      <?php
                 include_once '../common/footer_module.php';
?>
                 </body>

                 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</html>