<?php
// Include the database connection file
include '../Db_Connection/db_growth_tracker.php';

// Set headers to allow cross-origin requests
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

    // SQL query to fetch all data from the Vaccine table
    $sql = "SELECT vaccine_id, vaccine_name, protects_against, info FROM Vaccine";
    $result = $conn->query($sql);

    // Initialize an array to hold the fetched data
    $vaccineData = array();

    // Check if there are results and fetch data into the array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $vaccineData[] = array(
                'vaccine_id' => $row['vaccine_id'],
                'vaccine_name' => $row['vaccine_name'],
                'protects_against' => $row['protects_against'],
                'info' => $row['info']
            );
        }
    } else {
        throw new Exception("No data found");
    }

    // Close the database connection
    $conn->close();

    // Encode the data to JSON format and print it
    echo json_encode($vaccineData);
?>
