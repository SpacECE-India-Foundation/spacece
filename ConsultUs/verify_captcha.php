<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_POST['captchaInput'] ?? '';
    $user = $_POST['user'] ?? '';
    $id = $_POST['id'] ?? '';

    if ($input == $_SESSION['captcha_code']) {
        // You can handle confirmation logic here
        echo "success";
    } else {
        echo "invalid";
    }
}
