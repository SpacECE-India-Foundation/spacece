<?php
include_once './header_local.php';
include_once '../common/header_module.php';
// include_once '../common/banner.php';
include('indexDB.php'); ?>
<?php error_reporting(0);
$ref = $_GET['user'];
$cat = $_GET['category']; ?>
?>

<div class="main-content text-centre" style="background: linear-gradient(to bottom right, #ffcc99 0%, #ffffff 100%);">
    <div class="wrapper ">
        <br><br><br><br><br>
        <h2>
            <center><u> CONSULTANT DETAIL</u></center>
        </h2>
        <br>
        <!.... BUTTON TO ADD consultant...>
            <a href="<?php echo SITEURL; ?>chatbot/room.php?roomname=global1" class="btn-primary" style="color:black;background-color:orange;float:right;">CHAT GLOBAL</a><br><br>
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
                </tr>
                <?php
                // showing admin added from database
                if ($cat == "all") {
                    $sql = "SELECT * FROM `consultant` ";
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

                                $id = $row['c_id'];
                                $full_name = $row['name'];
                                $category = $row['category'];
                                $office_location = $row['office'];
                                $stime = $row['stime'];
                                $ctime = $row['ctime'];
                                $lang = $row['lang'];
                                $img = $row['img'];
                                $uid = rand(0, 1000000);



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

                                </tr>

                    <?php
                                /*<a href="<?php echo SITEURL;?>chatbot/room.php?roomname=uid<?php echo $uid;?>" class="btn-primary">CHAT</a>*/

                            }
                        }
                    }
                } else {
                    ?>

                    <?php


                    // showing admin added from database

                    $sql = "SELECT * FROM `consultant` WHERE `category`='$cat' order by `name` ";
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

                                $id = $row['c_id'];
                                $full_name = $row['name'];
                                $category = $row['category'];
                                $office_location = $row['office'];
                                $stime = $row['stime'];
                                $ctime = $row['ctime'];
                                $img = $row['img'];
                                $lang = $row['lang'];
                                $uid = rand(0, 1000000);



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

                                </tr>

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