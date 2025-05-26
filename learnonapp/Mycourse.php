<?php
include_once './header_local.php';
include_once '../common/header_module.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Infant Care Course</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #ffffff;
      color: #3d2b1f;
      margin: 0;
      padding: 0;
      width: 100%;
    }
	nav.navbar {
  margin-top: 0px; 
  z-index: 10;
  position: relative;
}
  .navbar {
    padding: 16px 35px;
    background-color: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
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
      .top-header {
      display: flex;
      align-items: center;
      font-weight: 700;
      font-size: 20px;
      color: #f5a100;
      margin-bottom: 10px;
    }
    .search-wrapper {
      position: relative;
    }
    .search-input {
      padding-right: 30px;
      border-radius: 20px;
      border: 1px solid #ddd;
      width: 375px;
      height: 55px;
    }
    .search-icon {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      color: #f5a623;
    }
    .container {
      width: 100vw;
      max-width: 100vw;
      padding: 60px 50px;
      background-color: #ffffff;
      overflow-x: hidden;
      font-size: 30px;
    }
    .header, .main-heading, .description, .tags, .journey, .congrats, .certificate, .related-courses {
      margin-top: 20px;
    }

    .main-heading {
      font-size: 72px;
      font-weight: 700;
      color: #f5a100;
      line-height: 1.3;
    }
    .description {
      max-width: 650px;
      font-size: 20px;
      color: #3d2b1f;
    }
    .tags {
      display: flex;
      gap: 10px;
    }
    .tag {
      background-color: #fff3d4;
      color: #f5a100;
      padding: 8px 22px;
      border-radius: 5px;
      font-size: 17px;
      font-weight: 600;
    }
    .journey {
      background-color: #fff3d4;
      padding: 15px 30px;
      text-align: center;
      color: #f5a100;
      font-weight: 600;
      border-radius: 10px;
      max-width: 300px;
      margin: 0 auto;
      font-size: 27px;
    }
.steps-wrapper {
  width: 100%;
  padding: 50px 60px 0;
  box-sizing: border-box;
  position: relative;
}

.steps {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: relative;
}

.step {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  flex: 1;
}

.step-icon {
  width: 56px;
  height: 56px;
  background-color: #f5a100;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  color: #fff;
  z-index: 1;
}

.step-label {
  margin-top: 12px;
  font-size: 18px;
  font-weight: 500;
  color: #000;
  text-align: center;
}

/* connector line from this step to the next */
.connector-line {
  position: absolute;
  top: 28px; 
  left: 50%;
  height: 4px;
  width: 100%;
  background-color: #f5a100;
  z-index: 0;
}

.step:last-child .connector-line {
  display: none;
}

    .congrats {
      text-align: center;
      font-size: 28px;
      font-weight: 600;
      color: #f5a100;
    }
    .certificate {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 30px;
      padding: 20px 0;
      background-color: transparent;
      color: #000;
    }
    .certificate img {
      height: 100%;
      max-height: 600px;
      width: auto;
      border-radius: 4px;
      object-fit: contain;
    }
    .details {
      max-width: 50%;
      font-size: 16px;
      color: #000;
      line-height: 1.6;
    }
    .details h4 {
      font-size: 18px;
      margin-bottom: 8px;
      font-weight: 600;
    }
    .details .tag {
      display: inline-block;
      margin-bottom: 10px;
    }
    .related-courses {
  padding-top: 40px;
}
.related-courses h2 {
  font-weight: 700;
  font-size: 24px;
  color: #3d2b1f;
  margin-bottom: 30px;
}
.related-wrapper {
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
  max-width: 820px;
  background-color: #fff;
}
.course-card {
  display: flex;
  flex-direction: column;
  padding: 20px;
  border: 1px solid #eee;
  border-radius: 10px;
  margin-bottom: 20px;
  background-color: #fff;
}
.course-card:last-child {
  border-bottom: none;
}

.course-card > .d-flex {
  align-items: center;
  gap: 15px;
}
.course-card img {
  width: 64px;
  height: 64px;
  object-fit: cover;
  border-radius: 4px;
}
.course-info {
  flex: 1;
}
.course-title {
  font-size: 16px;
  font-weight: 700;
  color: #3d2b1f;
}
.course-meta {
  font-size: 14px;
  color: #555;
  margin-top: 4px;
}
.dropdown-icon {
  font-size: 20px;
  color: #3d2b1f;
  cursor: pointer;
  transition: transform 0.3s ease;
}
.dropdown-icon.open {
  transform: rotate(180deg);
  color: #f5a623;
}
.course-details {
  margin-top: 20px;
  padding-left: 80px;
  font-size: 14px;
  color: #3d2b1f;
}
.learn-title,
.skills-title {
  font-weight: 700;
  margin-bottom: 8px;
  color: #3d2b1f;
}
.learn-list {
  list-style-type: disc;
  padding-left: 20px;
  margin-bottom: 15px;
}
.learn-list li {
  margin-bottom: 5px;
}
.skills-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}
.skills-tags .tag {
  background-color: #fff7e6;
  color: #f5a623;
  font-size: 14px;
  padding: 8px 18px;
  border: 1px solid #f5a623;
  border-radius: 10px;
  font-weight: 500;
}
  </style>
</head>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-white">
    <div class="container-fluid d-flex align-items-center">
      <div class="d-flex align-items-center gap-4">
        <ul class="navbar-nav d-flex flex-row mb-0 gap-4">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
          <li class="nav-item"><a class="nav-link active" href="Mycourse.php">My Courses</a></li>
        </ul>
        <form class="d-flex align-items-center search-form">
          <div class="search-wrapper">
            <input class="form-control search-input" type="search" placeholder="What do you want to Know?">
            <i class="bi bi-search search-icon"></i>
          </div>
        </form>
      </div>
    </div>
  </nav>

  <body>

  <div class="container">
    <div class="top-header">
      <img src="./img/logo/SpacECELogo.jpg" alt="icon" width="28" class="me-2"> Learn On App
    </div>
    <div class="main-heading">Infant Care</div>
    <p class="description">Learn vital skills for your baby's first year, covering feeding, sleep, health, safety, and early development. Gain confidence in providing the best care.</p>
    <div class="tags">
      <div class="tag">Top Instructors</div>
      <div class="tag">New Skills</div>
    </div>
    &nbsp;
    <div class="journey">Your Journey 🛶</div>
    &nbsp;
    &nbsp;
<div class="steps-wrapper">
  <div class="steps">
    <div class="step">
      <div class="step-icon"><i class="bi bi-check-lg text-white"></i></div>
      <div class="step-label">Start Of course</div>
      <div class="connector-line"></div>
    </div>
    <div class="step">
      <div class="step-icon"><i class="bi bi-check-lg text-white"></i></div>
      <div class="step-label">The Audio Test</div>
      <div class="connector-line"></div>
    </div>
    <div class="step">
      <div class="step-icon"><i class="bi bi-check-lg text-white"></i></div>
      <div class="step-label">The Written Test</div>
      <div class="connector-line"></div>
    </div>
    <div class="step">
      <div class="step-icon"><i class="bi bi-check-lg text-white"></i></div>
      <div class="step-label">Complete</div>
    </div>
  </div>
</div>

    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    <div class="congrats">Congratulations 🎉</div>
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
<!-- CERTIFICATE SECTION (UPDATED) -->
<div class="certificate">
  <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/US_Navy_Certificate_of_Discharge.jpg" alt="certificate" />
  <div class="details">
    <div class="tag">Top Instructor</div>
    <h4>Instructor</h4>
    <p>Spacece certified course</p>
    <h4>Offered by</h4>
    <div class="tag">Spacece</div>
    <p>A huge congratulations from the entire Spacece team on finishing your Infant Care course! You've gained invaluable knowledge and practical skills to provide the best possible start for your baby. We're thrilled to have been a part of your learning journey.</p>
    <p>Your dedication to understanding infant needs is truly inspiring. As your child grows, so will their needs and development. Continue fostering your learning adventure and gain insights into the exciting toddler and pre-school years to come. Unlock even more tools and techniques to support your child every step of the way!</p>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

 <!-- Related Courses Section -->
<div class="related-courses">
  <h2>Browse Other related Courses</h2>
  <div class="related-wrapper">
<div class="course-card flex-column">
  <div class="d-flex w-100">
    <img src="https://images.pexels.com/photos/3933273/pexels-photo-3933273.jpeg" alt="course">
    <div class="course-info">
      <div class="course-title">Newborn Care Essentials Learn to confidently care for your baby.</div>
      <div class="course-meta"><span>Course 1</span><span>13 hours</span></div>
    </div>
    <div class="dropdown-icon" onclick="toggleDropdown(this)">⌄</div>
  </div>

  <!-- Dropdown Content -->
  <div class="course-details" style="display: none;">
    <div class="learn-title mt-3">What You'll Learn:</div>
    <ul class="learn-list">
      <li>Identify essential infant needs: feeding, sleep, comfort, and communication cues.</li>
      <li>Understand basic principles of safe and responsive infant care, including healthy development.</li>
      <li>Explain the importance of creating a nurturing and stimulating environment for infants.</li>
    </ul>
    <div class="skills-title mt-3">Skills your will gain</div>
    <div class="skills-tags mt-2">
      <div class="tag">Feeding & Soothing</div>
      <div class="tag">Safe Practices</div>
      <div class="tag">Developmental Milestones</div>
      <div class="tag">Interpreting Cues</div>
    </div>
  </div>
</div>

<div class="course-card flex-column">
  <div class="d-flex w-100">
    <img src="https://images.pexels.com/photos/3933273/pexels-photo-3933273.jpeg" alt="course">
    <div class="course-info">
      <div class="course-title">Newborn Care Essentials Learn to confidently care for your baby.</div>
      <div class="course-meta"><span>Course 1</span><span>13 hours</span></div>
    </div>
    <div class="dropdown-icon" onclick="toggleDropdown(this)">⌄</div>
  </div>

  <!-- Dropdown Content -->
  <div class="course-details" style="display: none;">
    <div class="learn-title mt-3">What You'll Learn:</div>
    <ul class="learn-list">
      <li>Identify essential infant needs: feeding, sleep, comfort, and communication cues.</li>
      <li>Understand basic principles of safe and responsive infant care, including healthy development.</li>
      <li>Explain the importance of creating a nurturing and stimulating environment for infants.</li>
    </ul>
    <div class="skills-title mt-3">Skills your will gain</div>
    <div class="skills-tags mt-2">
      <div class="tag">Feeding & Soothing</div>
      <div class="tag">Safe Practices</div>
      <div class="tag">Developmental Milestones</div>
      <div class="tag">Interpreting Cues</div>
    </div>
  </div>
</div>
<div class="course-card flex-column">
  <div class="d-flex w-100">
    <img src="https://images.pexels.com/photos/3933273/pexels-photo-3933273.jpeg" alt="course">
    <div class="course-info">
      <div class="course-title">Newborn Care Essentials Learn to confidently care for your baby.</div>
      <div class="course-meta"><span>Course 1</span><span>13 hours</span></div>
    </div>
    <div class="dropdown-icon" onclick="toggleDropdown(this)">⌄</div>
  </div>

  <!-- Dropdown Content -->
  <div class="course-details" style="display: none;">
    <div class="learn-title mt-3">What You'll Learn:</div>
    <ul class="learn-list">
      <li>Identify essential infant needs: feeding, sleep, comfort, and communication cues.</li>
      <li>Understand basic principles of safe and responsive infant care, including healthy development.</li>
      <li>Explain the importance of creating a nurturing and stimulating environment for infants.</li>
    </ul>
    <div class="skills-title mt-3">Skills your will gain</div>
    <div class="skills-tags mt-2">
      <div class="tag">Feeding & Soothing</div>
      <div class="tag">Safe Practices</div>
      <div class="tag">Developmental Milestones</div>
      <div class="tag">Interpreting Cues</div>
    </div>
  </div>
</div>

<div class="course-card flex-column">
  <div class="d-flex w-100">
    <img src="https://images.pexels.com/photos/3933273/pexels-photo-3933273.jpeg" alt="course">
    <div class="course-info">
      <div class="course-title">Newborn Care Essentials Learn to confidently care for your baby.</div>
      <div class="course-meta"><span>Course 1</span><span>13 hours</span></div>
    </div>
    <div class="dropdown-icon" onclick="toggleDropdown(this)">⌄</div>
  </div>

  <!-- Dropdown Content -->
  <div class="course-details" style="display: none;">
    <div class="learn-title mt-3">What You'll Learn:</div>
    <ul class="learn-list">
      <li>Identify essential infant needs: feeding, sleep, comfort, and communication cues.</li>
      <li>Understand basic principles of safe and responsive infant care, including healthy development.</li>
      <li>Explain the importance of creating a nurturing and stimulating environment for infants.</li>
    </ul>
    <div class="skills-title mt-3">Skills your will gain</div>
    <div class="skills-tags mt-2">
      <div class="tag">Feeding & Soothing</div>
      <div class="tag">Safe Practices</div>
      <div class="tag">Developmental Milestones</div>
      <div class="tag">Interpreting Cues</div>
    </div>
  </div>
</div>
  </div>
</div>
<script>
  function toggleDropdown(icon) {
    const courseCard = icon.closest('.course-card');
    const details = courseCard.querySelector('.course-details');

    // Toggle visibility
    const isVisible = details.style.display === 'block';
    details.style.display = isVisible ? 'none' : 'block';

    // Toggle rotation
    icon.classList.toggle('open', !isVisible);
  }
</script>

</body>
&nbsp;
&nbsp;

</html>
<?php
include_once '../common/footer_module.php';
?>