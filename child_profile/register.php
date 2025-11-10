<?php
session_start();
if (!empty($_SESSION)) {
    include 'header_local.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register A Child</title>
    <style>
        * {
           box-sizing: border-box;
        }
        body {
            font-family: system-ui, sans-serif;
            margin: 0;
            background-color: #2e2e2e;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #f0f0f0;
            padding: 60px;
            border-radius: 20px;
        }
        h1 {
            font-size: 2.8rem;
            margin-bottom: 20px;
        }
        .back-btn {
            background-color: #f5a500;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="date"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        .form-group .gender-options,
        .form-group .vaccine-options {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .form-group:last-child {
            margin-bottom: 0;
        }
        /* File Input Styling */
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            background-color: #fff;
            cursor: pointer;
            font-size: 14px;
        }

        /* Style the button part of the file input */
        .form-group input[type="file"]::-webkit-file-upload-button {
        background-color: #f5a500;
        color: white;
        border: none;
        padding: 8px 14px;
        border-radius: 6px;
        cursor: pointer;
        margin-right: 10px;
        font-weight: bold;
        transition: 0.3s ease;
        }

        /* Hover effect */
        .form-group input[type="file"]::-webkit-file-upload-button:hover {
            background-color: #d88900;
        }

        .vaccine-section label {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
            display: block;
        }
        .vaccine-group {
            display: flex;
            justify-content: space-between;
            background-color: #e7e7e7;
            padding: 10px 20px;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .vaccine-group label {
            font-size: 14px;
            font-weight: normal;
        }
        .submit-btn {
            background-color: #f5a500;
            color: white;
            border: none;
            padding: 16px 28px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            float: right;
            margin-top: -5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register A Child</h1>
        <a href="home.php">
        <button class="back-btn">← Back</button></a>
        <form name="childForm" method="post" enctype="multipart/form-data" action="child_register_action.php" onsubmit="return validateForm(event)">            
            <div class="form-group">
                <label>Child Name</label>
                <input type="text" name="child_name" placeholder="Your entry here">
            </div>
            <div class="form-group">
                <label>Parent Contact Number</label>
                <input type="text" name="parent_contact" placeholder="Your entry here">
            </div>
            <div class="form-group">
                <label>Parent Email</label>
                <input type="email" name="parent_email" placeholder="Your entry here">
            </div>
            <div class="form-group">
                <label>Child's Gender</label>
                <div class="gender-options">
                    <label><input type="radio" name="gender" value="Female"> Female</label>
                    <label><input type="radio" name="gender" value="Male"> Male</label>
                </div>
            </div>
            <div class="form-group">
                <label>Parent Address / Residence</label>
                <input type="text" name="parent_address" placeholder="Your entry here">
            </div>
            <div class="form-group">
                <label>Date Of Birth</label>
                <input type="date" name="dob">
            </div>
            <div class="form-group">
                <label>Current Age</label>
                <input type="text" name="age" placeholder="Your entry here">
            </div>
            <div class="form-group vaccine-section">
                <label>Child’s Vaccinations</label>
                <div class="vaccine-group">
                    <label><input type="radio" name="bcg" id="bcg_received" value="Received"> Received</label>
                    <span>Bacillus Calmette Guerin (BCG)</span>
                    <label><input type="radio" name="bcg" id="bcg_notreceived" value="Not Received"> Not Received</label>
                </div>
                <div class="vaccine-group">
                    <label><input type="radio" name="opv0" id="opv0_received" value="Received"> Received</label>
                    <span>Oral Polio Vaccine (OPV)-0 dose</span>
                    <label><input type="radio" name="opv0" id="opv0_notreceived" value="Not Received"> Not Received</label>
                </div>
                <div class="vaccine-group">
                    <label><input type="radio" name="hepb" id="hepb_received" value="Received"> Received</label>
                    <span>Hepatitis B birth dose</span>
                    <label><input type="radio" name="hepb" id="hepb_notreceived" value="Not Received"> Not Received</label>
                </div>
                <div class="vaccine-group">
                    <label><input type="radio" name="opv1" id="opv1_received" value="Received"> Received</label>
                    <span>OPV-1, Pentavalent-1</span>
                    <label><input type="radio" name="opv1" id="opv1_notreceived" value="Not Received"> Not Received</label>
                </div>
                <div class="vaccine-group">
                    <label><input type="radio" name="rvv" id="rvv_received" value="Received"> Received</label>
                    <span>Rotavirus Vaccine (RVV)-1</span>
                    <label><input type="radio" name="rvv" id="rvv_notreceived" value="Not Received"> Not Received</label>
                </div>
            </div>
            <div style="clear: both;"></div>
            <button type="submit" class="submit-btn">Register</button>
        </form>
    </div>
<script>
function validateForm(event) {
    event.preventDefault();

    const form = document.forms["childForm"];
    const childName = form["child_name"].value.trim();
    const contact = form["parent_contact"].value.trim();
    const email = form["parent_email"].value.trim();
    const address = form["parent_address"].value.trim();
    const dob = form["dob"].value;
    const age = form["age"].value.trim();

    if (!childName || !contact || !email || !address || !dob || !age) {
        alert("Please fill in all required fields.");
        return false;
    }

    if (!/^\d{10}$/.test(contact)) {
        alert("Enter a valid 10-digit contact number.");
        return false;
    }

    if (!/^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com)$/i.test(email)) {
    alert("Enter a valid Gmail or Yahoo email address.");
    return false;
    }

    const genderRadios = form["gender"];
    if (![...genderRadios].some(r => r.checked)) {
        alert("Please select the child's gender.");
        return false;
    }

    const vaccineIds = ["bcg", "opv0", "hepb", "opv1", "rvv"];
    for (const id of vaccineIds) {
        const received = document.getElementById(id + "_received");
        const notReceived = document.getElementById(id + "_notreceived");
        if (!received.checked && !notReceived.checked) {
            alert("Please select vaccination status for " + id.toUpperCase());
            return false;
        }
    }

    alert("Form submitted successfully!");
    form.submit();
    return true;
}
</script>
</body>
</html>
