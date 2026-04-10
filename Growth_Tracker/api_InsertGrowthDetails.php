<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include '../Db_Connection/db_growth_tracker.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $u_id = $_POST['u_id'];
    $date = $_POST['date'];
    $water_intake = $_POST['water_intake'];
    $outdoor_play = $_POST['outdoor_play'];
    $fruits = $_POST['fruits'];
    $vegetables = $_POST['vegetables'];
    $screen_time = $_POST['screen_time'];
    $sleep_time = $_POST['sleep_time'];
    $day = $_POST['day'];
    $average = $_POST['average'];

    // Check if an entry with the same u_id and date exists
    $check_query = $conn->prepare("SELECT * FROM growth_result WHERE u_id = ? AND date = ?");
    $check_query->bind_param("ss", $u_id, $date);
    $check_query->execute();
    $check_result = $check_query->get_result();

    if ($check_result->num_rows > 0) {
        // Entry exists, update it
        $stmt = $conn->prepare("UPDATE growth_result SET water_intake = ?, outdoor_play = ?, fruits = ?, vegetables = ?, screen_time = ?, sleep_time = ?, day = ?, average = ? WHERE u_id = ? AND date = ?");
        $stmt->bind_param("ddddddsdss", $water_intake, $outdoor_play, $fruits, $vegetables, $screen_time, $sleep_time, $day, $average, $u_id, $date);

        if ($stmt->execute()) {
            $response = array("status" => "success", "message" => "Data updated successfully");
        } else {
            $response = array("status" => "error", "message" => "Error updating data: " . $stmt->error);
        }
    } else {
        // Entry does not exist, insert new entry
        $stmt = $conn->prepare("INSERT INTO growth_result (u_id, date, water_intake, outdoor_play, fruits, vegetables, screen_time, sleep_time, day, average) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssddddddsd", $u_id, $date, $water_intake, $outdoor_play, $fruits, $vegetables, $screen_time, $sleep_time, $day, $average);

        if ($stmt->execute()) {
            $response = array("status" => "success", "message" => "Data inserted successfully");
        } else {
            $response = array("status" => "error", "message" => "Error inserting data: " . $stmt->error);
        }
    }

    $stmt->close();
    $check_query->close();
    $conn->close();
    
    echo json_encode($response);
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));
}
?>
