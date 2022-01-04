<?php
include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../common/banner.php';
include './db.php';

$payment_success = false;

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
            $sql = "SELECT * FROM `learnonapp_users_courses` WHERE payment_details = '$response->payment_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Payment already exists
                $payment_success = false;
            } else {
                // Payment is new
                $sql = "INSERT INTO `learnonapp_users_courses` (`uid`, `cid`, `payment_status`, `payment_details`) VALUES ($user_id, $course_id, 'paid', '$response->payment_id')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $payment_success = true;
                } else {
                    $payment_success = true;
                }
            }
        } else {
            $payment_success = false;
            $sql = "INSERT INTO `learnonapp_users_courses` (`uid`, `cid`, `payment_status`, `payment_details`) VALUES ($user_id, $course_id, 'failed', null)";
            $result = mysqli_query($conn, $sql);
        }
    } else {
        // Payment is not successful
        $payment_success = false;
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
                        <p>Your payment has been successfully processed. You will receive an email confirmation shortly.</p>
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
                        <p>Your payment has been failed. Please try again.</p>
                        <a href="./index.php" class="btn btn-danger">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>

    <?php
}
include_once '../common/footer_module.php';
    ?>