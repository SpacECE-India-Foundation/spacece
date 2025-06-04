<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json");

include '../Db_Connection/db_spacece.php';

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['action']) && $input['action'] === 'add') {
    // Extract course fields
    $title = $conn->real_escape_string($input['title'] ?? '');
    $description = $conn->real_escape_string($input['description'] ?? '');
    $level = $conn->real_escape_string($input['level'] ?? '');
    $category = $conn->real_escape_string($input['category'] ?? '');
    $logo = $conn->real_escape_string($input['logo'] ?? '');
    $duration = $conn->real_escape_string($input['duration'] ?? '');
    $skill_gained = $conn->real_escape_string($input['skill_gained'] ?? '');
    $price = $conn->real_escape_string($input['price'] ?? '');

    // Video list (should be array of objects: [{title, url, sort_order}])
    $videos = $input['videos'] ?? [];

    // Insert course
    $sql = "INSERT INTO learnonapp_courses (title, description, level, category, logo, duration, skill_gained, price)
            VALUES ('$title', '$description', '$level', '$category', '$logo', '$duration', '$skill_gained', '$price')";

    $result = $conn->query($sql);

    if ($result) {
        $course_id = $conn->insert_id;

        // Insert related videos
        $videoErrors = [];
        foreach ($videos as $video) {
            $v_title = $conn->real_escape_string($video['title'] ?? '');
            $v_url = $conn->real_escape_string($video['url'] ?? '');
            $v_order = intval($video['sort_order'] ?? 0);

            $videoSql = "INSERT INTO learnonapp_videos (course_id, video_title, video_link, sort_order) 
                         VALUES ('$course_id', '$v_title', '$v_url', '$v_order')";

            if (!$conn->query($videoSql)) {
                $videoErrors[] = $conn->error;
            }
        }

        if (empty($videoErrors)) {
            echo json_encode(['status' => 'success', 'result' => 'Course and videos added successfully']);
        } else {
            echo json_encode(['status' => 'partial_success', 'result' => 'Course added but some videos failed', 'errors' => $videoErrors]);
        }
    } else {
        echo json_encode(['status' => 'failure', 'result' => 'Error inserting course', 'error' => $conn->error]);
    }
} else {
    echo json_encode(['status' => 'failure', 'result' => 'Invalid or missing action']);
}
