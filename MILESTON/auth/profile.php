<?php
session_start();

/* ------------------------------------
   CHECK LOGIN
------------------------------------ */
if (!isset($_SESSION['user_token'])) {
    header("Location: ../auth/login.php");
    exit;
}

$token = $_SESSION['user_token'];

/* ------------------------------------
   API CALL USING cURL
------------------------------------ */
$apiUrl = "https://jsonplaceholder.typicode.com/users/1"; // dummy API

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$user = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Profile | SpaceECE</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
body {
  background: #FFF7D6;
  font-family: 'Poppins', sans-serif;
}
.profile-card {
  max-width: 600px;
  margin: 50px auto;
  border-radius: 16px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.profile-header {
  background: linear-gradient(106deg,#F98C01,#935301);
  color: #fff;
  padding: 25px;
  border-radius: 16px 16px 0 0;
  text-align: center;
}
.profile-body {
  padding: 25px;
}
.profile-item {
  display: flex;
  justify-content: space-between;
  padding: 12px 0;
  border-bottom: 1px dashed #ddd;
}
.profile-item:last-child {
  border-bottom: none;
}
</style>
</head>

<body>
<div id="header"></div>

<div class="profile-card bg-white">
  
  <!-- HEADER -->
  <div class="profile-header">
    <i class="fa fa-user-circle fa-3x mb-2"></i>
    <h4><?php echo $user['name']; ?></h4>
    <p class="mb-0">Parent Account</p>
  </div>

  <!-- BODY -->
  <div class="profile-body">

    <div class="profile-item">
      <strong>Email</strong>
      <span><?php echo $user['email']; ?></span>
    </div>

    <div class="profile-item">
      <strong>Phone</strong>
      <span><?php echo $user['phone']; ?></span>
    </div>

    <div class="profile-item">
      <strong>Username</strong>
      <span><?php echo $user['username']; ?></span>
    </div>

    <div class="profile-item">
      <strong>City</strong>
      <span><?php echo $user['address']['city']; ?></span>
    </div>

    <div class="text-center mt-4">
      <a href="update_profile.php" class="btn btn-warning px-4">
        <i class="fa fa-edit"></i> Update Profile
      </a>
      <a href="../dashboard/Parent_Dashboard.php" class="btn btn-outline-secondary px-4 ms-2">
        Back
      </a>
    </div>

  </div>
</div>

<!-- footer include -->
<div id="footer"></div>
<script src="../layout/layout.js"></script>

</body>
</html>
