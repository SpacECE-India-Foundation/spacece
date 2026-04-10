<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include '../Db_Connection/db_spacece.php';

if (isset($_POST['uid']) && isset($_POST['cid']) && isset($_POST['payment_status']) && isset($_POST['payment_details'])) {
    $uid = $_POST['uid'];
    $cid = $_POST['cid'];
    $payment_status = $_POST['payment_status'];
    $payment_details = $_POST['payment_details'];

    // Check if the record already exists for the given uid and cid
    $check_query = "SELECT * FROM learnonapp_users_courses WHERE uid = ? AND cid = ?";
    if ($stmt = $conn->prepare($check_query)) {
        $stmt->bind_param("ii", $uid, $cid);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Update existing record
            $update_query = "UPDATE learnonapp_users_courses SET payment_status = ?, payment_details = ?, created_at = CURRENT_TIMESTAMP() WHERE uid = ? AND cid = ?";
            if ($update_stmt = $conn->prepare($update_query)) {
                $update_stmt->bind_param("ssii", $payment_status, $payment_details, $uid, $cid);

                if ($update_stmt->execute()) {
                    echo json_encode(array("message" => "Record updated successfully."));
                } else {
                    echo json_encode(array("message" => "Unable to update record."));
                }

                $update_stmt->close();
            }
        } else {
            // Insert new record
            $insert_query = "INSERT INTO learnonapp_users_courses (uid, cid, payment_status, payment_details, created_at) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP())";
            if ($insert_stmt = $conn->prepare($insert_query)) {
                $insert_stmt->bind_param("iiss", $uid, $cid, $payment_status, $payment_details);

                if ($insert_stmt->execute()) {
                    echo json_encode(array("message" => "Record inserted successfully."));
                } else {
                    echo json_encode(array("message" => "Unable to insert record."));
                }

                $insert_stmt->close();
            }
        }

        $stmt->close();
    }
} else {
    echo json_encode(array("message" => "Incomplete data."));
}

$conn->close();

?>
