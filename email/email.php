<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: yellow;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>

<form action="main.php" method="POST" enctype="multipart/form-data">
  <div class="container">
    <h1>SEND EMAIL</h1>
    <hr>

    <label for="email"><b>To:</b></label>
    <input type="text" placeholder="Enter Email Id" name="email" id="email" required>
    
    
    <label for="email2"><b>From:</b></label>
    <input type="text" placeholder="Enter Email Id" name="from" id="from" required>


    <label for="subject"><b>Subject:</b></label>
    <input type="text" placeholder="Enter Subject" name="subject" id="subject" required>
    

    <b>Message:</b><br> <input type="file" name="file"> <br><br><br>

    <button type="submit" name="submit" class="registerbtn">SEND</button>
  </div>

</form>

</body>
</html>

<?php
if(isset($_POST['submit'])){

$to= $_POST['email'];
$subject = $_POST['subject'];
$msg = $_POST['msg'];
$from= $_POST['from'];
$cc = $_POST['cc'];
$header=[
    "MIME-Version: 1.0",
    "Content-type: text/plain; cahrset=utf-8",
    "From : $form",
    "Cc : $cc"
];

$headers= implode("\r\n",$header);

if(mail($to,$subject,$msg,$headers)){

echo" msg send";}

else{
    echo "failed to send";
}
}
?>