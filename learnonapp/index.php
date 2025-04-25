<?php
// Turn off all error reporting
error_reporting(0);

// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);

// Optionally, you can also use ini_set to control display errors
ini_set('display_errors', 'Off');
ini_set('error_reporting', E_ALL & ~E_NOTICE);
?>

<?php
include_once './header_local.php';
include_once '../common/header_module.php';
//include_once 'includes/header1.php'
include_once '../common/banner.php';
include './placeholder.php';
?>
<!-- <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head> -->
<div class="course_container">
  <div id="courses">

  </div>
</div>
<?php
include_once '../common/footer_module.php';
?>
