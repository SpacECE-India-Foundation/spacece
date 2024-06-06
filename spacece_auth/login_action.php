<?php
session_start();
include('../Db_Connection/db_spacece.php');

// Function to handle errors and send JSON response
function sendErrorResponse($message) {
    echo json_encode(array('status' => 'error', 'message' => $message));
    die();
}

// Function to handle successful responses
function sendSuccessResponse($data) {
    echo json_encode(array('status' => 'success', 'data' => $data));
    die();
}

// Check if required POST parameters are set
if (!isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['type'])) {
    sendErrorResponse("Required parameters are missing!");
}

$email = trim($_POST['email']);
$password = trim($_POST['password']);
$type = $_POST['type'];

// Prepare the SQL query based on user type
if ($type == "consultant") {
    $query = "SELECT * FROM users u INNER JOIN consultant c ON u.u_id = c.u_id WHERE u.u_email = ? AND u.u_type = ?";
} else if ($type) {
    $query = "SELECT * FROM users WHERE u_email = ? AND u_type = ?";
} else {
    sendErrorResponse("Invalid user type!");
}

// Prepare and execute the query
$stmt = $conn->prepare($query);
if ($stmt === false) {
    sendErrorResponse("Error preparing the SQL statement: " . $conn->error);
}

$stmt->bind_param('ss', $email, $type);

if (!$stmt->execute()) {
    sendErrorResponse("Error executing the SQL statement: " . $stmt->error);
}

$result = $stmt->get_result();
if ($result === false) {
    sendErrorResponse("Error getting the result set: " . $stmt->error);
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verify the password
    if (!password_verify($password, $row['u_password'])) {
        sendErrorResponse("Invalid email or password");
    }

    if (isset($_POST['isAPI']) && $_POST['isAPI'] == true) {
        $data = array(
            'current_user_id' => $row['u_id'],
            'current_user_name' => $row['u_name'],
            'current_user_email' => $row['u_email'],
            'current_user_mob' => $row['u_mob'],
            'current_user_type' => $row['u_type'],
            'current_user_image' => "https://spacefoundation.in/test/SpacECE-PHP/img/users/" . $row['u_image'],
        );

        if ($type == "consultant") {
            $newData = array(
                'consultant_category' => $row['c_category'],
                'consultant_office' => $row['c_office'],
                'consultant_from_time' => $row['c_from_time'],
                'consultant_to_time' => $row['c_to_time'],
                'consultant_language' => $row['c_language'],
                'consultant_fee' => $row['c_fee'],
                'consultant_available_from' => $row['c_available_from'],
                'consultant_available_to' => $row['c_available_to'],
                'consultant_qualification' => $row['c_qualification'],
            );
            $data = array_merge($data, $newData);
        }

        sendSuccessResponse($data);
    }

    // Set session variables
    $_SESSION['current_user_id'] = $row['u_id'];
    $_SESSION['current_user_email'] = $row['u_email'];
    $_SESSION['current_user_name'] = $row['u_name'];
    $_SESSION['current_user_mob'] = $row['u_mob'];
    $_SESSION['current_user_image'] = $row['u_image'];
    $_SESSION['current_user_type'] = $row['u_type'];
    $_SESSION['space_active'] = $row['space_active'];

    // For consultant
    if ($type == "consultant") {
        $_SESSION["consultant_category"] = $row['c_category'];
        $_SESSION["consultant_office"] = $row['c_office'];
        $_SESSION["consultant_from_time"] = $row['c_from_time'];
        $_SESSION["consultant_to_time"] = $row['c_to_time'];
        $_SESSION["consultant_language"] = $row['c_language'];
        $_SESSION["consultant_fee"] = $row['c_fee'];
        $_SESSION["consultant_available_from"] = $row['c_available_from'];
        $_SESSION["consultant_available_to"] = $row['c_available_to'];
        $_SESSION["consultant_qualification"] = $row['c_qualification'];
    }

    if ($type == 'admin') {
        $_SESSION['admin_id'] = $row['u_id'];
        $_SESSION['uid'] = $row['u_id'];
        $_SESSION['admin_name'] = $row['u_name'];
    }

    if ($type == 'book_owner') {
        $_SESSION['current_user_name'] = $row['u_name'];
        $_SESSION['uid'] = $row['u_id'];
    }

    if ($type == 'delivery_boy') {
        $_SESSION['current_user_name'] = $row['u_name'];
        $_SESSION['delivery_boy_id'] = $row['u_id'];
    }

    $redirect_url = "../index.php";
    if (isset($_SESSION['redirect_url'])) {
        $redirect_url = $_SESSION['redirect_url'];
        unset($_SESSION['redirect_url']);
    }

    echo json_encode(array('status' => 'success', 'redirect_url' => $redirect_url));
    die();
} else {
    sendErrorResponse("Invalid email or password");
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>
