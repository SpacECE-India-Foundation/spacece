<?php
include('../Db_Connection/indexDB.php');


  $sql = "SELECT * FROM `appointment` where `cname`='$nid'";
                    $res = mysqli_query($conn,$sql);
                     while($row = mysqli_fetch_assoc($res))
                            {

                            	 $call = $row['call_url'];
                            	 echo $call;
                            }
