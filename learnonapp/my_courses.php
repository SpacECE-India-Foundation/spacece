<?php
include_once './header_local.php';
include_once '../common/header_module.php';
//include_once 'includes/header1.php'
include_once '../common/banner.php';
include './placeholder.php';

if (!isset($_SESSION['current_user_id'])) {
  echo "<script type='text/javascript'> document.location = '../spacece_auth/login.php'; </script>";
  exit();
}
?>
<!-- <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head> -->
<div class="my_course_container">
  <div id="my_courses">

  </div>
</div>
<?php
include_once '../common/footer_module.php';
?>