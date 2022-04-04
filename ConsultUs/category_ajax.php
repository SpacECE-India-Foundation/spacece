<?php
include 'index_DB.php';
// // $servername = "localhost";
// // $username = "root";
// // $password = "";
// // $servername = "3.109.14.4";
// // $username = "ostechnix";
// // $password = "Password123#@!";
// $dbname = "spaceece";
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
if(isset($_POST['cat_name'])){


$cat_name=$_POST['cat_name'];
$cat_slug=$_POST['cat_slug'];
$image = $_FILES['image']['name'];


$check = "SELECT * FROM consultant_category WHERE cat_name = '$cat_name'";

$run = mysqli_query($conn, $check);

if (mysqli_num_rows($run) > 0) {
    echo json_encode("Exists") ;
   // echo json_encode(array('status' => 'error', "message" => "Email already exists!"));
   // die();
} else {
    $destination_path = getcwd() . DIRECTORY_SEPARATOR;

$target_path = $destination_path . '../img/consult_category/' . basename($_FILES["image"]["name"]);

move_uploaded_file($_FILES['image']['tmp_name'], $target_path);
    $sql="INSERT INTO consultant_category (cat_name,cat_slug,cat_img)VALUES('$cat_name','$cat_slug','$image')";
    $count = mysqli_query($conn, $sql);
    if(mysqli_num_rows($count)>0){
      //  return "Added";
        echo json_encode("Added") ;
    }else{
        echo json_encode("Error") ;
    }

}
}