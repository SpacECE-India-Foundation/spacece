<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

include '../Db_Connection/db_growth_tracker.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $u_id = $_GET['u_id'];
    $date = $_GET['date'];

    $stmt = $conn->prepare("SELECT * FROM growth_result WHERE u_id = ? AND date = ?");
    $stmt->bind_param("ss", $u_id, $date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $response = array("status" => "success", "data" => $data);
    } else {
        $response = array("status" => "error", "message" => "No data found for the given u_id and date");
    }

    $stmt->close();
    $conn->close();

    echo json_encode($response);
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));
}
?>
