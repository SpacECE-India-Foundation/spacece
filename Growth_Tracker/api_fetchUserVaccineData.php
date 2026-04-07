<?php
// Include the database connection file
include '../Db_Connection/db_growth_tracker.php';

// Set headers to allow cross-origin requests
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Initialize variables from GET data
    $u_id = isset($_GET['u_id']) ? $_GET['u_id'] : null;
    $vaccine_id = isset($_GET['vaccine_id']) ? $_GET['vaccine_id'] : null;
    $dose_number = isset($_GET['dose_number']) ? $_GET['dose_number'] : null;

    // Build the SQL query based on the provided parameters
    $sql = "SELECT User_vaccination_record.u_id, User_vaccination_record.vaccine_id, Vaccine.vaccine_name, User_vaccination_record.dose_number, User_vaccination_record.age, User_vaccination_record.status 
            FROM User_vaccination_record 
            JOIN Vaccine ON User_vaccination_record.vaccine_id = Vaccine.vaccine_id";
    
    if ($u_id) {
        $sql .= " WHERE User_vaccination_record.u_id = ?";
        if ($vaccine_id) {
            $sql .= " AND User_vaccination_record.vaccine_id = ?";
            if ($dose_number) {
                $sql .= " AND User_vaccination_record.dose_number = ?";
            }
        }
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);
    if ($u_id && $vaccine_id && $dose_number) {
        $stmt->bind_param("iii", $u_id, $vaccine_id, $dose_number);
    } elseif ($u_id && $vaccine_id) {
        $stmt->bind_param("ii", $u_id, $vaccine_id);
    } elseif ($u_id) {
        $stmt->bind_param("i", $u_id);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch and format the results
    $records = array();
    while ($row = $result->fetch_assoc()) {
        $records[] = array(
            "u_id" => $row['u_id'],
            "vaccine_id" => $row['vaccine_id'],
            "vaccine_name" => $row['vaccine_name'],
            "dose_number" => $row['dose_number'],
            "age" => $row['age'],
            "status" => $row['status']
        );
    }

    // Return the results as JSON
    echo json_encode($records);

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Send error response if the request method is not GET
    echo json_encode(array("error" => "Invalid request method"));
}
?>
