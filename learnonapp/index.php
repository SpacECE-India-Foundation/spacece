<?php
include_once './header_local.php';
include_once '../common/header_module.php';
if (empty($_SESSION['current_user_id'])) {
  echo '<script>
    alert("User must be logged in!!");
    window.location.href = "../spacece_auth/login.php";
  </script>';
  exit;
}
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
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fff;
      color: #3d2b1f;
      margin: 0;
      padding: 0;
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
          <li class="nav-item"><a class="nav-link" href="Mycourse.php">My Courses</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section Styled like about.php -->
  <section class="hero-section hero-banner-bg">
    <h5>
      <img src="./img/logo/SpacECELogo.jpg" alt="Logo" style="height: 18px; vertical-align: middle; margin-right: 6px;">
      Learn On App
    </h5>
    <h1>Learn without Limit</h1>
    <p>Gain the confidence and skills to nurture and guide young children. Explore our range of courses designed for parents and beginners, covering everything from understanding infant needs to fostering early childhood development.</p>
    <a href="Mycourse.php"><button class="btn btn-primary-custom">Browse Courses</button></a>
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

    <div class="course-filters">
      <div class="filter-row" style="position: relative;">
        <div class="search-wrapper">
          <input type="text" id="courseSearchInput" class="search-input" placeholder="What do you want to know?" />
          <i class="bi bi-search search-icon"></i>
        </div>
        <select class="level-select" id="levelSelect">
          <option>Beginner</option>
          <option>Intermediate</option>
          <option>Advanced</option>
        </select>
      </div>

      <div class="category-row">
        <button class="category-btn" onclick="showDetails('Infant care')">Infant care</button>
        <button class="category-btn" onclick="showDetails('Child care')">Child care</button>
        <button class="category-btn" onclick="showDetails('Children education')">Children education</button>
        <button class="category-btn" onclick="showDetails('Infant hygiene')">Infant hygiene</button>
      </div>
    </div>


    <div id="course-details" style="display: none;" class="course-detail-box">
      <div class="back-btn" onclick="hideDetails()">
        <i class="bi bi-arrow-left-short"></i> Back
      </div>
      <div class="course-title-row">
        <img src="img1.png" alt="course image" class="course-thumb">
        <div>
          <h5 class="course-title">
            Newborn Care Essentials Learn to confidently care for your baby.
            <i class="bi bi-chevron-down dropdown-icon"></i>
          </h5>
          <p class="course-meta">Course 1 &nbsp;&nbsp;•&nbsp;&nbsp;13 hours</p>
        </div>
      </div>

      <div class="course-learn-box">
        <h6>What You'll Learn:</h6>
        <ul>
          <li>Identify essential infant needs: feeding, sleep, comfort, and communication cues.</li>
          <li>Understand basic principles of safe and responsive infant care, including healthy development.</li>
          <li>Explain the importance of creating a nurturing and stimulating environment for infants.</li>
        </ul>

        <h6>Skills you will gain</h6>
        <div class="skills-tags">
          <span class="skill-tag">Feeding & Soothing</span>
          <span class="skill-tag">Safe Practices</span>
          <span class="skill-tag">Developmental Milestones</span>
          <span class="skill-tag">Interpreting Cues</span>
        </div>
      </div>

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

        <div class="video-pagination">
          <button><i class="bi bi-chevron-left"></i></button>
          <span>Page 1 of 100</span>
          <button><i class="bi bi-chevron-right"></i></button>
        </div>
      </section>
      <div style="text-align: center; margin-top: 30px;">
        <button class="btn-join" style="padding: 15px 30px; font-size: 1.2rem;">Subscribe Now</button>
      </div>


      <div id="course-cards" class="cards-container">
        <!-- Sample 9 cards -->
        <div class="card">
          <img src="img1.png" alt="Infant Care">
          <h6>Infant Care</h6>
          <p>Confidently nurture your baby’s first year.</p>
          <strong>Certificate <i class="bi bi-award"></i></strong>
          <p class="small-text">Get a completion certificate</p>
        </div>
        <!-- Duplicate the above .card block 8 more times for 9 cards total -->
        <div class="card"><img src="img2.png" alt="Infant Care">
          <h6>Infant Care</h6>
          <p>Care techniques and safety practices.</p><strong>Certificate <i class="bi bi-award"></i></strong>
          <p class="small-text">Get a completion certificate</p>
        </div>
        <div class="card"><img src="img3.png" alt="Infant Care">
          <h6>Infant Care</h6>
          <p>Handling sleep routines and hygiene.</p><strong>Certificate <i class="bi bi-award"></i></strong>
          <p class="small-text">Get a completion certificate</p>
        </div>
        <div class="card"><img src="img1.png" alt="Infant Care">
          <h6>Infant Care</h6>
          <p>Feeding techniques & tips.</p><strong>Certificate <i class="bi bi-award"></i></strong>
          <p class="small-text">Get a completion certificate</p>
        </div>
        <div class="card"><img src="img2.png" alt="Infant Care">
          <h6>Infant Care</h6>
          <p>Comfort & emotional bonding.</p><strong>Certificate <i class="bi bi-award"></i></strong>
          <p class="small-text">Get a completion certificate</p>
        </div>
        <div class="card"><img src="img3.png" alt="Infant Care">
          <h6>Infant Care</h6>
          <p>Understand developmental cues.</p><strong>Certificate <i class="bi bi-award"></i></strong>
          <p class="small-text">Get a completion certificate</p>
        </div>
        <div class="card"><img src="img1.png" alt="Infant Care">
          <h6>Infant Care</h6>
          <p>Common challenges & solutions.</p><strong>Certificate <i class="bi bi-award"></i></strong>
          <p class="small-text">Get a completion certificate</p>
        </div>
        <div class="card"><img src="img2.png" alt="Infant Care">
          <h6>Infant Care</h6>
          <p>Routine creation and discipline.</p><strong>Certificate <i class="bi bi-award"></i></strong>
          <p class="small-text">Get a completion certificate</p>
        </div>
        <div class="card"><img src="img3.png" alt="Infant Care">
          <h6>Infant Care</h6>
          <p>Baby massage and bath safety.</p><strong>Certificate <i class="bi bi-award"></i></strong>
          <p class="small-text">Get a completion certificate</p>
        </div>
      </div>

    </div>

    <script>
      function showDetails(category) {
        const details = document.getElementById("course-details");
        const video = document.getElementById("course-video");
        const cards = document.getElementById("course-cards");
        const buttons = document.querySelectorAll(".category-btn");

        buttons.forEach(btn => {
          if (btn.textContent.trim().toLowerCase() === category.toLowerCase()) {
            btn.classList.add("active");
          } else {
            btn.classList.remove("active");
          }
        });

        if (
          category.toLowerCase().includes("child") ||
          category.toLowerCase().includes("infant")
        ) {
          details.style.display = "block";
          video.style.display = "block";
          cards.style.display = "grid";
        } else {
          details.style.display = "none";
          video.style.display = "none";
          cards.style.display = "none";
        }
      }

      function hideDetails() {
        document.getElementById("course-details").style.display = "none";
        document.getElementById("course-video").style.display = "none";
        document.getElementById("course-cards").style.display = "none";

        const buttons = document.querySelectorAll(".category-btn");
        buttons.forEach(btn => btn.classList.remove("active"));

        document.getElementById("searchInput").value = "";
      }

      // ✅ Updated search logic
      document.getElementById("courseSearchInput").addEventListener("input", function() {
        const value = this.value.toLowerCase().trim();

        if (value === "infant" || value === "infant care") {
          showDetails("Infant care");
        } else if (value === "child" || value === "child care") {
          showDetails("Child care");
        } else if (value === "education" || value === "children education") {
          showDetails("Children education");
        } else if (value === "hygiene" || value === "infant hygiene") {
          showDetails("Infant hygiene");
        } else {
          hideDetails();
        }
      });

      document.getElementById("levelSelect").addEventListener("change", function() {
        const value = this.value.toLowerCase();

        // Optional: customize this logic later
        if (value === "beginner") {
          showDetails("Infant care"); // You can link level to any category you want
        } else if (value === "intermediate") {
          showDetails("Child care");
        } else if (value === "advanced") {
          showDetails("Children education");
        } else {
          hideDetails();
        }
      });
    </script>

  </div>
  </div>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
  </script>

  <?php
  include_once '../common/footer_module.php';
  ?>

  <!-- Everything below stays same as index.php -->
  <?php
  // You can add the rest of your course section, cards, JS, etc. here exactly as it was
  // e.g. include 'course_section.php' if modularized
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
include_once '../common/footer_module.php';
?>