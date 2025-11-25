<?php
include_once '../common/header_module.php';
include '../Db_Connection/constants.php';
include '../Db_Connection/db_cits1.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data
    $child_name = $_POST['child_name'];
    $parent_contact = $_POST['parent_contact'];
    $parent_email = $_POST['parent_email'];
    $gender = $_POST['gender'];
    $parent_address = $_POST['parent_address'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $bcg = $_POST['bcg'];
    $opv0 = $_POST['opv0'];
    $hepb = $_POST['hepb'];
    $opv1 = $_POST['opv1'];
    $rvv = $_POST['rvv'];

    // Handle image upload
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $file_name = basename($_FILES["img"]["name"]);
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
        // Insert into database
        $sql = "INSERT INTO children (child_name, parent_contact, parent_email, gender, parent_address, dob, age, bcg, opv0, hepb, `OPV-1`, `RVV-1`, img_path)
                VALUES ('$child_name', '$parent_contact', '$parent_email', '$gender', '$parent_address', '$dob', '$age', '$bcg', '$opv0', '$hepb', '$opv1', '$rvv', '$target_file')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Child registered successfully!'); window.location='home.php';</script>";
        } else {
            echo "Database Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Error uploading image.'); window.history.back();</script>";
    }

    mysqli_close($conn);
}
?>
