<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Action, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

include '../Db_Connection/db_spacece_active.php';

if (!isset($mysqli1) || $mysqli1->connect_error) {
    http_response_code(500);
    echo json_encode(['message' => 'Database connection failed.']);
    die();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [];
        $is_json = false;

        if (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
            $data = json_decode(file_get_contents("php://input"), true);
            $is_json = true;
        } else {
            $data = $_POST;
        }

        $image_to_save = null;
        $image_is_set = false;

        if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = getcwd() . DIRECTORY_SEPARATOR . '../img/users/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $file_name = basename($_FILES['image_url']['name']);
            $file_path = $upload_dir . $file_name;

            if (move_uploaded_file($_FILES['image_url']['tmp_name'], $file_path)) {
                $image_to_save = $file_name;
                $image_is_set = true;
            } else {
                http_response_code(500);
                echo json_encode(["message" => "Failed to move uploaded image"]);
                exit;
            }
        } elseif ($is_json && array_key_exists('image_url', $data)) {
            $image_to_save = $data['image_url'];
            $image_is_set = true;
        }

        if (
            isset($data['activity_no'], $data['activity_name'], $data['activity_level'], $data['activity_dev_domain'], $data['activity_objectives'], $data['activity_key_dev'], $data['activity_material'], $data['activity_assessment'], $data['activity_process'], $data['activity_instructions'], $data['status'], $data['activity_date'], $data['playlist_id'], $data['playlist_descr'], $data['playlist_name'], $data['v_id'])
        ) {
            $stmt_check = $mysqli1->prepare("SELECT activity_no FROM spaceactive_activities WHERE activity_no = ?");
            $stmt_check->bind_param("i", $data['activity_no']);
            $stmt_check->execute();
            $stmt_check->store_result();
            
            if ($stmt_check->num_rows > 0) {
                $sql_update = "UPDATE spaceactive_activities SET 
                    activity_name=?, activity_level=?, activity_dev_domain=?, 
                    activity_objectives=?, activity_key_dev=?, activity_material=?, 
                    activity_assessment=?, activity_process=?, activity_instructions=?, 
                    status=?, activity_date=?, playlist_id=?, 
                    playlist_descr=?, playlist_name=?, v_id=? ";
                
                $types = "sississssssssss"; 
                
                $params = [
                    $data['activity_name'], $data['activity_level'], $data['activity_dev_domain'], 
                    $data['activity_objectives'], $data['activity_key_dev'], $data['activity_material'], 
                    $data['activity_assessment'], $data['activity_process'], $data['activity_instructions'], 
                    $data['status'], $data['activity_date'], $data['playlist_id'], 
                    $data['playlist_descr'], $data['playlist_name'], $data['v_id']
                ];
                
                if ($image_is_set) {
                    $sql_update .= ", image_url=? ";
                    $types .= "s";
                    $params[] = $image_to_save;
                }
                
                $sql_update .= " WHERE activity_no=?";
                $types .= "i";
                $params[] = $data['activity_no'];

                $stmt = $mysqli1->prepare($sql_update);
                $stmt->bind_param($types, ...$params);
                
                $action = "updated";

            } else {
                $stmt = $mysqli1->prepare("INSERT INTO spaceactive_activities (activity_no, activity_name, activity_level, activity_dev_domain, activity_objectives, activity_key_dev, activity_material, activity_assessment, activity_process, activity_instructions, status, activity_date, playlist_id, playlist_descr, playlist_name, v_id, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isississsssssssss", $data['activity_no'], $data['activity_name'], $data['activity_level'], $data['activity_dev_domain'], $data['activity_objectives'], $data['activity_key_dev'], $data['activity_material'], $data['activity_assessment'], $data['activity_process'], $data['activity_instructions'], $data['status'], $data['activity_date'], $data['playlist_id'], $data['playlist_descr'], $data['playlist_name'], $data['v_id'], $image_to_save);
                
                $action = "inserted";
            }

            if ($stmt->execute()) {
                http_response_code(200);
                echo json_encode(["message" => "Activity $action successfully"]);
            } else {
                http_response_code(500);
                echo json_encode(["message" => "Failed to execute statement"]);
            }

            $stmt->close();
            $stmt_check->close();
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Invalid input. Missing required fields."]);
        }
    } else {
        http_response_code(405);
        echo json_encode(["message" => "Invalid request method. Only POST is allowed."]);
    }

} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Database Error: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => 'General Error: ' . $e->getMessage()]);
}

$mysqli1->close();
?>