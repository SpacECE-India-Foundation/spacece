<?php

include '../Db_Connection/db_spaceTube.php'; 
            $sql = 'DELETE FROM `videos` WHERE `v_id` IN(' . implode(',', $_POST['videos']) . ')';

            $res = mysqli_query($conn, $sql);
            if($res)
            {
                ?>
                <script>alert("Video removed succesfully!");</script>
                <?php
            }
            else {
                ?>
                <script>alert("Video not removed!");</script>
                <?php

            }

            header('location: home.php');
                exit();
        
    ?>