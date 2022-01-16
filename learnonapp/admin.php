<?php
include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../common/banner.php';
include './placeholder.php';

if (!isset($_SESSION['current_user_type']) || $_SESSION['current_user_type'] != 'admin') {
    header("Location: ./index.php");
    exit();
}

print_r($_SESSION);
?>
<div id="admin-page">
</div>
<?php
include_once '../common/footer_module.php';
?>