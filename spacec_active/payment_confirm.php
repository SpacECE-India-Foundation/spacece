<?php
include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../common/banner.php';
include './placeholder.php';
// include './db.php';
include '../Db_Connection/db_spacece_active.php';
$payment_success = false;
$msg = null;

// instamojo payment confirm
if (isset($_GET['payment_id']) && $_GET['payment_id'] != '' && isset($_GET['payment_request_id']) && $_GET['payment_request_id'] != '') {

    $payment_id = $_GET['payment_id'];
    $payment_request_id = $_GET['payment_request_id'];

    $api_url = 'https://test.instamojo.com/api/1.1/payment-requests/' . $payment_request_id . '/' . $payment_id . '/';

    // Verify payment by payment_id and payment_request_id
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            "X-Api-Key:test_d93c3d591e0abb22ab505118e62",
            "X-Auth-Token:test_76954866b66d6b27022e3086fd6"
        )
    );

    $response = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response);

    if (isset($_SESSION['current_user_id']) && isset($_SESSION['course_id'])) {
        $user_id = $_SESSION['current_user_id'];
        $course_id = $_SESSION['course_id'];

        if ($response->success == true && $_GET['payment_status'] == 'Credit') {
            // Payment is successful
            $sql = "SELECT * FROM `learnonapp_users_courses` WHERE payment_details = '$payment_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Payment already exists
                $payment_success = false;
                $msg = "This payment has already been made.";
            } else {
                // Payment is new
                $sql = "INSERT INTO `learnonapp_users_courses` (`uid`, `cid`, `payment_status`, `payment_details`) VALUES ($user_id, $course_id, 'paid', '$payment_id') ON DUPLICATE KEY UPDATE `payment_status` = 'paid', `payment_details` = '$payment_id'";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $payment_success = true;
                    $msg = "Your payment has been successfully processed. You will receive an email confirmation shortly.";
                } else {
                    $payment_success = false;
                    $msg = "There was an error processing your payment. If the payment is deducted, please contact us.";
                }
            }
        } else {
            $sql = "INSERT INTO `learnonapp_users_courses` (`uid`, `cid`) VALUES ($user_id, $course_id)";
            $result = mysqli_query($conn, $sql);
            $payment_success = false;
            $msg = "There was an error processing your payment. Please try again later.";
        }
    } else {
        // Payment is not successful
        $payment_success = false;
        $msg = "You can't make payment without logging in.";
    }
}

// print_r($_SESSION);

?>

<?php
if ($payment_success) {
?>
    <div id="payment-success">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="payment-success-content">
                        <h1 class="text-success">Payment Successful</h1>
                        <p><?= $msg; ?></p>
                        <a href="./index.php" class="btn btn-success">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } else { ?>

    <div id="payment-error">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="payment-error-content">
                        <h1 class="text-danger">Payment Failed</h1>
                        <p><?= $msg; ?></p>
                        <a href="./index.php" class="btn btn-danger">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>

    <?php
}
include_once '../common/footer_module.php';
    ?>