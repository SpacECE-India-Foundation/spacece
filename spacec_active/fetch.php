<?php
session_start();

include '../Db_Connection/db_spacece_active.php';
//var_dump($_SESSION);
if (isset($_POST['getDetails'])) {

    if (isset($_POST['id'])) {
        $query = mysqli_query($mysqli1, "SELECT * FROM spaceactive_activities where activity_no='" . $_POST['id'] . "' ") or die('Sql Query Error1');
        if (mysqli_num_rows($query) > 0) {
            $result = mysqli_fetch_assoc($query);
            echo json_encode($result);
        }
    } else {
        //var_dump($_SESSION);
        if (isset($_SESSION['current_user_id'])) {
            $u_id=$_SESSION['current_user_id'];
            $u_email=$_SESSION['current_user_email'];
         
            if($_SESSION['space_active']=='active'){

           
            $query2=mysqli_query($mysqli1,"SELECT cits1.tblchildren.childDoB from cits1.tblchildren where cits1.tblchildren.parentEmail='$u_email'");
            
          
            if (mysqli_num_rows($query2) > 0) {
                while ($result = mysqli_fetch_assoc($query2)) {
                    $d1 = new DateTime($result['childDoB']);
                    $d2 = new DateTime();
                    $months = 0;
                    
                    $d1->add(new \DateInterval('P1M'));
                    while ($d1 <= $d2){
                        $months ++;
                        $d1->add(new \DateInterval('P1M'));
                    }
                   // echo $months;
                    //print_r($months);
                    $days = array();
                    if($months<2){
                        $days[] =1;
                    }elseif( ($months < 6)){
                        $days[] =2;
                    }elseif( $months<18){
                        $days[] =3;   
                    }elseif( $months<48){
                        $days[] =4;  
                    }
                    $day = implode(', ', $days);
                    $query = mysqli_query($mysqli1, "SELECT * FROM space_active.spaceactive_activities WHERE space_active.spaceactive_activities.activity_level IN ('$day') ") or die('Sql Query Error2');
                   // echo "SELECT * FROM space_active.spaceactive_activities WHERE space_active.spaceactive_activities.activity_level IN ('$day')";
                if (mysqli_num_rows($query) > 0) {
                    while ($result = mysqli_fetch_assoc($query)) {
    
                        if($result['flag']=='1'){

                    

                            echo '<tr>
                                <td>' . $result['activity_no'] . '</td>
                                    <td>' . $result['activity_name'] . '</td>
                                <td>' . $result['activity_date'] . '</td>
                                <td>' . ucfirst($result['status']) . '</td>
                                <td><button type="submit" class="btn btn-sm btn-secondary" id="edit" data-text="' . $result['activity_no'] . '" 
                                data-toggle="modal" data-target="#editModal" >
                                View <i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-secondary" id="upload" data-toggle="modal" data-text="' . $result['activity_no'] . '" data-playlist="'. $result['playlist_id'] .'"  data-target="#exampleModal">
                                Upload video
                                </button> <button type="button" class="btn btn-secondary" id="myVideo" data-toggle="modal" data-text="' . $result['activity_no'] . '" data-target="#myVideos">
                                My Videos
                                </button>
                                <button type="button" class="btn btn-secondary" data-toggle="modal" id="all" data-text="' . $result['activity_no'] . '" data-target="#allVideos">
                                View All videos
                                </button></td></td>
                                </tr>';
                                }
                                else{
                                    echo '<tr>
                                    <td>' . $result['activity_no'] . '</td>
                                        <td>' . $result['activity_name'] . '</td>
                                    <td>' . $result['activity_date'] . '</td>
                                    <td>' . ucfirst($result['status']) . '</td>
                                    <td><button type="submit" class="btn btn-sm btn-secondary" id="edit" data-text="' . $result['activity_no'] . '" 
                                    data-toggle="modal" data-target="#editModal" >
                                    View <i class="fas fa-expand"></i></button>
                                    <button type="button" class="btn btn-secondary" disabled="disabled" id="upload" data-toggle="modal" data-text="' . $result['activity_no'] . '" data-playlist="'. $result['playlist_id'] .'"  data-target="#exampleModal">
                                    Upload video
                                    </button> <button type="button" class="btn btn-secondary" disabled="disabled" id="myVideo" data-toggle="modal" data-text="' . $result['activity_no'] . '" data-target="#myVideos">
                                    My Videos
                                    </button>
                                    <button type="button" class="btn btn-secondary" disabled="disabled" data-toggle="modal" id="all" data-text="' . $result['activity_no'] . '" data-target="#allVideos">
                                    View All videos
                                    </button></td></td>
                                    </tr>';
                                }
                    }
                }
                }
            } else{
                $query = mysqli_query($mysqli1, "SELECT * FROM spaceactive_activities ") or die('Sql Query Error2');

            if (mysqli_num_rows($query) > 0) {
                while ($result = mysqli_fetch_assoc($query)) {
                    var_dump($result);
                    if($result['flag']=='1'){

                    

            echo '<tr>
                <td>' . $result['activity_no'] . '</td>
                    <td>' . $result['activity_name'] . '</td>
                <td>' . $result['activity_date'] . '</td>
                <td>' . ucfirst($result['status']) . '</td>
                <td><button type="submit" class="btn btn-sm btn-secondary" id="edit" data-text="' . $result['activity_no'] . '" 
                data-toggle="modal" data-target="#editModal" >
                View <i class="fas fa-expand"></i></button>
                <button type="button" class="btn btn-secondary" id="upload" data-toggle="modal" data-text="' . $result['activity_no'] . '" data-playlist="'. $result['playlist_id'] .'"  data-target="#exampleModal">
                Upload video
                </button> <button type="button" class="btn btn-secondary" id="myVideo" data-toggle="modal" data-text="' . $result['activity_no'] . '" data-target="#myVideos">
                My Videos
                </button>
                <button type="button" class="btn btn-secondary" data-toggle="modal" id="all" data-text="' . $result['activity_no'] . '" data-target="#allVideos">
                View All videos
                </button></td></td>
                </tr>';
                }
                else{
                    echo '<tr>
                    <td>' . $result['activity_no'] . '</td>
                        <td>' . $result['activity_name'] . '</td>
                    <td>' . $result['activity_date'] . '</td>
                    <td>' . ucfirst($result['status']) . '</td>
                    <td><button type="submit" class="btn btn-sm btn-secondary" id="edit" data-text="' . $result['activity_no'] . '" 
                    data-toggle="modal" data-target="#editModal" >
                    View <i class="fas fa-expand"></i></button>
                    <button type="button" class="btn btn-secondary" disabled="disabled" id="upload" data-toggle="modal" data-text="' . $result['activity_no'] . '" data-playlist="'. $result['playlist_id'] .'"  data-target="#exampleModal">
                    Upload video
                    </button> <button type="button" class="btn btn-secondary" disabled="disabled" id="myVideo" data-toggle="modal" data-text="' . $result['activity_no'] . '" data-target="#myVideos">
                    My Videos
                    </button>
                    <button type="button" class="btn btn-secondary" disabled="disabled" data-toggle="modal" id="all" data-text="' . $result['activity_no'] . '" data-target="#allVideos">
                    View All videos
                    </button></td></td>
                    </tr>';
                }
            }}
            }
        }else{
                $query = mysqli_query($mysqli1, "SELECT * FROM spaceactive_activities where status='free' ") or die('Sql Query Error2');
    
                if (mysqli_num_rows($query) > 0) {
                    while ($result = mysqli_fetch_assoc($query)) {
    
                echo '<tr>
                    <td>' . $result['activity_no'] . '</td>
                        <td>' . $result['activity_name'] . '</td>
                    <td>' . $result['activity_date'] . '</td>
                    <td>' . ucfirst($result['status']) . '</td>
                    <td><button type="submit" class="btn btn-sm btn-secondary" id="edit" data-text="' . $result['activity_no'] . '" 
                    data-toggle="modal" data-target="#editModal" >
                    View <i class="fas fa-expand"></i></button>
                    <button type="button" class="btn btn-secondary" id="upload" data-toggle="modal" data-text="' . $result['activity_no'] . '" data-playlist="'. $result['playlist_id'] .'"  data-target="#exampleModal">
                    Upload video
                    </button> <button type="button" class="btn btn-secondary" id="myVideo" data-toggle="modal" data-text="' . $result['activity_no'] . '" data-target="#myVideos">
                    My Videos
                    </button>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" id="all" data-text="' . $result['activity_no'] . '" data-target="#allVideos">
                    View All videos
                    </button></td></td>
                    </tr>';
                    }
                }
            }
        }
        
    else{
                $query = mysqli_query($mysqli1, "SELECT * FROM spaceactive_activities WHERE status='free' ") or die('Sql Query Error3');

                if (mysqli_num_rows($query) > 0) {
                    while ($result = mysqli_fetch_assoc($query)) {
                       
    
                        echo '<tr>
                <td>' . $result['activity_no'] . '</td>
                    <td>' . $result['activity_name'] . '</td>
           <td>' . $result['activity_date'] . '</td>
           <td>' . ucfirst($result['status']) . '</td>
           <td><button type="submit" class="btn btn-sm btn-secondary" id="edit" data-text="' . $result['activity_no'] . '" 
           data-toggle="modal" data-target="#editModal" >
           View <i class="fas fa-expand"></i></button>
     
    <button type="button" class="btn btn-secondary"  id="all" data-toggle="modal" data-text="' . $result['activity_no'] . '" data-target="#allVideos">
    View All videos
    </button></td></td>
            </tr>';
                    }
                }else{
                    echo "No Activity Found";
                }
            }}
        } else {
            $query = mysqli_query($mysqli1, "SELECT * FROM spaceactive_activities WHERE status='free' ") or die('Sql Query Error4');

            if (mysqli_num_rows($query) > 0) {
                while ($result = mysqli_fetch_assoc($query)) {
                   

                    echo '<tr>
            <td>' . $result['activity_no'] . '</td>
                <td>' . $result['activity_name'] . '</td>
       <td>' . $result['activity_date'] . '</td>
       <td>' . ucfirst($result['status']) . '</td>
       <td><button type="submit" class="btn btn-sm btn-secondary" id="edit" data-text="' . $result['activity_no'] . '" 
       data-toggle="modal" data-target="#editModal" >
       View <i class="fas fa-expand"></i></button>
 
<button type="button" class="btn btn-secondary"  id="all" data-toggle="modal" data-text="' . $result['activity_no'] . '" data-target="#allVideos">
View All videos
</button></td></td>
        </tr>';
                }
            }else{
                echo "No Activity Found";
            }
        }

