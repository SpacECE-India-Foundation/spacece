<?php
session_start();
include('db.php');


if (isset($_POST['getDetails'])) {

    if (isset($_POST['id'])) {
        $query = mysqli_query($mysqli1, "SELECT * FROM spaceactive_activities where activity_no='" . $_POST['id'] . "' ") or die('Sql Query Error');
        if (mysqli_num_rows($query) > 0) {
            $result = mysqli_fetch_assoc($query);
            echo json_encode($result);
        }
    } else {
        if (isset($_SESSION['current_user_id'])) {
            $query = mysqli_query($mysqli1, "SELECT * FROM spaceactive_activities ") or die('Sql Query Error');

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
                echo "No video Found";
            }
        } else {
            $query = mysqli_query($mysqli1, "SELECT * FROM spaceactive_activities WHERE status='free' ") or die('Sql Query Error');

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
                echo "No video Found";
            }
        }
    }
}
// //echo '<tr>
// <td>'// . $result['activity_no'] . '</td>
//     <td>' . $result['activity_name'] . '</td>
// <td>' . $result['activity_date'] . '</td>
// <td>' . ucfirst($result['status']) . '</td>
// <td><button type="submit" class="btn btn-sm btn-secondary" id="edit" data-text="' . $result['activity_no'] . '" 
// data-toggle="modal" data-target="#editModal" >
// View <i class="fas fa-expand"></i></button>
// <button type="button" class="btn btn-secondary" id="upload" data-toggle="modal" data-text="' . $result['activity_no'] . '" data-playlist="'. $result['playlist_id'] .'"  data-target="#exampleModal">
// Upload video
// </button> <button type="button" class="btn btn-secondary" id="myVideo" data-toggle="modal" data-text="' . $result['activity_no'] . '" data-target="#myVideos">
// My Videos
// </button>
// <button type="button" class="btn btn-secondary" data-toggle="modal" id="all" data-text="' . $result['activity_no'] . '" data-target="#allVideos">
// View All videos
// </button></td></td>
// </tr>'