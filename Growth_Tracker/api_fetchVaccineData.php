<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../Db_Connection/db_growth_tracker.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$response = array();

try {

    $sql = "SELECT vaccine_id, vaccine_name, protects_against, info FROM Vaccine";
    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Query Failed: " . $conn->error);
    }

    if ($result->num_rows > 0) {

        $vaccineData = array();

        while ($row = $result->fetch_assoc()) {
            $vaccineData[] = array(
                "vaccine_id" => $row["vaccine_id"],
                "vaccine_name" => $row["vaccine_name"],
                "protects_against" => $row["protects_against"],
                "info" => $row["info"]
            );
        }

        $response["status"] = "success";
        $response["data"] = $vaccineData;

    } else {
        $response["status"] = "error";
        $response["message"] = "No data found";
    }

} catch (Exception $e) {
    $response["status"] = "error";
    $response["message"] = $e->getMessage();
}

$conn->close();

echo json_encode($response);
?>
