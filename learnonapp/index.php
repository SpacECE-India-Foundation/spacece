<?php
error_reporting(1);
include_once './header_local.php';
include_once '../common/header_module.php';
//include_once 'includes/header1.php';
include_once '../common/banner.php';
include './placeholder.php';
include '../Db_Connection/db_spacece.php';
if (empty($_SESSION['current_user_id'])) {
  echo '<script>
    alert("User must be logged in!!");
    window.location.href = "../spacece_auth/login.php";
  </script>';
  exit;
}

$searchTerm = $_GET['search'] ?? '';
$level = $_GET['level'] ?? '';
$category = $_GET['category'] ?? '';

$result1 = null;

if (!empty($searchTerm) || !empty($level) || !empty($category)) {
  $sql = "SELECT * FROM learnonapp_courses WHERE 1=1";
  $params = [];
  $types = "";

  if (!empty($searchTerm)) {
    $sql .= " AND (title LIKE ? OR description LIKE ?)";
    $params[] = "%$searchTerm%";
    $params[] = "%$searchTerm%";
    $types .= "ss";
  }

  if (!empty($level)) {
    $sql .= " AND level = ?";
    $params[] = $level;
    $types .= "s";
  }

  if (!empty($category)) {
    $sql .= " AND category = ?";
    $params[] = $category;
    $types .= "s";
  }

  $stmt = $conn->prepare($sql);

  if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
  }

  $stmt->execute();
  $result1 = $stmt->get_result();
}

$relatedCourses = null;

if (!empty($category)) {
  $relatedSql = "SELECT * FROM learnonapp_courses WHERE category = ?";

  // Exclude the main course title 
  if (!empty($searchTerm)) {
    $relatedSql .= " AND title != ?";
    $stmt = $conn->prepare($relatedSql);
    $stmt->bind_param("ss", $category, $searchTerm);
  } else {
    $stmt = $conn->prepare($relatedSql);
    $stmt->bind_param("s", $category);
  }

  $stmt->execute();
  $relatedCourses = $stmt->get_result();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_SESSION['current_user_id'])) {
  $course_id = intval($_POST['id']);
  $user_id = intval($_SESSION['current_user_id']);

  // Check if user is already subscribed to any course
  $currentCourseStmt = $conn->prepare("
    SELECT cid FROM learnonapp_users_courses 
    WHERE uid = ?
  ");
  $currentCourseStmt->bind_param("i", $user_id);
  $currentCourseStmt->execute();
  $currentCourseResult = $currentCourseStmt->get_result();

  if ($currentCourseResult->num_rows > 0) {
    $row = $currentCourseResult->fetch_assoc();
    $current_course_id = $row['cid'];

    // Count total videos in current course
    $videoStmt = $conn->prepare("SELECT COUNT(*) FROM learnonapp_videos WHERE course_id = ?");
    $videoStmt->bind_param("i", $current_course_id);
    $videoStmt->execute();
    $videoStmt->bind_result($total_videos);
    $videoStmt->fetch();
    $videoStmt->close();

    // Count watched videos
    $watchedStmt = $conn->prepare("
      SELECT COUNT(*) FROM learnonapp_user_video_progress 
      WHERE user_id = ? AND course_id = ?
    ");
    $watchedStmt->bind_param("ii", $user_id, $current_course_id);
    $watchedStmt->execute();
    $watchedStmt->bind_result($watched_count);
    $watchedStmt->fetch();
    $watchedStmt->close();

    // Check if course is completed
    if ($total_videos > 0 && $watched_count < $total_videos) {
      echo "<script>alert('Please complete your current course before subscribing to another.');
      window.location.href  = 'Mycourse.php';
      </script>";

      exit;
    } else {
      // User has finished course, remove old subscription
      // $deleteStmt = $conn->prepare("DELETE FROM learnonapp_users_courses WHERE uid = ?");
      // $deleteStmt->bind_param("i", $user_id);
      // $deleteStmt->execute();
      // $deleteStmt->close();
    }
  }

  // Now insert new subscription
  $stmt = $conn->prepare("INSERT INTO learnonapp_users_courses (uid, cid) VALUES (?, ?)");
  $stmt->bind_param("ii", $user_id, $course_id);

  if ($stmt->execute()) {
    echo "<script>alert('You are successfully subscribed!');
     window.location.href = 'Mycourse.php?id=$course_id';
    </script>";
  } else {
    echo "<script>alert('Subscription failed.');</script>";
  }

  $stmt->close();
}


$conn=new mysqli('localhost','root','','spacece');
$result = $conn->query("SELECT * FROM learnonapp_courses");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home | Learn On App</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fff;
      color: #3d2b1f;
      margin: 0;
      padding: 0;
    }

    .course-box {
      border: 1px solid #f0e6d6;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
      background-color: #fffaf5;
      box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
    }

    .course-header {
      display: flex;
      align-items: center;
      cursor: pointer;
      justify-content: space-between;
    }

    .course-thumb {
      width: 100px;
      height: auto;
      margin-right: 20px;
      border-radius: 8px;
      object-fit: cover;
    }

    .course-title {
      font-weight: bold;
      font-size: 1.1rem;
      display: flex;
      align-items: center;
    }

    .dropdown-icon {
      margin-left: 8px;
      transition: transform 0.3s ease;
    }

    .course-meta {
      margin: 4px 0;
      color: #5c5c5c;
    }

    .course-detail-box {
      margin-top: 16px;
    }

    .skills-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 10px;
    }

    .skill-tag {
      border: 1px solid orange;
      color: orange;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 14px;
    }


    .hero-banner-bg {
      background: url('https://th.bing.com/th/id/R.e3c319dc7b3e43d481e4ad0cd8074492?rik=K5Bnv6qeEn3UoQ&riu=http%3a%2f%2fwww.pixelstalk.net%2fwp-content%2fuploads%2f2016%2f07%2fPlain-background-wallpapers-hd-free.jpg&ehk=vey50qFU7FJ4bVXCEzLAUiSzAcyjm8Q9FgJqHxYM%2fDo%3d&risl=&pid=ImgRaw&r=0') no-repeat center center/cover;
      padding: 80px 60px;
      position: relative;
      z-index: 1;
      color: #3d2b1f;
      min-height: 400px;
    }

    .hero-banner-bg::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(255, 255, 255, 0.85);
      /* Optional: white overlay */
      z-index: -1;
    }

    nav.navbar {
      margin-top: 0;
      z-index: 10;
      position: relative;
      padding: 16px 35px;
      background-color: white;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .navbar-brand {
      font-weight: 700;
      color: #F5A100;
    }

    .nav-link {
      color: black !important;
      margin-right: 20px;
      font-weight: 500;
    }

    .nav-link.active {
      background-color: #fff7e6;
      border: 1px solid #f5a623;
      color: #f5a623 !important;
      font-weight: 600;
      border-radius: 12px;
      padding: 6px 18px;
    }

    .hero-section {
      padding: 60px;
      background: #fffaf2;
      text-align: left;
    }

    .hero-section h5 {
      color: #f5a100;
      font-weight: 700;
      font-size: 20px;
      margin-bottom: 10px;
    }

    .hero-section h1 {
      font-size: 60px;
      font-weight: 700;
      color: #f5a100;
      line-height: 1.2;
    }

    .hero-section p {
      font-size: 18px;
      color: #333;
      max-width: 700px;
      margin: 20px 0;
    }

    .btn-primary-custom {
      background-color: #f5a100;
      border: none;
      padding: 12px 30px;
      font-weight: 600;
      font-size: 18px;
      border-radius: 8px;
      color: white;
    }

    .info-bar {
      background-color: #fff7e6;
      padding: 20px;
      margin-top: 20px;
      display: flex;
      justify-content: center;
      gap: 40px;
      font-size: 1.1rem;
      font-weight: 500;
      color: #f5a100;
      flex-wrap: wrap;
    }

    .search-wrapper {
      position: relative;
      display: inline-block;
    }

    .search-input {
      padding: 10px 40px 10px 20px;
      /* Enough padding for icon */
      border-radius: 30px;
      border: 1.5px solid #f5a623;
      width: 350px;
      height: 48px;
      font-size: 16px;
      color: #000;
      background-color: #fff;
    }

    .search-icon {
      position: absolute;
      top: 40%;
      right: 20px;
      transform: translateY(-50%);
      color: #f5a623;
      font-size: 20px;
      pointer-events: none;
    }

    .course-detail-box {
      background-color: #fffefb;
      border-radius: 10px;
      padding: 30px;
      margin-top: 60px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.04);
      text-align: center;
    }

    .course-title-row {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 20px;
      margin-bottom: 10px;
    }

    .course-thumb {
      width: 60px;
      height: 60px;
      border-radius: 8px;
      object-fit: cover;
    }

    .course-title {
      font-size: 18px;
      font-weight: 600;
      color: #3d2b1f;
    }

    .course-meta {
      font-size: 14px;
      color: #555;
      margin-top: 5px;
    }

    .dropdown-icon {
      font-size: 16px;
      vertical-align: middle;
      margin-left: 8px;
      color: #3d2b1f;
    }

    .course-learn-box {
      margin-top: 20px;
      text-align: left;
      max-width: 800px;
      margin-left: auto;
      margin-right: auto;
    }

    .course-learn-box h6 {
      font-size: 16px;
      font-weight: 600;
      color: #3d2b1f;
      margin-top: 20px;
      margin-bottom: 10px;
    }

    .course-learn-box ul {
      padding-left: 20px;
      line-height: 1.6;
    }

    .skills-tags {
      margin-top: 10px;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
    }

    .skill-tag {
      border: 1.5px solid #f5a623;
      padding: 8px 16px;
      border-radius: 20px;
      font-size: 14px;
      color: #f5a623;
      background-color: #fff;
      font-weight: 500;
      transition: all 0.2s;
    }

    .skill-tag:hover {
      background-color: #f5a623;
      color: white;
      cursor: pointer;
    }

    .search-input:focus {
      outline: none;
      border-color: #f5a623;
    }

    .btn-join {
      background-color: #F5A100;
      color: white;
      border: none;
      padding: 18px 40px;
      font-size: 1.3rem;
      border-radius: 8px;
      font-weight: 600;

    }

    .info-bar {
      background-color: #FFF3D4;
      padding: 15px 40px;
      display: flex;
      justify-content: center;
      gap: 40px;
      font-size: 1.3rem;
      font-weight: 500;
      color: #F5A100;
      border-top: 1px solid #f7d287;
    }

    .back-btn {
      font-size: 16px;
      font-weight: 600;
      color: #f5a623;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 5px;
      margin-bottom: 20px;
      justify-content: left;
      transition: color 0.2s;
    }

    .back-btn i {
      font-size: 24px;
    }

    .back-btn:hover {
      color: #d48800;
    }

    .course-section {
      padding: 40px;
      font-family: 'Segoe UI', sans-serif;
    }

    .course-section h2 {
      text-align: center;
      font-weight: 600;
      color: #3d2b1f;
    }

    .course-filters {
      display: block;
      width: 100%;
      padding: 20px 0;
      text-align: center;
      z-index: 999;
      position: relative;
      background-color: #fffaf2;
    }

    .level-select {
      padding: 10px 20px;
      border-radius: 20px;
      border: 1px solid #d8a94d;
      font-size: 16px;
      background-color: white;
      color: #3d2b1f;
      height: 48px;
      font-weight: 500;
    }

    .category-btn {
      padding: 8px 20px;
      border: 1px solid #d8a94d;
      border-radius: 20px;
      background-color: white;
      color: #3d2b1f;
      font-size: 16px;
      cursor: pointer;
    }

    .category-btn.active {
      background-color: #ffe8c1;
      color: #f5a623;
      font-weight: bold;
    }

    .course-content {
      display: flex;
      margin-top: 20px;
      gap: 30px;
    }

    .sidebar {
      max-width: 150px;
      font-size: 14px;
      color: #333;
    }

    .sidebar h5 {
      font-weight: 600;
      margin-bottom: 10px;
    }

    .cards {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      justify-content: start;
    }

    .card {
      border: 2px solid #f5a623;
      border-radius: 10px;
      padding: 15px;
      width: 280px;
      min-height: 320px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      background-color: #fff;
    }

    .card img {
      height: 130px;
      object-fit: contain;
      margin-bottom: 10px;
    }

    .card h6 {
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .card p {
      font-size: 14px;
      margin-bottom: 10px;
    }

    .card .small-text {
      font-size: 12px;
      color: #555;
    }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 0 40px;
    }

    .course-section h2 {
      text-align: center;
      font-weight: 700;
      color: #3d2b1f;
      font-size: 28px;
      margin-bottom: 20px;
    }

    .course-filters {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      margin-bottom: 30px;
      gap: 10px;
    }

    .level-select {
      padding: 8px 20px;
      border-radius: 20px;
      border: 1px solid #d8a94d;
      font-size: 16px;
      background-color: white;
      color: #3d2b1f;
    }

    .category-btn {
      padding: 10px 20px;
      border: 1px solid #d8a94d;
      border-radius: 20px;
      background-color: white;
      color: #3d2b1f;
      font-size: 16px;
      cursor: pointer;
      height: 48px;
      font-weight: 500;
    }

    .category-btn.active {
      background-color: #f5a623;
      color: #fff;
      font-weight: 600;
      border-color: #f5a623;
    }

    .course-content {
      display: flex;
      gap: 40px;
      align-items: flex-start;
    }

    .sidebar {
      flex: 0 0 200px;
      font-size: 15px;
      color: #3d2b1f;
    }

    .sidebar h5 {
      font-weight: 700;
      font-size: 18px;
      margin-bottom: 10px;
      align-items: Left;
    }

    .sidebar p {
      line-height: 1.5;
    }

    .cards {
      display: flex;
      flex: 1;
      gap: 25px;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .filter-row {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 20px;
      position: relative;
      z-index: 999;
      /* 🔥 important: bring it to front */
    }

    .category-row {
      display: flex;
      justify-content: center;
      gap: 15px;
      flex-wrap: wrap;
      margin-bottom: 30px;
    }

    .cards-container {
      display: none;
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
      justify-items: center;
      margin-top: 30px;
      max-width: 1000px;
      margin-left: auto;
      margin-right: auto;
    }

    .card {
      border: 2px solid #f5a623;
      border-radius: 10px;
      padding: 15px;
      width: 280px;
      background-color: #fff;
      text-align: center;
      transition: 0.3s ease;
      word-wrap: break-word;
      white-space: normal;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100%;
    }

    .card:hover {
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card img {
      height: 130px;
      width: 100%;
      object-fit: contain;
      margin-bottom: 10px;
    }


    .card h6 {
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .card p {
      font-size: 14px;
      margin-bottom: 10px;
    }

    .card strong {
      margin-top: 10px;
      font-size: 15px;
      color: #3d2b1f;
    }

    .card .small-text {
      font-size: 12px;
      color: #555;
    }

    .video-section {
      background-color: #fffaf2;
      padding: 60px 0;
      text-align: center;
    }

    .video-section h2 {
      font-weight: 600;
      color: #3d2b1f;
      margin-bottom: 40px;
      font-size: 28px;
    }

    .video-card {
      position: relative;
      display: inline-block;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .video-thumbnail {
      width: 640px;
      height: 360px;
      object-fit: cover;
    }

    .video-icons-left {
      position: absolute;
      top: 15px;
      left: 20px;
      display: flex;
      gap: 12px;
    }

    .video-icons-left i {
      color: #F5A100;
      font-size: 28px;
      cursor: pointer;
      border: none padding: 0;
      background-color: transparent;
      transition: transform 0.2s ease;
    }

    .video-icons-left i:hover {
      transform: scale(1.1);
    }

    .video-icons-right i:hover {
      transform: scale(1.1);
    }

    .video-share-icon {
      color: #F5A100;
      font-size: 24px;
      cursor: pointer;
    }

    .video-share-icon {
      position: absolute;
      top: 15px;
      right: 20px;
    }

    .video-play-button {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      border: none;
      border-radius: 12px;
      padding: 8px 20px;
      cursor: pointer;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease;
    }

    .video-play-button:hover {
      transform: translate(-50%, -50%) scale(1.05);
    }

    .video-play-button i {
      color: #F5A100;
      font-size: 35px;
    }

    .video-dots {
      position: absolute;
      bottom: 15px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 6px;
    }

    .dot {
      width: 10px;
      height: 10px;
      background-color: #ccc;
      border-radius: 50%;
    }

    .dot.active {
      background-color: #F5A100;
    }

    .video-pagination {
      margin-top: 30px;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 15px;
    }

    .video-pagination button {
      background-color: #F5A100;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 8px 12px;
      cursor: pointer;
    }

    .video-pagination span {
      color: #F5A100;
      font-weight: 600;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-white">
    <div class="container-fluid d-flex align-items-center">
      <div class="d-flex align-items-center gap-4">
        <ul class="navbar-nav d-flex flex-row mb-0 gap-4">
          <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
          <li class="nav-item"><a class="nav-link" href="my_courses.php?user=<?=$_SESSION['current_user_id']?>">"My Courses</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section Styled like about.php -->
  <section class="hero-section hero-banner-bg">
    <h5>
      <img src="../img/logo/LearnOnApp.jpeg" alt="Logo" style="height: 18px; vertical-align: middle; margin-right: 6px;">
      Learn On App
    </h5>
    <h1>Learn without Limit</h1>
    <p>Gain the confidence and skills to nurture and guide young children. Explore our range of courses designed for parents and beginners, covering everything from understanding infant needs to fostering early childhood development.</p>
    <a href="my_courses.php"><button class="btn btn-primary-custom">Browse Courses</button></a>
  </section>

  <!-- Info Bar -->
  <div class="info-bar">
    <div>⤴ Difficulty: Beginner-Friendly</div>
    <div>🕒 Schedule: Learn at Your Own Pace</div>
    <div>❓ Helpful For: New Parents & Caregivers</div>
  </div>

  <!--  course-section -->
  <div class="course-section">
    <h2>Choose from different <br><strong>Courses</strong></h2>

    <form method="GET" action="">
      <div class="course-filters">
        <div class="filter-row" style="position: relative;">
          <div class="search-wrapper">
            <input
              type="text"
              name="search"
              id="courseSearchInput"
              class="search-input"
              placeholder="What do you want to know?"
              value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>" />
            <i class="bi bi-search search-icon"></i>
          </div>

          <select class="level-select" name="level" id="levelSelect">
            <option value="">All Levels</option>
            <option value="Beginner" <?php if (($_GET['level'] ?? '') === 'Beginner') echo 'selected'; ?>>Beginner</option>
            <option value="Intermediate" <?php if (($_GET['level'] ?? '') === 'Intermediate') echo 'selected'; ?>>Intermediate</option>
            <option value="Advanced" <?php if (($_GET['level'] ?? '') === 'Advanced') echo 'selected'; ?>>Advanced</option>
          </select>
        </div>

        <div class="category-row">
          <!-- These will be buttons that set a hidden category input and submit -->
          <input type="hidden" name="category" id="categoryInput" value="<?php echo htmlspecialchars($_GET['category'] ?? ''); ?>" />
          <button type="submit" class="category-btn" onclick="document.getElementById('categoryInput').value='Infant care'">Infant care</button>
          <button type="submit" class="category-btn" onclick="document.getElementById('categoryInput').value='Child care'">Child care</button>
          <button type="submit" class="category-btn" onclick="document.getElementById('categoryInput').value='Children education'">Children education</button>
          <button type="submit" class="category-btn" onclick="document.getElementById('categoryInput').value='Infant hygiene'">Infant hygiene</button>
        </div>
      </div>
    </form>
    <?php
    if ($result1) {
      while ($row1 = $result1->fetch_assoc()) {
    ?>
        <div class="course-box">
          <div class="course-header">
            <img src="<?= $row1['logo'] ? htmlspecialchars($row1['logo']) : 'default-image.jpg' ?>" class="course-thumb" alt="course image">
            <div class="course-info">
              <h5 class="course-title">
                <?= htmlspecialchars($row1['title']) ?>
              </h5>
              <p class="course-meta">
                Course <?= htmlspecialchars($row1['id']) ?> &nbsp;&nbsp;•&nbsp;&nbsp;<?= htmlspecialchars($row1['duration']) ?> hours
              </p>
            </div>
            <div style="text-align: center; margin-top: 30px; ">
              <a class="btn-join" onclick="event.preventDefault(); document.getElementById('course-id').value = <?= $row1['id'] ?>; document.querySelector('#subscribe-form').submit()" style="padding: 15px 30px; font-size: 1.2rem;color:white">Subscribe Now</a>
            </div>
          </div>
          <div class="course-detail-box">
            <h6>What You'll Learn:</h6>
            <p class="learn-description"><?= htmlspecialchars($row1['description']) ?></p>

            <ul class="learn-list" style="list-style-type: none;">
              <?php
              $descriptionItems = explode('|', $row1['description']);
              foreach ($descriptionItems as $item) {
                $trimmedItem = trim($item);
                if (!empty($trimmedItem)) {
                  echo '<li>' . htmlspecialchars($trimmedItem) . '</li>';
                }
              }
              ?>
            </ul>

            <h6>Skills you will gain:</h6>
            <div class="skills-tags">
              <?php
              $skills = explode(',', $row1['skill_gained']);
              foreach ($skills as $skill) {
                $trimmedSkill = trim($skill);
                if (!empty($trimmedSkill)) {
                  echo '<span class="skill-tag">' . htmlspecialchars($trimmedSkill) . '</span>';
                }
              }
              ?>
            </div>
          </div>
        </div>
    <?php
      }
    } ?>
    <form action="" id="subscribe-form" class="hidden" method="POST">
      <input type="hidden" name="id" id="course-id" value="<?= $row1['id'] ?>">
    </form>
    <?php
    if ($relatedCourses && $relatedCourses->num_rows > 0) {
      echo '<div id="course-cards" class="cards-container">';
      while ($row = $relatedCourses->fetch_assoc()) {
    ?>
        <div class="card">
          <img src="<?= $row['logo'] ? htmlspecialchars($row['logo']) : 'default-image.jpg' ?>" alt="<?= htmlspecialchars($row['title']) ?>">
          <h6><?= htmlspecialchars($row['title']) ?></h6>
          <p><?= htmlspecialchars($row['description'] ?? 'Course overview unavailable.') ?></p>
          <strong>Certificate <i class="bi bi-award"></i></strong>
          <p class="small-text">Get a completion certificate</p>
        </div>
    <?php
      }
      echo '</div>';
    }
    ?>




    <!-- Video Section -->
    <section class="video-section" id="course-video">
      <h2>Videos related to <br><strong>course</strong></h2>

      <div class="video-card">
        <img src="https://wallpapers.com/images/hd/pure-black-background-y8wp2r83b15xxdi6.jpg" alt="Video Thumbnail" class="video-thumbnail">

        <div class="video-icons-left">
          <i class="bi bi-hand-thumbs-up"></i>
          <i class="bi bi-hand-thumbs-down"></i>
        </div>

        <i class="bi bi-share-fill video-share-icon"></i>

        <button class="video-play-button">
          <i class="bi bi-play-fill"></i>
        </button>

        <div class="video-dots">
          <div class="dot active"></div>
          <div class="dot"></div>
          <div class="dot"></div>
        </div>
      </div>

      <!-- <div class="video-pagination">
        <button><i class="bi bi-chevron-left"></i></button>
        <span>Page 1 of 100</span>
        <button><i class="bi bi-chevron-right"></i></button>
      </div> -->
    </section>
    <!-- <div style="text-align: center; margin-top: 30px;">
      <button class="btn-join" style="padding: 15px 30px; font-size: 1.2rem;">Subscribe Now</button>
    </div> -->




  </div>
  <div style=" border: 1px solid #ddd;border-radius: 8px;padding: 20px;max-width: 820px;background-color: #fff; margin:30px;">
    <h3 class="class">
      other Courses
    </h3>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="course-box">
        <div class="course-header" onclick="toggleDetails(<?= $row['id'] ?>)">
          <img src="<?= $row['logo'] ? htmlspecialchars($row['logo']) : 'default-image.jpg' ?>" class="course-thumb" alt="course image">
          <div>
            <h5 class="course-title">
              <?= htmlspecialchars($row['title']) ?>
              <i id="arrow-<?= $row['id'] ?>" class="bi bi-chevron-down dropdown-icon"></i>
            </h5>
            <p class="course-meta">
              Course <?= htmlspecialchars($row['id']) ?> &nbsp;&nbsp;•&nbsp;&nbsp;<?= htmlspecialchars($row['duration']) ?> hours
            </p>
          </div>
        </div>

        <div id="course-details-<?= $row['id'] ?>" class="course-detail-box" style="display: none;">
          <h6>What You'll Learn:</h6>
          <ul style="list-style-type: none;">
            <?php
            $descriptionItems = explode('|', $row['description']);
            foreach ($descriptionItems as $item) {
              $trimmedItem = trim($item);
              if (!empty($trimmedItem)) {
                echo '<li>' . htmlspecialchars($trimmedItem) . '</li>';
              }
            }
            ?>
          </ul>

          <h6>Skills you will gain:</h6>
          <div class="skills-tags">
            <?php
            $skills = explode(',', $row['skill_gained']);
            foreach ($skills as $skill) {
              $trimmedSkill = trim($skill);
              if (!empty($trimmedSkill)) {
                echo '<span class="skill-tag">' . htmlspecialchars($trimmedSkill) . '</span>';
              }
            }
            ?>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

  <script>
    let selectedCategory = '';

    function showDetails(category) {
      selectedCategory = category;
      fetchCourses();
    }

    document.getElementById('courseSearchInput').addEventListener('input', fetchCourses);
    document.getElementById('levelSelect').addEventListener('change', fetchCourses);

    function fetchCourses() {
      const search = document.getElementById('courseSearchInput').value;
      const level = document.getElementById('levelSelect').value;

      const params = new URLSearchParams({
        search: search,
        level: level,
        category: selectedCategory
      });

      fetch('index.php?' + params.toString())
        .then(response => response.text())
        .then(data => {
          document.getElementById('courseResults').innerHTML = data;
        })
        .catch(error => {
          console.error('Error fetching courses:', error);
        });
    }

    // function hideDetails() {
    //   document.getElementById("course-details").style.display = "none";
    //   document.getElementById("course-video").style.display = "none";
    //   document.getElementById("course-cards").style.display = "none";

    //   const buttons = document.querySelectorAll(".category-btn");
    //   buttons.forEach(btn => btn.classList.remove("active"));

    //   document.getElementById("searchInput").value = "";
    // }

    // // ✅ Updated search logic
    // document.getElementById("courseSearchInput").addEventListener("input", function() {
    //   const value = this.value.toLowerCase().trim();

    //   if (value === "infant" || value === "infant care") {
    //     showDetails("Infant care");
    //   } else if (value === "child" || value === "child care") {
    //     showDetails("Child care");
    //   } else if (value === "education" || value === "children education") {
    //     showDetails("Children education");
    //   } else if (value === "hygiene" || value === "infant hygiene") {
    //     showDetails("Infant hygiene");
    //   } else {
    //     hideDetails();
    //   }
    // });

    // document.getElementById("levelSelect").addEventListener("change", function() {
    //   const value = this.value.toLowerCase();

    //   // Optional: customize this logic later
    //   if (value === "beginner") {
    //     showDetails("Infant care"); // You can link level to any category you want
    //   } else if (value === "intermediate") {
    //     showDetails("Child care");
    //   } else if (value === "advanced") {
    //     showDetails("Children education");
    //   } else {
    //     hideDetails();
    //   }
    // });
  </script>

  </div>
  </div>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
  </script>

 <div>
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- SweetAlert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style>
    .fa {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      padding: 10px;
      font-size: 20px;
      width: 40px;
      height: 40px;
      margin: 5px;
      text-align: center;
      text-decoration: none;
      border-radius: 50%;
      transition: transform 0.2s ease;
    }

    .fa:hover {
      transform: scale(1.1);
      opacity: 0.8;
    }

    .fa-facebook-f {
      background: #3B5998;
      color: white;
    }

    .fa-twitter {
      background: #55ACEE;
      color: white;
    }

    .fa-linkedin {
      background: #007bb5;
      color: white;
    }

    .fa-instagram {
      color: white;
      background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
      box-shadow: 0px 3px 10px rgba(0, 0, 0, .25);
    }

    @media only screen and (max-width: 600px) {
      .on-desktop {
        display: none;
      }

      .on-mobile {
        display: block;
      }
    }

    @media (min-width: 1025px) and (max-width: 1280px) {
      .on-desktop {
        display: block;
      }

      .on-mobile {
        display: none;
      }
    }

    .footer-widget {
      padding-left: 5px !important;
      padding-right: 5px !important;
    }

    .email-container {
      max-width: 600px;
      margin: 0 auto;
    }

    .email-label {
      display: block;
      margin-bottom: 10px;
      font-size: 18px;
      color: #333;
    }

    .email-form {
      display: flex;
      border: 1px solid #ccc;
      border-radius: 16px;
      padding: 6px;
      background: white;
    }

    .email-form input[type="email"] {
      flex: 1;
      min-width: 100px;
      padding: 16px;
      border: none;
      outline: none;
      font-size: 16px;
    }

    .email-form button {
      padding: 12px 20px;
      background-color: #fff;
      font-weight: bold;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 12px;
      cursor: pointer;
      transition: background 0.2s ease;
    }

    .email-form button:hover {
      background-color: rgb(215, 211, 211);
    }
  </style>
  </head>

  <body>


    <footer class="bg-white border-top pb-5">
      <div class="container" style="padding-top: 30px;">

        <div class="row g-5">


          <!-- Logo Section -->
          <div class="col-md-3 mb-3 mt-5">
            <a href="http://www.spacece.in">
              <img src="<?= isset($main_logo) ? $main_logo : '#' ?>" class="img img-fluid img-thumbnail img-circle" alt="Logo" style="width: 240px; height:240px; border:none; margin-left:-80px !important; margin-top:20px !important;" />
            </a>
          </div>

          <!-- Contact Section -->
         <div class="col-md-3 mb-3 mt-5 text-start">
  <div class="contact-widget" style="color: black; margin-left:-40px !important; margin-top:20px !important;">
    <h5 style="font-size: 20px !important;">Contact Us</h5>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 90px !important;">
      <i class="fa-solid fa-phone text-warning me-2"></i> +91 90963 05648
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 50px !important;">
      <i class="fas fa-envelope text-warning me-2"></i> events@spaceece.co
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 120px !important;">
      <i class="fas fa-map-marker-alt text-warning me-2"></i> SPACE-ECE
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 50px !important;">
      <i class="fas fa-clock text-warning me-2"></i> Mon - Sat 8 AM - 6 PM
    </p>
  </div>
</div>

          <!-- Health Message + Social Media -->
           
          <div class="col-md-3 mb-3 mt-5 text-start">
            <h5 class="text-warning" style="font-size:20px;  margin-left:-10px !important; margin-top:12px !important;">Still delaying treatment for your child's health concerns?</h5>
            <p class="mb-3 fs-6" style="text-align: left; font-size:15px !important;">Connect with India’s top doctors online, today!</p>
            <h5 style="font-size:20px">Our Socials</h6>
              <div>
                <a href="https://www.facebook.com/SpacECEIn" target="_blank" class="text-dark me-3"><i class="fa-brands fa-facebook "></i></a>
                <a href="https://twitter.com/" target="_blank" class="text-dark me-3"><i class="fa-brands fa-twitter "></i></a>
                <a href="https://www.linkedin.com/company/spacece-co/" target="_blank" class="text-dark me-3"><i class="fa-brands fa-linkedin "></i></a>
                <a href="https://www.instagram.com/spacece.in/" target="_blank" class="text-dark"><i class="fa-brands fa-instagram "></i></a>
              </div>

          </div>

          <!-- Newsletter Section -->
          <div class="col-md-3 mb-3 mt-5 text-start">
             <div style="margin-left: 20px;">
            <h5 style="font-size:20px !important;">Subscribe To Our Newsletter</h5>
            <p class="mb-3 fs-6" style="text-align: left; font-size:15px !important;">Subscribe to our newsletter to get updates, offers and discounts.</p>

            <div class="email-container">
              <label class="email-label fs-6" style="text-align: left; font-size:15px !important;" for="email">Enter your email -</label>
              <form id="sub" class="email-form">
                <input type="email" id="email" placeholder="Email here" required />
                <button type="submit">Submit</button>
              </form>
            </div>

          </div>
  </div>
        </div>
      </div>

    </footer>

    <?= isset($extra_scripts) ? $extra_scripts : null ?>

    <script>
      $(document).ready(function() {
        $('#sub').on('submit', function(e) {
          e.preventDefault();
          var email = $('#email').val();

          $.ajax({
            method: "POST",
            url: "./common/function.php",
            data: {
              subscribe: 1,
              email: email
            },
            success: function(data) {
              console.log("Server response:", data);
              handleSubscriptionResponse(data);
            },
            error: function(xhr, status, error) {
              swal("Error!", "Something went wrong. Please try again later.", "error");
            }
          });
        });

        function handleSubscriptionResponse(data) {
          switch (data.trim()) {
            case 'Error':
              swal("Error!", "You have already subscribed to this site!", "error");
              break;
            case 'Success':
              swal("Good job!", "You have subscribed!", "success");
              break;
            case 'Invalid':
              swal("Error!", "Please enter a valid email!", "error");
              break;
            default:
              swal("Error!", "Unexpected response from the server.", "error");
          }
        }
      });
    </script>

  </body>

  </html>
</div>

  <!-- Everything below stays same as index.php -->
  <?php
  // You can add the rest of your course section, cards, JS, etc. here exactly as it was
  // e.g. include 'course_section.php' if modularized
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleDetails(id) {
      const detailBox = document.getElementById('course-details-' + id);
      const icon = document.getElementById('arrow-' + id);

      const isVisible = detailBox.style.display === 'block';
      detailBox.style.display = isVisible ? 'none' : 'block';

      // Optional: rotate icon
      // icon.classList.toggle('rotated', !isVisible);
    }
  </script>

</body>

</html>

