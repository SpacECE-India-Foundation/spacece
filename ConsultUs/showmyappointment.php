<?php
error_reporting(0);
session_start();
if (isset($_SESSION['current_user_email'])) {
    $email = $_SESSION['current_user_email'];
    $user = $_SESSION['current_user_name'];
} else {
    header('location:../spacece_auth/login.php');
    exit();
}
$main_logo = "../img/logo/SpacECELogo.jpg";
$module_logo = "../img/logo/ConsultUs.jpeg";
$module_name = "ConsultUs";
include '../common/header_module.php';
include '../Db_Connection/db_consultus_app.php';

$email = $_SESSION['current_user_email'];
$user = $_SESSION['current_user_name'];


?>
<html>

<head>
    <title>Appointment - Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <style>
        .table-container {
            margin-top: 20px;
            /* overflow-x: auto; */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        body {
            background: #e0dcdc;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        td {
            background-color: #fff;
        }

        .btn-container {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .btn-container a {
            margin: 0 auto;
        }

        .container {
            /* background: linear-gradient(to bottom right, #ffcc99 0%, #ffffff 100%); */
            padding: 20px;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <div class="container" style=" margin-top: 80px; margin-bottom:50px">
        <?php
        $cat = isset($_GET['category']) ? $_GET['category'] : 'all';
        $categoryLabel = ($cat === 'all' || empty($cat)) ? 'All Categories' : ucwords(str_replace('_', ' ', $cat));
        ?>
        <h2 class="mb-8 text-start">Consultant Details - <?php echo $categoryLabel; ?></h2>

        <a href="./cdetails.php?category=all" class="btn btn-secondary" style="margin-bottom: 15px;background-color:orange;color:white;border:none">View All Consultants</a>
        <div class="table-container">

            <table class="tb-full" id="booking">
                <tr>
                    <th>S.NO.</th>
                    <th>CID</th>
                    <th>CATEGORY</th>
                    <th>USERNAME</th>
                    <th>CONSULTANT NAME</th>
                    <th>MOBILE NUMBER</th>
                    <th>A_DATE</th>
                    <th>A_TIME</th>
                    <th>STATUS</th>
                    <th>EMAIL</th>
                    <th>MOBILE</th>
                    <th>BID</th>
                    <th>ACTION</th>
                </tr>
                <?php
                error_reporting(0);
                //$sql = "SELECT * FROM `appointment` WHERE `username`='$user' ORDER BY `date_appointment` DESC, `time_appointment` DESC";
                $cat = isset($_GET['category']) ? $_GET['category'] : 'all';

                if ($cat !== 'all') {
                    $sql = "SELECT * FROM `appointment` WHERE `username`='$user' AND `category`='$cat' ORDER BY `date_appointment` DESC, `time_appointment` DESC";
                } else {
                    $sql = "SELECT * FROM `appointment` WHERE `username`='$user' ORDER BY `date_appointment` DESC, `time_appointment` DESC";
                }

                $res = mysqli_query($conn, $sql);
                if ($res) {
                    $count = mysqli_num_rows($res);
                    $sno = 1;
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['cid'];
                            $full_name = $row['username'];
                            $category = $row['category'];
                            $cname = $row['cname'];
                            $cmob = $row['com_mob'];
                            $date_appointment = $row['date_appointment'];
                            $time_appointment = $row['time_appointment'];
                            $email = $row['email'];
                            $mobile = $row['mobile'];
                            $uid = $row['bid'];
                            $status = $row['status'];
                ?>
                            <tr>
                                <td><?php echo $sno++; ?></td>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $category; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $cname; ?></td>
                                <td><?php echo $cmob; ?></td>
                                <td><?php echo $date_appointment; ?></td>
                                <td><?php echo $time_appointment; ?></td>
                                <td><?php echo $status; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $mobile; ?></td>
                                <td><?php echo $uid; ?></td>
                                <td class="btn-container">
                                    <a href="<?php echo SITEURL; ?>delete_appointment.php?id=<?php echo $uid; ?>&user=<?php echo $user; ?>&email=<?php echo $email; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this appointment?')">DELETE APPOINTMENT</a>
                                    <!-- <a href="./instamojo_payment/index.php?id=<? //php echo $id; 
                                                                                    ?>&user=<? //php echo $user; 
                                                                                            ?>" class="btn btn-sm" style="color:white;background-color:orange" onclick="return confirm('Are you sure you want to confirm this appointment?')"> Confirm Appointment </a> -->
                                    <!-- Button -->
                                    <button class="btn btn-sm" style="color:white;background-color:orange" onclick="openCaptchaModal()">Confirm Appointment</button>

                                    <!-- Modal -->
                                    <div id="captchaModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:white; border:1px solid #ccc; padding:20px; z-index:9999;">
                                        <p>Please enter the code from the image:</p>
                                        <img src="./captcha.php?rand=<?php echo rand(); ?>" id="captchaImage">
                                        <br><br>
                                        <input type="text" id="captchaInput" placeholder="Enter code" />
                                        <br><br>
                                        <button onclick="submitCaptcha()">Submit</button>
                                        <button onclick="closeCaptchaModal()">Cancel</button>
                                    </div>


                                    <a href="<?php echo SITEURL; ?>chatbot/room.php?roomname=bid<?php echo $uid; ?>" class="btn btn-primary" style="width: 100%;rgb(51, 154, 251);">CHAT</a>
                                </td>
                            </tr>
                <?php
                        }
                    } else {
                        echo "<tr><td colspan='13'>Sorry, no appointments found.</td></tr>";
                    }
                }
                ?>
            </table>

        </div>
    </div>
    <?php include_once '../common/footer_module.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function openCaptchaModal() {
            document.getElementById('captchaModal').style.display = 'block';
            document.getElementById('captchaImage').src = './captcha.php?rand=' + Math.random();
            document.getElementById('captchaInput').value = '';
            document.getElementById('captchaInput').focus();
        }

        function closeCaptchaModal() {
            document.getElementById('captchaModal').style.display = 'none';
        }

        function submitCaptcha() {
            const code = document.getElementById('captchaInput').value;

            fetch('./verify_captcha.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'captchaInput=' + encodeURIComponent(code)
                })
                .then(response => response.text())
                .then(result => {
                    if (result === 'success') {
                        alert('Confirmed appointment successfully!');
                    } else {
                        alert('Incorrect code, please try again.');
                    }
                    closeCaptchaModal();
                });
        }
    </script>


</body>

</html>