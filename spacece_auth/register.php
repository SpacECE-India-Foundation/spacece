<?php
include('db.php');

include_once './header_local.php';
include_once '../common/header_module.php';

if (!isset($_SESSION['redirect_url']))
    $_SESSION['redirect_url'] = $_SERVER['HTTP_REFERER'];

if (isset($_SESSION['current_user_id'])) {
    header("Location: ../index.php");
}

function get_consultant_categories($conn)
{
    $query = "SELECT * FROM consultant_category";
    $result = mysqli_query($conn, $query);
    $categories = array();
    while ($row = mysqli_fetch_array($result)) {
        $categories[$row['cat_id']] = $row['cat_name'];
    }
    return $categories;
}
?>

<div class="register-page">
    <h2>Register</h2>
    <form class="register-form" method="post" autocomplete="off">
        <div class="form-group">
            <label for="name">Name</label>
            <!-- 0000016 -->
            <input type="text" class="form-control" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" placeholder="Enter Name" id="name" name="name" />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Enter Email" id="email" name="email" />
        </div>
        <div class="form-group">
            <label for="phone">Mobile No.</label>
            <input type="text" class="form-control" minlength="10" maxlength="10" pattern="[7-9]{1}[0-9]{9}" placeholder="Enter Mobile No." id="phone" name="phone" />
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" placeholder="Enter Password" id="password" name="password" />
        </div>
        <div class="form-group">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control" placeholder="Confirm Password" id="cpassword" name="cpassword" />
        </div>
        <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" class="form-control" placeholder="Upload Image" id="image" name="image" />
        </div>
        <div class="form-group">
            <label for="user_type">User Type</label>
            <select name="type" id="user_type">
                <option value="customer">Customer</option>
                <option value="consultant">Consultant</option>
            </select>
        </div>
        <div class="consultant_details">
            <div class="form-group">
                <label for="c_categories">Consultant Category</label>
                <select name="c_categories" id="c_categories">
                    <?php
                    $categories = get_consultant_categories($conn);
                    foreach ($categories as $key => $value) {
                        echo "<option value='$key'>$value</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="c_office">Office Address</label>
                <input type="text" class="form-control" placeholder="Enter Office Address" id="c_office" name="c_office" />
            </div>
            <div class="form-group">
                <label for="c_from_time">From Time</label>
                <input type="time" class="form-control" placeholder="Enter 'From' Time" id="c_from_time" name="c_from_time" />
            </div>
            <div class="form-group">
                <label for="c_to_time">To Time</label>
                <input type="time" class="form-control" placeholder="Enter 'To' Time" id="c_to_time" name="c_to_time" />
            </div>
            <div class="form-group">
                <label for="c_language">Language</label>
                <select name="c_language" id="c_language">
                    <option value="English">English</option>
                    <option value="Hindi">Hindi</option>
                    <option value="Gujarati">Gujarati</option>
                    <option value="Marathi">Marathi</option>
                    <option value="Telugu">Telugu</option>
                    <option value="Tamil">Tamil</option>
                    <option value="Kannada">Kannada</option>
                    <option value="Malayalam">Malayalam</option>
                    <option value="Bengali">Bengali</option>
                    <option value="Punjabi">Punjabi</option>
                    <option value="Oriya">Oriya</option>
                    <option value="Urdu">Urdu</option>
                    <option value="Konkani">Konkani</option>
                    <option value="Sindhi">Sindhi</option>
                    <option value="Assamese">Assamese</option>
                    <option value="Kashmiri">Kashmiri</option>
                    <option value="Nepali">Nepali</option>
                    <option value="Sanskrit">Sanskrit</option>
                    <option value="Konkani">Konkani</option>
                    <option value="Sindhi">Sindhi</option>
                    <option value="Assamese">Assamese</option>
                    <option value="Kashmiri">Kashmiri</option>
                    <option value="Nepali">Nepali</option>
                    <option value="Sanskrit">Sanskrit</option>
                    <option value="Konkani">Konkani</option>
                    <option value="Sindhi">Sindhi</option>
                    <option value="Assamese">Assamese</option>
                    <option value="Kashmiri">Kashmiri</option>
                    <option value="Nepali">Nepali</option>
                    <option value="Sanskrit">Sanskrit</option>
                    <option value="Konkani">Konkani</option>
                </select>
            </div>
            <div class="form-group">
                <label for="c_fee">Fees</label>
                <input type="text" class="form-control" placeholder="Enter Fees" id="c_fee" name="c_fee" />
            </div>
            <div class="form-group">
                <label for="c_available_from">Availability From</label>
                <select name="c_available_from" id="c_available_from">
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
            </div>
            <div class="form-group">
                <label for="c_available_to">Availability To</label>
                <select name="c_available_to" id="c_available_to">
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
            </div>
           
                <div class="form-group">
                <select id="chkveg" name="chkveg" multiple="multiple">
                    <option value="cheese">Cheese</option>
                    <option value="tomatoes">Tomatoes</option>
                    <option value="mozarella">Mozzarella</option>
                    <option value="mushrooms">Mushrooms</option>
                    <option value="pepperoni">Pepperoni</option>
                    <option value="onions">Onions</option>
                </select>
            </div>
         
<!-- Note the missing multiple attribute! -->
<select id="example-multiple-selected" multiple="multiple">
    <option value="1">Option 1</option>
    <option value="2" >Option 2</option>
    <!-- Option 3 will be selected in advance ... -->
    <option value="3" >Option 3</option>
    <option value="4">Option 4</option>
    <option value="5">Option 5</option>
    <option value="6">Option 6</option>
</select>
            <div class="form-group">
                <label for="c_qualification">Qualification</label>
                <input type="text" class="form-control" placeholder="Enter Qualification" id="c_qualification" name="c_qualification" />
            </div>
        </div>
        <button type="submit" id="register" name="register">Register</button>
        <p class="message">Already registered? <a href="login.php">Login</a></p>
    </form>
</div>

<?php include_once '../common/footer_module.php'; ?>

<script type="text/javascript">
    $('#chkveg').multiselect();
</script>
<script type="text/javascript">
    $('#example-multiple-selected').multiselect();
</script>
<!-- Note the missing multiple attribute! -->
