<?php
include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../common/banner.php';

if (!isset($_SESSION['current_user_id']) && $_SESSION['current_user_type'] != 'admin') {
    header("Location: ../spacece_auth/login.php");
}
?>
<div id="admin-page">
</div>
<?php
include_once '../common/footer_module.php';
?>