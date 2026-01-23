<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SpaceECE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Icons & Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="../Assets/css/main.css">
</head>

<body>

<nav class="navbar">

  <!-- LEFT LOGO -->
  <div class="logo">
    <a href="../dashboard/Parent_Dashboard.php">
      <img src="../Assets/img/SpacECELogo.jpg" alt="SpaceECE">
      <span>Spaces Web Portal</span>
    </a>
  </div>

  <!-- RIGHT SECTION -->
  <div class="user" id="userArea">

    <!-- HOME ICON -->
    <a href="../dashboard/Parent_Dashboard.php" class="icon-link home-icon">
      <i class="fa-solid fa-house"></i>
    </a>

    <!-- PROFILE MENU -->
    <div class="profile-menu">

      <img
        src="../Assets/img/default-user.png"
        class="profile-img"
        id="profileToggle"
        alt="Profile"
      >

      <div class="profile-dropdown" id="profileDropdown">
        <div class="profile-header">
          <strong>User Name</strong>
          <small>Parent</small>
        </div>

        <a href="../auth/profile.php">
          <i class="fa-regular fa-user"></i>
          <span>My Profile</span>
        </a>  

        <a href="#" onclick="logout()" class="logout">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span>Logout</span>
        </a>
      </div>

    </div>

  </div>

</nav>

<!-- JS -->
<script src="../Assets/js/header.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
