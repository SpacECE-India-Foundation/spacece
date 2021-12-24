<?php
include_once './header_local.php';
include_once '../common/header_module.php';
// include_once '../common/banner.php';
include('indexDB.php');
error_reporting(0);
$ref = $_GET['user'];
$cat = $_GET['category'];

define('DB_HOST_NAME', '3.109.14.4');
define('DB_USER_NAME', 'ostechnix');
define('DB_USER_PASSWORD', 'Password123#@!');
define('DB_USER_DATABASE', 'spaceece');
$conn1 = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_USER_DATABASE);

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

<div class="main-content text-centre" style="background: linear-gradient(to bottom right, #ffcc99 0%, #ffffff 100%);">
    <div class="wrapper ">
        <br><br><br><br><br>
        <h2>
            <center><u> CONSULTANT DETAIL</u></center>
        </h2>
        <br>
        <!.... BUTTON TO ADD consultant...>
            <a href="./chatbot/room.php?roomname=global1" class="btn-primary" style="color:black;background-color:orange;float:right;">CHAT GLOBAL</a><br><br>
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
                    <th>Available from(Time):</th>
                    <th>Available to(Time):</th>
                    <th>Consultant fee:</tho>
                    <th>Available from(day):</th>
                    <th>Available To(day):</th>
                    <th>Qualification:</th>
                </tr>
                <?php
                // showing admin added from database
                if ($cat == "all") {
                    $sql="SELECT DISTINCT users.u_id AS u_id,users.u_name AS u_name,
                  users.u_image AS u_image ,users.u_mob AS u_mob,
              consultant.c_office AS c_office,consultant.c_from_time As c_from_time, consultant.c_to_time As c_to_time , 
              consultant.c_language AS c_language, consultant.c_fee AS c_fee ,consultant.c_available_from As c_available_from,
              consultant.c_available_to AS c_available_to ,consultant.c_qualification AS c_qualification ,
              consultant_category.cat_name AS cat_name FROM consultant_category JOIN consultant JOIN users
              WHERE users.u_id = consultant.u_id 
              AND consultant.c_category=consultant_category.cat_id AND users.u_type='consultant'";
                    $res = mysqli_query($conn1, $sql);


                    //checking whether query is excuted or not
                    if ($res) {
                        // count that data is there or not in database
                        $count = mysqli_num_rows($res);
                        $sno = 1;
                        if ($count > 0) {
                            // we have data in database
                            while ($row = mysqli_fetch_assoc($res)) {
                                // extracting values from dATABASE

                        ?>
                        <tr>
                        <td><?php echo $sno++; ?></td>
                       <td><img src="<?php echo $row['u_image']; ?>" width="100" height="100"></td>
                        <td><?php echo $row['u_name']; ?></td>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo $row['c_office']; ?></td>
                        <td><?php echo $row['c_language']; ?></td>
                        <td><?php echo $row['c_from_time']; ?></td>
                        <td><?php echo $row['c_to_time']; ?></td>
                        <td><?php echo $row['c_fee']; ?></td>
                        <td><?php echo $row["c_available_from"]; ?></td>

                        <td><?php echo $row['c_available_to']; ?></td>
                        
                       
                        <td><?php echo $row['c_qualification']; ?></td>

                        <td>
                        <a href="./appoint.php?id=<?php echo $row['u_id'];?>&ctime=<?php echo $ctime;?>&stime=<?php echo $stime;?>
                        &name=<?php echo $row['u_name'];?>&category=<?php echo $row['cat_name'];?>
                        &conmob=<?php echo $conmob;?>&uid=<?php echo $uid;?>&user_name=<?php echo $user_name;?>
                        &user_email=<?php echo $user_email;?>&user_mob=<?php echo $user_mob;?>" 
                        class="btn-second" style="color:black;background-color:lightgreen">Book Appointment </a>

                    <?php
                                /*<a href="<?php echo SITEURL;?>chatbot/room.php?roomname=uid<?php echo $uid;?>" class="btn-primary">CHAT</a>*/

                            }
                        }
                    }
                } else {
                    ?>

                    <?php


                    // showing admin added from database

                    $sql = "SELECT DISTINCT users.u_id AS u_id,users.u_name AS u_name,
                    users.u_image AS u_image ,users.u_mob AS u_mob,
                consultant.c_office AS c_office,consultant.c_from_time As c_from_time, consultant.c_to_time As c_to_time , 
                consultant.c_language AS c_language, consultant.c_fee AS c_fee ,consultant.c_available_from As c_available_from,
                consultant.c_available_to AS c_available_to ,consultant.c_qualification AS c_qualification ,
                consultant_category.cat_name AS cat_name FROM consultant_category JOIN consultant JOIN users
                WHERE users.u_id = consultant.u_id AND  consultant_category.cat_name='$cat'
                AND consultant.c_category=consultant_category.cat_id AND users.u_type='consultant' ";
                    $res = mysqli_query($conn, $sql);


                    //checking whether query is excuted or not
                    if ($res) {
                        // count that data is there or not in database
                        $count = mysqli_num_rows($res);
                        $sno = 1;
                        if ($count > 0) {
                            // we have data in database
                            while ($row = mysqli_fetch_assoc($res)) {
                                // extracting values from dATABASE

                            ?>
                              <tr>
                        <td><?php echo $sno++; ?></td>
                       <td><img src="<?php echo $row['u_image']; ?>" width="100" height="100"></td>
                        <td><?php echo $row['u_name']; ?></td>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo $row['c_office']; ?></td>
                        <td><?php echo $row['c_language']; ?></td>
                        <td><?php echo $row['c_from_time']; ?></td>
                        <td><?php echo $row['c_to_time']; ?></td>
                        <td><?php echo $row['c_fee']; ?></td>
                        <td><?php echo $row["c_available_from"]; ?></td>

                        <td><?php echo $row['c_available_to']; ?></td>
                        
                       
                        <td><?php echo $row['c_qualification']; ?></td>

                        <td>
                        <a href="./appoint.php?id=<?php echo $row['u_id'];?>&ctime=<?php echo $ctime;?>&stime=<?php echo $stime;?>
                        &name=<?php echo $row['u_name'];?>&category=<?php echo $row['cat_name'];?>
                        &conmob=<?php echo $conmob;?>&uid=<?php echo $uid;?>&user_name=<?php echo $user_name;?>
                        &user_email=<?php echo $user_email;?>&user_mob=<?php echo $user_mob;?>" 
                        class="btn-second" style="color:black;background-color:lightgreen">Book Appointment </a>



                  

                <?php
                                /*<a href="<?php echo SITEURL;?>chatbot/room.php?roomname=uid<?php echo $uid;?>" class="btn-primary">CHAT</a>*/

                            }
                        }
                    }
                }
                ?>

            </table>
    </div>
</div>
<?php
// $module_logo = "../img/logo/ConsultUs.jpeg";
include_once '../common/footer_module.php';


?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>