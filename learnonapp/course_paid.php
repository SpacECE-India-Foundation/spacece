<?php
include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../common/banner.php';
include './placeholder.php';
include './db.php';

$sql = "SELECT * FROM `learnonapp_users_courses` 
            WHERE `uid`=" . $_SESSION['current_user_id']
    . " AND `cid`=" . $_POST['course_id'];

$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) <= 0) {
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    exit();
}

?>
<div id="course_paid_details">
</div>
<?php
include_once '../common/footer_module.php';
?>