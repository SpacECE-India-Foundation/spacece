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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
      <div class="container" pt-4>

        <div class="row g-2">


          <!-- Logo Section -->
          <div class="col-md-3 mb-3 mt-5">
            <a href="http://www.spacece.in">
              <img src="<?= isset($main_logo) ? $main_logo : '#' ?>" class="img img-fluid img-thumbnail img-circle" alt="Logo" style="width: 240px; height:240px; border:none; margin-left:200px !important; ">
            </a>
          </div>

          <!-- Contact Section -->
         <div class="col-md-3 mb-3 mt-5 text-start">
  <div class="contact-widget" style="color: black; margin-left:90px !important;  ">
    <h5 style="font-size: 20px !important;">Contact Us</h5>
    
    <p class="mb-3" style="font-size: 15px !important; ">
      <i class="fa-solid fa-phone text-warning me-2"></i> +91 90963 05648
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; ">
      <i class="fas fa-envelope text-warning me-2"></i> events@spaceece.co
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; ">
      <i class="fas fa-map-marker-alt text-warning me-2"></i> SPACE-ECE
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; ">
      <i class="fas fa-clock text-warning me-2"></i> Mon - Sat 8 AM - 6 PM
    </p>
  </div>
</div>

          <!-- Health Message + Social Media -->
           
          <div class="col-md-3 mb-3 mt-5 text-start" style=" margin-left:-100px !important;  ">
            <h5 class="text-warning" style="font-size:20px; ">Still delaying treatment for your child's health concerns?</h5>
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
</body>

</html>

