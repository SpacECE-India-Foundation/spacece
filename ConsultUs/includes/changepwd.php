<?php
session_start();
$_SESSION["u_Id"] = "9";
 include("../indexDB.php");
if (count($_POST) > 0) {
    $result = mysqli_query($conn, "SELECT *from users WHERE u_Id='" . $_SESSION["current_user_id"] . "'");
    $row = mysqli_fetch_array($result);
    if ($_POST["currentPassword"] == $row["u_password"]) {
        mysqli_query($conn, "UPDATE users set u_password='" . $_POST["newPassword"] . "' WHERE u_Id='" . $_SESSION["current_user_id"] . "'");
        $message = "Password Changed";
        header("Location:includes/index.php");
    } else
        $message = "Current Password is not correct";
}
?>