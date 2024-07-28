<?php
include '../Db_Connection/db_growth_tracker.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $u_id = $_GET['u_id'];
    $end_date = $_GET['date'];
    
    // Calculate the start date (7 days ago, including the end date)
    $start_date = date('Y-m-d', strtotime($end_date . ' -6 days'));
    
    // Fetch growth result data
    $stmt = $conn->prepare("SELECT * FROM growth_result WHERE u_id = ? AND date BETWEEN ? AND ? ");
    $stmt->bind_param("sss", $u_id, $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Convert numeric strings to appropriate types
            $row['water_intake'] = floatval($row['water_intake']);
            $row['outdoor_play'] = floatval($row['outdoor_play']);
            $row['fruits'] = floatval($row['fruits']);
            $row['vegetables'] = floatval($row['vegetables']);
            $row['screen_time'] = floatval($row['screen_time']);
            $row['sleep_time'] = floatval($row['sleep_time']);
            $data[] = $row;
        }
    }

    // Fetch total vaccines count from dose table
    $stmt_total_vaccines = $conn->prepare("SELECT COUNT(dose_id) AS total_vaccines FROM Dose");
    $stmt_total_vaccines->execute();
    $result_total_vaccines = $stmt_total_vaccines->get_result();
    $total_vaccines = 0;
    if ($result_total_vaccines->num_rows > 0) {
        $row = $result_total_vaccines->fetch_assoc();
        $total_vaccines = intval($row['total_vaccines']);
    }

    // Fetch vaccinated count for the given user_id from user_vaccination_record table
    $stmt_vaccinated = $conn->prepare("SELECT COUNT(*) AS vaccinated FROM User_vaccination_record WHERE u_id = ?");
    $stmt_vaccinated->bind_param("s", $u_id);
    $stmt_vaccinated->execute();
    $result_vaccinated = $stmt_vaccinated->get_result();
    $vaccinated = 0;
    if ($result_vaccinated->num_rows > 0) {
        $row = $result_vaccinated->fetch_assoc();
        $vaccinated = intval($row['vaccinated']);
    }

    // Calculate not vaccinated count
    $not_vaccinated = $total_vaccines - $vaccinated;

    // Prepare response
    $response = array(
        "status" => "success",
        "data" => $data,
        "vaccination_status" => array(
            "total_vaccines" => $total_vaccines,
            "vaccinated" => $vaccinated,
            "not_vaccinated" => $not_vaccinated
        )
    );

    // Close statements and connection
    $stmt->close();
    $stmt_total_vaccines->close();
    $stmt_vaccinated->close();
    $conn->close();
    
    echo json_encode($response);
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));
}
?>
