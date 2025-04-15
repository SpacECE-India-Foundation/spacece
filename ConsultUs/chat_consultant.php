<?php include('../Db_Connection/db_consultus_app.php'); ?>
<?php $nid=$_GET['id'];
 ?>

         <?php
                    // showing admin added from database
                    $sql = "SELECT * FROM `appointment` where `cid`='$nid'";
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
                                $date_appointment=$row['date_appointment'];
                                $email=$row['email'];
                                $mobile=$row['mobile'];
                                $uid=$row['uid'];
                                $status = $row['status'];
                            }}}

                                
                                // displaying value in table
                        ?>
                      
 