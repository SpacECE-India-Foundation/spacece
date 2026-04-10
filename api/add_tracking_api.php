<?php
session_start();
 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: POST, OPTIONS");
include '../Db_Connection/db_libforsmall.php';
 
error_reporting(0);
 
if (isset($_POST['user_id']) && isset($_POST['latitude']) && isset($_POST['longitude'])) {
 
    $user_id  = $_POST['user_id'];
    $latitude  = $_POST['latitude'];
    $longitude = $_POST['longitude'];
 
    // Check if a tracking row already exists for this user
    $stmt = $conn->prepare("SELECT id FROM tracking WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $stmt->store_result();
 
    if ($stmt->num_rows > 0) {
        $stmt->close();
 
        // Row exists — update it
        $stmt = $conn->prepare("UPDATE tracking SET latitude = ?, longitude = ? WHERE user_id = ?");
        $stmt->bind_param("sss", $latitude, $longitude, $user_id);
 
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Data Updated']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Update failed']);
        }
 
    } else {
        $stmt->close();
 
        // No row yet — insert one
        $stmt = $conn->prepare("INSERT INTO tracking (user_id, latitude, longitude) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user_id, $latitude, $longitude);
 
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Data Inserted']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Insert failed']);
        }
    }
 
    $stmt->close();
    die();
}
 
echo json_encode(['success' => false, 'message' => 'Please send user_id, latitude and longitude']);
die();
?>