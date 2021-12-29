<?PHP
session_start();
if(isset($_SESSION['current_user_email'])){
  $email = $_SESSION['current_user_email'];
  $user= $_SESSION['current_user_name'];
} else{
  header('location:../../spacece_auth/login.php');
  exit();
}
$main_logo = "../../img/logo/SpacECELogo.jpg";
$module_logo = "../../img/logo/ConsultUs.jpeg";
$module_name = "ConsultUs";
include_once '../../common/header_module.php';

?>


<?php


$roomname = $_GET['roomname'];
  //session_start();

  define("SITEURL",'http://3.109.14.4//consult/');  
  // $servername = "localhost";
  //   $username = "root";
  //   $password = "";
    $servername = "3.109.14.4";
    $username = "ostechnix";
    $password = "Password123#@!";
     $dbname = "consultant_app";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

 /*$sql= "SELECT * FROM `chat` WHERE `room_name`='$roomname'";
 $res = mysqli_query($conn,$sql);
 if($res)
 {
     if(mysqli_num_rows($res)==0){
        $message = "this room does not exits";
        echo "<script language='javascript'> alert('$message')</script>";
        echo "<script language='javascript'> ";
       echo "window.location='http://localhost/chatapp';";
        echo'</script>';
     }
     else{

     }

 }
 else{
     echo "error:". mysqli_error($conn);
 }*/
 ?>
 <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

<style>


.wrapper {
  border: 2px solid black;
  max-width: 800px;
  background-color: #DAF7A6;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.wrapper::after {
  content: "";
  clear: both;
  display: table;
}

.wrapper img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.wrapper img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.anyclass{
    height:350px;
    overflow-y: scroll ;
}
</style>
</head>
<body>


<div class="container d-flex justify-content-center " >
 <div class="w-50">
<div class="wrapper">
<h2><b><center>Chat Messages- <?php echo $roomname ;?></center></b></h2>
    <div id="anyclass" class="anyclass">

  </div>
</div>
<textarea class="form-control" name="usermsg" id="usermsg" placeholder="add msg"></textarea>
<!-- <input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="add msg"><br> -->
<button class="btn btn-secondary btn-md" name="submit" id="submit">send</button>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<?php
include_once '../../common/footer_module.php';
?>
<script type="text/javascript">
// new msg in 1s check
// bug id=0000017
setInterval(runFunction, 1000);
function runFunction()
{

  $.ajax({
    method:'POST',
    data:{room: '<?php echo $roomname ?>'},
    url:'htcont.php',
    success:function(data,status)
    {
        document.getElementsByClassName('anyclass')[0].innerHTML= data;
     
    }
  })
    // $.post("htcont.php",{room: '<?php //echo $roomname ?>'},
    // function(data,status)
    // {
    //     document.getElementsByClassName('anyclass')[0].innerHTML= data;
     
    // }
    // )
}

// submitting on enter:credit w3 school
var input = document.getElementById("usermsg");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("submit").click();
  }
});
$("#submit").click(function(e){

  var clientmsg =$('#usermsg').val();
 if(clientmsg){

 
 $ .ajax({
    method:'POST',
    data:{text : clientmsg , room: '<?php echo $roomname ?>' , ip:'<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
    url:'postmsg.php',
    success:function(data,status)
    {
      $('#anyclass')[0].append(data);
      //  document.getElementsByClassName('anyclass')[0].innerHTML= data;
      const messages = document.getElementById('anyclass');
	const messagesid = document.getElementById('msg');  
	messages.scrollTop =60;
    //   var l = document.getElementsByClassName("anyclass").length;
    //   alert(l);
     
    // document.getElementsById("anyclass")[l-1].scrollIntoView();
     
    }
  })
}
  //   var clientmsg =$('#usermsg').val();

  // $.post("postmsg.php", {text : clientmsg , room: '<?php echo $roomname ?>' , ip:'<?php echo $_SERVER['REMOTE_ADDR'] ?>' },
  // function(data,status){
  //     document.getElementsByClassName('anyclass')[0].innerHTML = data;
  // });
  $("#usermsg").val("");
  return false;
});
// $("#submit").click(function() {
//   //document.getElementById('elementtoScrollToID').scrollTop = message.offsetHeight + message.offsetTop; 
//     $([document.documentElement, document.body]).animate({
//         scrollTop: $("#elementtoScrollToID").offset().top
//     }, 200);
//     //$("#elementtoScrollToID").scrollTop(textdiv.outerHeight());
// });

</script>
</body>
</html>



