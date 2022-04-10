<!Doctype html>
<html>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.btn-group button {
  background-color: #87CEEB; /* Green background */
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  padding: 10px 97px; /* Some padding */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

/* Clear floats (clearfix hack) */
.btn-group:after {
  content: "";
  clear: both;
  display: table;
}

.btn-group button:not(:last-child) {
  border-right: none; /* Prevent double borders */
}

/* Add a background color on hover */
.btn-group button:hover {
  background-color: #000000;
}
</style>
<body>



<div  style="padding-left: 50px" class="btn-group">
  <button><a href="dashboard.php"><i style="font-size: 12pt;color: white" class="fa fa-dashboard"> Dashboard</i></a></button>
  <button><a href="book-appointment.php"><i style="font-size: 12pt;color: white" class="fa fa-edit"> Book Appointment</i></a></button>
  <button><a href="appointment-history.php"><i style="font-size: 12pt;color: white" class="fa fa-history"> Appointment History</i></a></button>
    <button><a href="manage-immhistory.php"><i style="font-size: 12pt;color: white" class="fa fa-history"> Immunization History</i></a></button>
    <button><a href="search.php"><i style="font-size: 12pt;color: white" class="fa fa-search"> Seach</i></a></button>
</div>

</body>
</html>
