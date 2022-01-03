<?php
include('db.php');

include_once './header_local.php';
include_once '../common/header_module.php';

if (!isset($_SESSION['redirect_url']))
    $_SESSION['redirect_url'] = $_SERVER['HTTP_REFERER'];

$redirectUrl = $_SESSION['redirect_url'];

if (!isset($_SESSION['current_user_id'])) {
    header("Location: ./login.php");
    exit();
}

$query = "SELECT * FROM users WHERE u_id = " . $_SESSION['current_user_id'];
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

function get_input_value($row, $input)
{
    return $row[$input];
}
?>

<div class="profile-page">
    <h2>Profile</h2>
    <form class="profile-form" method="post" autocomplete="off">
        <div class="form-group" id="js-pro-pic">
            <img src="<?= '../img/users/' . get_input_value($row, 'u_image'); ?>" alt="<?= get_input_value($row, 'u_name'); ?>">
            <div class="file-input" style="display: none;">
                <input type="file" class="fileToUpload" style="padding: 15px 30px;" name="fileToUpload" accept="image/*" id="fileToUpload" />
                <label for="file">Change Profile Picture
                </label>
            </div>
            <p class="file-name"></p>
        </div>
        <div class="form-group" id="js-name">
            <label for="name">Name</label>
            <input type="text" class="form-control" placeholder="Enter Name" id="name" name="name" value="<?= get_input_value($row, 'u_name'); ?>" />
        </div>
        <div class="form-group" id="js-email">
            <label for="email">Email</label>
            <input type="email" class="form-control" placeholder="Enter Email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" value="<?= get_input_value($row, 'u_email'); ?>" />
        </div>
        <div class="form-group" id="js-phone">
            <label for="phone">Mobile No.</label>
            <input type="text" class="form-control" placeholder="Enter Mobile No." id="phone" minlength="10" maxlength="10" name="phone" pattern="[7-9]{1}[0-9]{9}" value="<?= get_input_value($row, 'u_mob'); ?>" />
        </div>
        <!-- Change Password Functionality -->
        <button type="button" id="change_password" style="display: none;">Change Password</button>

        <div class="form-group" id="js-password" style="display: none;">
            <label for="password">Password</label>
            <input type="password" class="form-control" placeholder="Enter Password" id="password" name="password" />
        </div>
        <div class="form-group" id="js-confirm-password" style="display: none;">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control" placeholder="Confirm Password" id="cpassword" name="cpassword" />
        </div>

        <button type="button" id="edit" name="edit_profile">Edit Profile</button>
        <button type="submit" id="update" name="update_profile" style="display: none;">Update Profile</button>
        <br>

    </form>

</div>

<script>
    const input = document.querySelector("#fileToUpload");

    input.addEventListener("change", (e) => {
        let files = input.files;
        document.querySelector(".file-name").innerHTML = "";

        if (files.length > 0) {
            for (let i = 0; i <= files.length - 1; i++) {
                let fileName = files.item(i).name;
                let fileSize = (files.item(i).size / 1000).toFixed(2);

                const fileNameAndSize = `${fileName} - ${fileSize}KB`;

                document.querySelector(".file-name").innerHTML +=
                    fileNameAndSize + "<br>";
            }
        }

        return;

        // Get the file name and size
        //   const { name: fileName, size } = input;
        // Convert size in bytes to kilo bytes
        //   const fileSize = (size / 1000).toFixed(2);
        // Set the text content
        //   const fileNameAndSize = `${fileName} - ${fileSize}KB`;
        //   document.querySelector('.file-name').textContent = fileNameAndSize;
    });
</script>

<?php include_once '../common/footer_module.php'; ?>