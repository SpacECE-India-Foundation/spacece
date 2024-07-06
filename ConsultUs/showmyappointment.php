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
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            color: #343a40;
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
    <div class="container">
        <div class="table-container">
            <a href="./cdetails.php?category=all" class="btn btn-secondary" style="margin-bottom: 15px;">View All Consultants</a>
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
                $sql = "SELECT * FROM `appointment` WHERE `username`='$user'";
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
                                    <a href="./instamojo_payment/index.php?id=<?php echo $id; ?>&user=<?php echo $user; ?>" class="btn btn-sm" style="color:black;background-color:pink"> Confirm Appointment </a>
                                    <a href="<?php echo SITEURL; ?>chatbot/room.php?roomname=bid<?php echo $uid; ?>" class="btn btn-primary" style="width: 100%" >CHAT</a>
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
</body>
</html>
