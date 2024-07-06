<?php
include('../Db_Connection/db_spacece.php');

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <!--bug id  0000115 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style>
        .fa {
            padding: 2px;
            font-size: 30px;
            width: 30px;
            text-align: center;
            text-decoration: none;
            margin: 5px 2px;
            border-radius: 20%;
        }

        .fa:hover {
            opacity: 0.7;
        }

        .fa-facebook-f {
            background: #3B5998;
            color: white;
        }

        .fa-twitter {
            background: #55ACEE;
            color: white;
        }

        .fa-google {
            background: #dd4b39;
            color: white;
        }

        .fa-linkedin {
            background: #007bb5;
            color: white;
        }

        .fa-youtube {
            background: #bb0000;
            color: white;
        }

        .fa-instagram {
            display: inline-flex;
            text-align: center;
            border-radius: 20%;
            color: #fff;
            width: 30px;
            height: 35px;
            font-size: 30px;
            /*line-height: 20px;
  vertical-align: middle;*/
            background: #d6249f;
            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
            box-shadow: 0px 3px 10px rgba(0, 0, 0, .25);
            flex-direction: column;
        }

        .fa-pinterest {
            background: #cb2027;
            color: white;
        }

        .fa-telegram {
            background: #125688;
            color: white;
        }

        .fa-snapchat-ghost {
            background: #fffc00;
            color: white;
            text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
        }

        .fa-skype {
            background: #00aff0;
            color: white;
        }

        .fa-android {
            background: #a4c639;
            color: white;
        }

        .fa-dribbble {
            background: #ea4c89;
            color: white;
        }

        .fa-vimeo {
            background: #45bbff;
            color: white;
        }

        .fa-tumblr {
            background: #2c4762;
            color: white;
        }

        .fa-vine {
            background: #00b489;
            color: white;
        }

        .fa-foursquare {
            background: #45bbff;
            color: white;
        }

        .fa-stumbleupon {
            background: #eb4924;
            color: white;
        }

        .fa-flickr {
            background: #f40083;
            color: white;
        }

        .fa-yahoo {
            background: #430297;
            color: white;
        }

        .fa-soundcloud {
            background: #ff5500;
            color: white;
        }

        .fa-reddit {
            background: #ff5700;
            color: white;
        }

        .fa-rss {
            background: #ff6600;
            color: white;
        }

        @media only screen and (max-width: 600px) {
            .on-desktop {
                display: none;
            }

            .on-mobile {
                display: block;
            }
        }


        @media (min-width: 1025px) and (max-width: 1280px) {

            .on-desktop {
                display: block;
            }

            .on-mobile {
                display: none;
            }

        }
</style>

</head>

<body>



    <div class="register-page">
        <h2>Register</h2>
        <form class="register-form" method="post" autocomplete="off">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" placeholder="Enter Name" id="name" name="name" />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Enter Email" id="email" name="email" />
                <span id="email-error" style="color: red;"></span>
            </div>
            <div class="form-group">
                <label for="phone">Mobile No.</label>
                <input type="text" class="form-control" minlength="10" maxlength="10" pattern="[6-9]{1}[0-9]{9}" placeholder="Enter Mobile No." id="phone" name="phone" />
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
                <input type="file" class="form-control" placeholder="Upload Image" id="image" name="image" style="height: 50px;" />
            </div>

            <div class="form-group">
                <label for="user_type">User Type</label>
                <select name="type" id="user_type">
                    <option value="customer">Customer</option>
                    <option value="consultant">Consultant</option>
                    <option value="admin">Admin</option>
                    <option value="book_owner">Book Owner</option>
                    <option value="delivery_boy">Delivery Boy</option>
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
                <!-- <div class="form-group">
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
            </div> -->
                <div class="form-group select">
                    <label for="c_available_days">Available Days</label>
                    <select name="c_available_days" class=" btn form-control btn-sm selectpicker " id="c_available_days" multiple data-selected-text-format="count > 2" style="background-color: white;">
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                </div>



                <!-- Note the missing multiple attribute! -->

                <div class="form-group">
                    <label for="c_qualification">Qualification</label>
                    <input type="text" class="form-control" placeholder="Enter Qualification" id="c_qualification" name="c_qualification" />
                </div>
            </div>
            <button type="submit" id="register" name="register">Register</button>
            <p class="message">Already registered? <a href="login.php">Login</a></p>
        </form>
    </div>
    <footer>
        <div class="container">
            <footer class="footer-section set-bg" style="
        background-color: orange;
        border-collapse: collapse;
        border: 2px solid navy;
        opacity: 0.9;
        padding: 30px 30px;
      ">

                <div class="row">
                    <div class="col-lg-3 footer-widget ">
                        <a href="http://www.spacece.in"><img src="<?= isset($module_logo) ? $module_logo : '../img/logo/SpacECELogo.jpg' ?>" class="img img-fluid img-thumbnail img-circle" alt="" style="width: 150px" /></a><a href="./index.php">

                        </a>

                        <div class="social">
                            <a href="https://www.facebook.com/SpacECEIn"><i class="fa fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/spacece.in/"><i class="fa fa-instagram"></i></a>
                            <a href="https://t.me/joinchat/EtMJq_3BKL4zNGE1"><i class="fa fa-telegram" aria-hidden="true"></i></a>
                            <a href="https://www.linkedin.com/company/spacece-co/"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3  footer-widget">
                        <p style="color: black">
                            Still delaying your child's health concerns ?
                        </p>
                        <p style="color: black">Connect with India's top doctors online</p>
                    </div>
                    <div class="col-lg-3 footer-widget" style="text-align: justify;">
                        <div class="contact-widget" style="color: black;">
                            <h5 class="fw-title" style="color: black; font-size: 16px;">CONTACT US</h5>
                            <div style="display: flex; flex-direction: column; justify-content: space-around;">
                                <p style="margin: 2px 0; font-size: 14px;">
                                    <!-- <a href="http://www.spacece.in/" style="display: flex; align-items: center; color: black; text-decoration: none; font-size: 18px;"> -->
                                    <a href="https://maps.app.goo.gl/YDb6ZAsN4vQ1KWZE8" style="display: flex; align-items: center; color: black; text-decoration: none; font-size: 18px;">
                                        <i class="fa fa-map-marker" style="margin-right: 10px; font-size: 18px;"></i>
                                        SPACE-ECE
                                    </a>
                                </p>
                                <p style="margin: 5px 0; font-size: 14px;">
                                    <a href="tel:+919096305648" target="_blank" rel="noopener" style="display: flex; align-items: center; color: black; text-decoration: none; font-size: 18px;">
                                        <i class="fa fa-phone" style="margin-right: 10px; font-size: 18px;color: black;"></i>
                                        +91 90963 05648
                                    </a>
                                </p>
                                <p style="margin: 5px 0; font-size: 14px;">
                                    <a href="mailto:events@spacece.co" target="_blank" rel="noopener" style="display: flex; align-items: center; color: black; text-decoration: none; font-size: 18px;">
                                        <i class="fa fa-envelope" style="margin-right: 10px; font-size: 18px;color: black;"></i>
                                        events@spacece.co
                                    </a>
                                </p>
                                <p style="margin: 5px 0; font-size: 18px; color: black;">
                                    <i class="fa fa-clock-o" style="margin-right: 10px; font-size: 18px;"></i>
                                    Mon - Sat, 8AM - 6PM
                                </p>
                            </div>
                        </div>
                    </div>




                    <div class="col-lg-3  footer-widget">
                        <div class="newslatter-widget">
                            <h5 class="fw-title" style="color: black; text-align: center">
                                NEWSLETTER
                            </h5>
                            <p style="color: black">
                                Subscribe your email to get the latest news and new offer also
                                discount
                            </p>
                            <form class="footer-newslatter-form" id="sub" name="sub" method="POST">
                                <input type="email" name="email" id="email" placeholder="Email address" required />

                                <button type="submit" style="cursor: pointer;margin-bottom:15px;">
                                    <i style="font-size: 15px;" class="fa fa-send"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

        </div>
    </footer>
    <p class="font_10" style="line-height: 1.8em; text-align: center; font-size: 20px">
        <span style="font-size: 20px"><span class="color_15">&copy;2021 by spaceECE INDIA FOUNDATION</span></span>
    </p>
    </footer>
    <?= isset($extra_scripts) ? $extra_scripts : null ?>

</body>
<script>
    $(document).ready(function() {
        $('#sub').on('submit', function(e) {
            e.preventDefault();
            var email = $('#email').val();

            $.ajax({
                method: "POST",
                url: "./common/function.php",
                data: {
                    subscribe: 1,
                    email: email
                },
                success: function(data) {
                    console.log("Server response:", data); // Log the server response for debugging
                    handleSubscriptionResponse(data);
                },
                error: function(xhr, status, error) {
                    swal("Error!", "Something went wrong. Please try again later.", "error");
                }
            });
        });

        function handleSubscriptionResponse(data) {
            switch (data.trim()) { // Use trim() to remove any extra whitespace
                case 'Error':
                    swal("Error!", "You have already subscribed to this site!", "error");
                    break;
                case 'Success':
                    swal("Good job!", "You have subscribed!", "success");
                    break;
                case 'Invalid':
                    swal("Error!", "Please enter a valid email!", "error");
                    break;
                default:
                    swal("Error!", "Unexpected response from the server.", "error");
            }
        }
    });
</script>

</body>

</html>