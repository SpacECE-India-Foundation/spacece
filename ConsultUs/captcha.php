<?php
session_start();

$code = rand(1000, 9999);
$_SESSION['captcha_code'] = $code;

header('Content-type: image/png');
$image = imagecreate(80, 30);
$bg = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
imagestring($image, 5, 20, 8, $code, $text_color);
imagepng($image);
imagedestroy($image);
