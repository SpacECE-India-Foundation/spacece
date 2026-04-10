<?php
session_start();

// $new_array = array_merge($_POST, $_GET);

// echo json_encode(['success' => false, 'message' => $new_array]);
// die();

//captcha and verify captcha code 
// Handle image generation
if (isset($_GET['mode']) && $_GET['mode'] === 'image') {
    $code = rand(1000, 9999);
    $_SESSION['captcha_code'] = $code;

    header('Content-type: image/png');
    $image = imagecreate(80, 30);
    $bg = imagecolorallocate($image, 255, 255, 255);
    $text_color = imagecolorallocate($image, 0, 0, 0);
    imagestring($image, 5, 20, 8, $code, $text_color);
    imagepng($image);
    imagedestroy($image);
    exit;
}

// Handle form POST (captcha verification)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_POST['captchaInput'] ?? '';
    if ($input == ($_SESSION['captcha_code'] ?? '')) {
        echo "success";
    } else {
        echo "invalid";
    }
    exit;
}
