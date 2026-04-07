<?php
session_start();
include '../Db_Connection/db_spacece.php';

$user_id = $_SESSION['current_user_id'];
$user_name = $_SESSION['current_user_name'];
$course_id = $_POST['course_id'];

// $name = "Marceline Anderson";
// $course = "Pre-Intermediate English Course Level 6";
// $date = "August 25, 2022";
// $institute = "Center of Language Institute";

$sql = "SELECT c.title, uc.created_at
        FROM learnonapp_users_courses uc
        JOIN learnonapp_courses c ON c.id = uc.cid
        WHERE uc.uid = ? AND uc.cid = ?
        ORDER BY uc.created_at DESC
        LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $course_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("No course data found for the user.");
}

$course_title = $data['title'];
$created_at = date("F d, Y", strtotime($data['created_at'])); // Format date

// 3. Generate the certificate (reuse updated certificate code)
$template_path = __DIR__ . '/assets/template.png';
$font_path = __DIR__ . '/assets/fonts/Poppins-SemiBold.ttf';
$output_path = __DIR__ . '/certificate/' . $user_name . '_certificate.png';

$image = imagecreatefrompng($template_path);
if (!$image) {
    die("Error: Failed to load background image.");
}

$black = imagecolorallocate($image, 0, 0, 0);
$orange = imagecolorallocate($image, 243, 156, 18);

$name_size = 40;
$desc_size = 18;
$footer_size = 16;

$name_y = 830;
$desc_y = 950;
$footer_y = 770;

$image_width = imagesx($image);

// Center name
$bbox = imagettfbbox($name_size, 0, $font_path, $user_name);
$name_x = ($image_width - ($bbox[2] - $bbox[0])) / 2;
imagettftext($image, $name_size, 0, $name_x, $name_y, $orange, $font_path, $user_name);

// Description
$description = "Has Successfully Completed $course_title On $created_at At SpacECE INDIA FOUNDATION.";

// Word wrap + center
function wrapText($image, $text, $max_width, $font, $size)
{
    $words = explode(' ', $text);
    $lines = [];
    $line = '';

    foreach ($words as $word) {
        $test_line = $line ? "$line $word" : $word;
        $box = imagettfbbox($size, 0, $font, $test_line);
        $line_width = $box[2] - $box[0];

        if ($line_width > $max_width && $line !== '') {
            $lines[] = $line;
            $line = $word;
        } else {
            $line = $test_line;
        }
    }
    $lines[] = $line;
    return $lines;
}

$wrapped_lines = wrapText($image, $description, 800, $font_path, $desc_size);
$y = $desc_y;
foreach ($wrapped_lines as $line) {
    $box = imagettfbbox($desc_size, 0, $font_path, $line);
    $line_x = ($image_width - ($box[2] - $box[0])) / 2;
    imagettftext($image, $desc_size, 0, $line_x, $y, $black, $font_path, $line);
    $y += 30;
}

header('Content-Type: image/png');
header('Content-Disposition: attachment; filename="' . $user_name . '_certificate.png"');

// Output the image directly to browser
imagepng($image);
imagedestroy($image);
exit;
