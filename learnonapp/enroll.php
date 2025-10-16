<?php
error_reporting(1);
include_once './header_local.php';
$conn=include('../Db_connection/db_spacece.php');
include_once '../common/header_module.php';
//include_once('includes/header1.php');
if(isset($_GET['cat'])){$cat=$_GET['cat'];}  else{$cat="";}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Infant Care Course</title>
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
  background: url('') no-repeat center center/cover;
  padding: 80px 60px;
  position: relative;
  z-index: 1;
  color: #3d2b1f;
  min-height: 400px;
}

.hero-banner-bg::before {
  content: "";
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(255, 255, 255, 0.85); /* Optional: white overlay */
  z-index: -1;
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
    .main-section {
      padding: 60px;
      width: 100%;
    }
    .top-header {
      display: flex;
      align-items: center;
      font-weight: 700;
      font-size: 20px;
      color: #f5a100;
      margin-bottom: 10px;
    }
    .main-title {
      font-size: 60px;
      font-weight: 700;
      color: #f5a100;
      line-height: 1.2;
    }
    .subtitle {
      font-size: 18px;
      max-width: 800px;
      margin: 20px 0;
      color: #333;
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
    .tag-box {
      display: flex;
      gap: 15px;
      margin-top: 20px;
    }
    .tag {
      background-color: #fff3d4;
      color: #f5a100;
      padding: 8px 18px;
      border-radius: 6px;
      font-weight: 600;
    }
    .info-strip {
      display: flex;
      gap: 30px;
      background-color: #fff7e6;
      padding: 20px;
      margin-top: 40px;
      border-radius: 10px;
      font-weight: 500;
      color: #f5a100;
      flex-wrap: wrap;
    }
    .info-item i {
      margin-right: 8px;
    }
    .about-section {
      margin-top: 60px;
    }
    .about-section h3 {
      font-weight: 700;
      margin-bottom: 20px;
    }
    .learn-list {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      font-size: 16px;
    }
    .learn-list i {
      color: green;
      margin-right: 10px;
    }
    .details {
      margin-top: 40px;
      display: flex;
      gap: 15px;
      align-items: center;
      color: #555;
    }
    .highlight-title {
      font-weight: 700;
      color: #f5a100;
      font-size: 20px;
      margin-top: 60px;
      margin-bottom: 15px;
    }
    .section-paragraph {
      font-size: 16px;
      color: #333;
      margin-bottom: 20px;
    }
    .section-list {
      padding-left: 20px;
      font-size: 16px;
      color: #333;
    }
    .section-list li {
      margin-bottom: 15px;
    }
    .read-less {
      margin-top: 20px;
      display: inline-block;
      background-color: #fff;
      border: 1px solid #f5a100;
      color: #f5a100;
      padding: 8px 12px;
      border-radius: 6px;
      font-weight: 500;
      text-decoration: none;
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
  box-shadow: 0 5px 20px rgba(0,0,0,0.1);
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

.video-icons-left i{
  color: #F5A100;
  font-size: 28px;
  cursor: pointer;
  border:none;
  padding: 0;
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
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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

body {
  font-family: 'Poppins', sans-serif;
  background: #fff;
  margin: 0;
  padding: 0;
}

    .testimonial-section {
      padding: 60px 20px;
      max-width: 1200px;
      margin: auto;
      text-align: center;
    }

    .testimonial-heading {
      color: #f5a100;
      font-size: 24px;
      font-weight: 700;
      margin-bottom: 40px;
    }

    .carousel-wrapper {
      position: relative;
      overflow: hidden;
    }

    .carousel-track-container {
      overflow: hidden;
    }

    .carousel-track {
      display: flex;
      transition: transform 0.5s ease-in-out;
    }

    .testimonial-slide {
      min-width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 40px;
      padding: 20px;
    }

    .testimonial-img {
      width: 350px;
      height: auto;
      border-radius: 10px;
      object-fit: cover;
    }

    .testimonial-text {
      max-width: 500px;
      text-align: left;
    }

    .testimonial-text p {
      font-size: 16px;
      line-height: 1.6;
    }

    .testimonial-text h5 {
      color: #f5a100;
      font-weight: 700;
      margin-top: 20px;
    }

    .testimonial-text span {
      color: #999;
      font-size: 14px;
    }

    .bi-quote {
      font-size: 24px;
      color: #f5a100;
    }

    .quote-end {
      display: block;
      text-align: right;
      margin-top: 10px;
    }

    .carousel-btn {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background-color: #fff;
      border: 2px solid #f5a100;
      color: #f5a100;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      z-index: 10;
    }

    .carousel-btn.prev {
      left: 0;
    }

    .carousel-btn.next {
      right: 0;
    }

    .carousel-dots {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: 20px;
    }

    .carousel-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background-color: #ccc;
      cursor: pointer;
    }

    .carousel-dot.active {
      background-color: #f5a100;
    }

  </style>
</head>

<nav class="navbar navbar-expand-lg bg-white">
  <div class="container-fluid d-flex align-items-center">
    <!-- Left nav links -->
    <div class="d-flex align-items-center gap-4">
      <!-- Nav links -->
      <ul class="navbar-nav d-flex flex-row mb-0 gap-4">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link" href="my_courses.php">My Courses</a></li>
      </ul>


<!-- bug no. 0000464  solved:-  The site should show results or pages related to the typed keyword.-->
	 <!-- Fixed Search Bar -->
<form class="d-flex align-items-center search-form" id="searchForm">
  <div class="search-wrapper position-relative w-100">
    <input 
      class="form-control search-input pe-5" 
      type="search" 
      id="searchInput" 
      placeholder="What do you want to Know?" 
      required
    >
    <!-- Icon placed inside input (clickable as button) -->
    <button type="submit" class="btn border-0 bg-transparent position-absolute top-50 end-0 translate-middle-y pe-2">
      <i class="bi bi-search search-icon"></i>
    </button>
  </div>
</form>


    </div>
  </div>
</nav>

<body>
  <!--
/** part of bug no 466 the enroll page. The selectedd category comes as parameterand the courses under category are shown. User expected click the desired course and go to payment page */  
/** geeta R  */
  -->
<div class="main-section hero-banner-bg">
    <div class="top-header">
      <img src="../img/logo/LearnOnApp.jpeg" alt="Logo" style="height: 18px; vertical-align: middle; margin-right: 6px;">
      Learn On App
    </div>
    <div class="main-title"><?=$cat;?></div>
    <?php $sql="select * from  learnonapp_courses where category='"."Infant care"."'";
    //echo $sql;
    $query=mysqli_query($conn,$sql);
     if ($query->num_rows>0){
      //echo $query->num_rows;
     ?>
     <table class="table table_dark" width="100%"  cellborder="1" cellpadding="1" cellspacing="1">
      <thead><tr><td colspan="5" align = "center"  <?=$row->category?></td></tr></thead>
      <tr><td colspan="5" align = "center" ><h3>Click on title to pay and enroll</h3></td></tr>
      <tr><td>Title</td><td>Skills</td><td>Description</td><td>Price</td><td>duration</td></tr></thead>
      <?php while($row=mysqli_fetch_assoc($query)){?>
        <tr>
          <??>
        <td><a href='payment.php?id=<?=$row['id'];?>'><?=$row['title']; ?></a></td>
        <td><?=$row['skill_gained']; ?></td>        
        <td><?=$row['description']; ?></td>
        <td><?=$row['price']; ?></td>
        <td><?=$row['duration']; ?></td>
        </tr>
     <?php }?>

    
    </table>
    <?php
     }
    ?>
    
      </div>


         </div>


	</section>

 <section>
  </section>


  </div>


<?php
include_once '../common/footer_module.php';
?>
</div>
</body>
</html>