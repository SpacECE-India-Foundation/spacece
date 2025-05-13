<?php
session_start();
include("../../Db_Connection/db_consultus_app.php");

$room = $_POST['room'] ?? '';

$sql = "SELECT * FROM `msg` WHERE `room`='$room' ORDER BY rtime DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chat Messages</title>
    <style>
        body {
            background-color: #e0dcdc;
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            color: #444;
            margin-top: 20px;
        }

        .message {
            display: flex;
            align-items: flex-end;
            margin: 10px 0;
            padding: 0 10px;
        }

        .message.other {
            justify-content: flex-start;
        }

        .message.self {
            justify-content: flex-end;
        }

        .bubble {
            padding: 10px 15px;
            border-radius: 15px;
            background-color: #e5e5ea;
            max-width: 60%;
            font-size: 14px;
            line-height: 1.4;
        }

        .message.self .bubble {
            background-color: #e0dcdc;
            text-align: right;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin: 0 8px;
        }

        .time {
            font-size: 11px;
            color: #666;
        }
    </style>
</head>

<body>



    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $isCurrentUser = ($_SESSION['current_user_name'] ?? '') === $row['u_name'];
            $username = empty($row['u_name']) ? $row['ip'] : $row['u_name'];
            $message = htmlspecialchars($row['msg']);
            $time = $row['rtime'];

            // Avatar logic
            if ($isCurrentUser) {
                $currentUserImage = $_SESSION['current_user_image'] ?? null;
                $avatarSrc = $currentUserImage
                    ? "../img/users/" . $currentUserImage
                    : 'https://www.w3schools.com/howto/img_avatar.png';
            } else {
                $avatarSrc = 'https://www.w3schools.com/howto/img_avatar.png';
            }

            $alignmentClass = $isCurrentUser ? "self" : "other";

            echo "<div class='message $alignmentClass'>";
            if (!$isCurrentUser) echo "<img class='avatar' src='$avatarSrc' alt='User'>";
            echo "
            <div class='bubble'>
                <strong>$username</strong><br>
                $message<br>
                <span class='time'>$time</span>
            </div>
        ";
            if ($isCurrentUser) echo "<img class='avatar' src='$avatarSrc' alt='You'>";
            echo "</div>";
        }
    } else {
        echo "<p style='text-align:center;'>No messages found</p>";
    }
    ?>

</body>

</html>