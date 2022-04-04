<?php
include_once('includes/header1.php');

include '../Db_Connection/db_spacece_active.php';
// include('db.php');
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<div class="container ">
		<a href="<?php echo BASE_URL;?>space.php"></a>
<table class="table table-bordered table-active table-striped table-hover">
	<thead><tr><th>Activity number</th>
		<th>Activity name</th>
		<th>Date</th></tr></thead>
		<tbody id="tablebody" >
			
		</tbody>
</table>
</div>
<?php
include_once('includes/footer1.php');
?>
<script type="text/javascript" src="profile.js"></script>
</body>
</html>

