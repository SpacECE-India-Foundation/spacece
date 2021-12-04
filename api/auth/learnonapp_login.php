<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

//site url
 define("SITEURL",'http://3.109.14.4/spac/');  
  $servername = "localhost";
    $username = "ostechnix";
    $password = "Password123#@!";
   $dbname = "api_learnonapp";
   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error)
   {
       die("Connection failed: " . $conn->connect_error);
   }
?>
<?php

    if(isset($_POST['login']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);
        $sql = "SELECT * FROM learnon_users WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            $sql = "SELECT * FROM learnon_users WHERE email = '$email' AND password = '$password'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $op = array(
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                );
            
            echo json_encode(['status'=>'success','data'=>$op,'result'=>'found']);
	die();
        } else {
            echo json_encode(['status'=>'failure','result'=>'password doesnot match']);
	die();
        }
        }
        else
        {
            echo json_encode(['status'=>'failure','result'=>'email not registered']);
	die();
        }
    }
    

    ?>