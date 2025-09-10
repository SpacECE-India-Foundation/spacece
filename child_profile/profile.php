<?php
session_start();
if(!empty($_SESSION)){
    include 'header_local.php';
    include '../common/header_module.php';
}

// if(isset($_SESSION['current_user_name'])){
//     if(($_SESSION['current_user_type']=='customer') || ($_SESSION['current_user_type']=='delivery_boy') || ($_SESSION['current_user_type']=='book_owner')){
//         header("Location:./cits/dashboard.php");
//     } elseif($_SESSION['current_user_type']=='admin'){
//         header('Location:./cits/admin/dashboard.php');
//     } elseif($_SESSION['current_user_type']=='consultant'){
//         header('Location:./cits/healthofficer/dashboard.php');
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Health Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ===== CORE RESET ===== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        html, body {
            height: 100%;
            width: 100%;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f1f1f1;
            padding-top: 70px; /* Match header height */
        }

        /* ===== FULL-WIDTH HEADER ===== */
        .nav-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            display: flex;
            gap: 14px;
            padding: 20px;
            background: #fff;
            border-bottom: 1px solid #ccc;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .nav-bar button {
            padding: 10px 20px;
            border: 1px solid #ccc;
            background: #fff;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
        }

        .nav-bar .active {
            background-color: #fff7e6;
            border: 1px solid #f5a623;
            color: #f5a623 !important;
            font-weight: 600;
        }

        /* ===== MAIN CONTENT CONTAINER ===== */
        .content-container {
            flex: 1;
            width: 100%;
            padding: 20px 0;
        }

        /* ===== CONTENT SECTIONS ===== */
        .section {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px 40px;
        }

        h1, h2 {
            font-weight: 600;
            margin-bottom: 20px;
        }

/* ===== BUTTON STYLES ===== */

.btn-container {
    display: flex;
    justify-content: space-between; /* Pushes groups to opposite ends */
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 25px;
    width: 100%;
}
/* Button Groups */
.btn-group {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

/* Individual Buttons */
.btn {
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    border: none;
    white-space: nowrap;
    transition: all 0.2s ease;
}

/* Orange Buttons */
.btn-orange {
    background-color: #FFAA00;
    color: white;
    box-shadow: 0 2px 4px rgba(255,170,0,0.3);
}

.btn-orange:hover {
    background-color: #E69500;
}


/* Blue Buttons */
.btn-blue {
    background-color: #45C4F9;
    color: white;
    box-shadow: 0 2px 4px rgba(69,196,249,0.3);
}

.btn-blue:hover {
    background-color: #3AB0E6;
}

/* Responsive Behavior */
@media (max-width: 768px) {
    .btn-container {
        flex-direction: column;
        gap: 15px;
    }
    .btn-group {
        width: 100%;
    }
    .btn {
        width: 100%;
    }
}

       /* ===== GRID LAYOUTS ===== */
        .profile-grid, .health-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .profile-grid, .health-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ===== FORM CONTROLS ===== */
        .form-control {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            width: 100%;
        }

        label {
            font-size: 13px;
            margin-bottom: 5px;
            color: #444;
        }

        input[type="text"], input[type="file"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            width: 100%;
        }

        /* ===== STATUS INDICATORS ===== */
        .status {
            padding: 10px;
            border-radius: 6px;
            font-weight: 600;
            width: 100%;
        }

        .status-green {
            background-color: #e6ffe6;
            color: green;
            border: 1px solid #90ee90;
        }

        /* ===== IMAGE CONTAINERS ===== */
        .placeholder-container {
            position: relative;
            min-height: 250px;
            background: repeating-conic-gradient(#ccc 0% 25%, #eee 0% 50%) 0 / 20px 20px;
            border-radius: 6px;
            width: 100%;
        }

        /* ===== IFRAME STYLES ===== */
        iframe {
            width: 100%;
            height: 500px;
            border: none;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* ===== FOOTER STYLES ===== */
        footer {
            width: 100%;
            background: #f8f9fa;
            padding: 20px 0;
            border-top: 1px solid #dee2e6;
            margin-top: auto;
        }
/* Button Container */
.btn-container {
    display: flex;
    justify-content: flex-start; /* Aligns content to the left */
    margin-bottom: 25px;
    width: 100%;
}

/* Button Group */
.btn-group {
    display: flex;
    gap: 12px; /* Space between buttons */
    flex-wrap: wrap;
}

/* Red Button */
.btn-red {
    background-color: #FF4D4D;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    border: none;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-red:hover {
    background-color: #E63939;
}

/* Blue Button */
.btn-blue {
    background-color: #45C4F9;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    border: none;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-blue:hover {
    background-color: #3AB0E6;
}
    </style>
</head>
<body>
    <div class="nav-bar">
        <button class="active">Dashboard</button>
        <a href="ConsultUs/appoint.php">
        <button>Book Appointment</button></a>
        <a href="showmyappoint.php">
        <button>Appointment History</button></a>
        <a href="immunization.php">
        <button>Immunization History</button></a>
        <button>Search Immunization Info</button>
    </div>

    <!-- Main Content -->
    <div class="content-container">
        <div class="section">
            <h1>Child Profile</h1>
<div class="btn-group">
<div class="btn-container">
    <div class="btn-group">
        <a href="immunization.php" class="btn btn-orange">Immunization Tracker</a>
        <a href="height.php" class="btn btn-orange">Height Chart</a>
        <a href="weight.php" class="btn btn-orange">Weight Chart</a>
    </div>
    
    <div class="btn-group">
        <a href="register.php" class="btn btn-blue">Book Doctor</a>
        <a href="cits/appointment-history.php" class="btn btn-blue">Your Appointments</a>
    </div>
</div>
</div>
            
            <div class="profile-grid">
                <div class="placeholder-container" id="imagePreviewContainer">
                    <!-- Image will appear here -->
                </div>
                <div>
                    <div class="form-control">
                        <label>Child's Name</label>
                        <input type="text" value="Child 1">
                    </div>
                    <div class="dob-age-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-control">
                            <label>Child's Date of Birth</label>
                            <input type="text" value="10 / 12 / 2020">
                        </div>
                        <div class="form-control">
                            <label>Child's Age</label>
                            <input type="text" value="4 year, 5 Months">
                        </div>
                    </div>
                    <div class="form-control">
                        <label>Child's Gender</label>
                        <input type="text" value="Filed Entry">
                    </div>
                    <div class="form-control">
                        <label>Image</label>
                        <input type="file" id="imageUploadInput" accept="image/*">
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>Current Health Updates</h2>
            <div class="btn-group">
<div class="btn-container">
    <!-- Left-aligned Orange Buttons -->
    <div class="btn-group">
        <a href="immunization.php" class="btn btn-orange">Immunization Tracker</a>
        <a href="height.php" class="btn btn-orange">Height Chart</a>
        <a href="weight.php" class="btn btn-orange">Weight Chart</a>
    </div>
    
    <!-- Right-aligned Blue Buttons -->
    <div class="btn-group">
        <button class="btn btn-blue">Book Pediatrician</button>
        <a href="cits/appointment-history.php" class="btn btn-blue">Your Appointments</a>
    </div>
</div>
            </div>
            
            <div class="health-grid">
                <div>
                    <div class="form-control">
                        <label>Next Immunization</label>
                        <input type="text" value="Vaccine Name">
                    </div>
                    <div class="form-control">
                        <label>Vaccine Appointment Date</label>
                        <input type="text" value="10 / 12 / 2025">
                    </div>
                    <div class="form-control">
                        <label>Previous Immunization</label>
                        <input type="text" value="10 / 1 / 2025">
                    </div>
                </div>
                <div>
                    <div class="form-control">
                        <label>Disease Being Immunized For</label>
                        <input type="text" value="Disease Name">
                    </div>
                    <div class="form-control">
                        <label>Child's Age Upon Administering</label>
                        <input type="text" value="5 Years">
                    </div>
                    <div class="form-control">
                        <label>Status Of All Immunizations</label>
                        <div class="status">Incomplete</div>
                    </div>
                </div>
            </div>
            <!-- Button Container -->
<div class="btn-container" style="justify-content: flex-start;">
    <div class="btn-group">
        <a href="register.php" class="btn btn-red">Book Doctor</a>
        <a href="cits/appointment-history.php" class="btn btn-blue">Your Appointments</a>
    </div>
</div>
        </div>
        <div class="content-container">
    <div class="section"></div>

        <div class="section">
            <div class="health-grid">
                <div>
                    <iframe src="height_chart.php"></iframe>
                </div>
                <div>
                    <div class="form-control">
                        <label>Last Height Measurement</label>
                        <input type="text" value="110 cm">
                    </div>
                    <div class="form-control">
                        <label>Average Height For This Age - Male</label>
                        <input type="text" value="105 cm">
                    </div>
                    <div class="form-control">
                        <label>Status</label>
                        <div class="status status-green">Healthy</div>
                    </div>
                                <!-- Button Container -->
<div class="btn-container" style="justify-content: flex-start;">
    <div class="btn-group">
        <a href="register.php" class="btn btn-red">Book Doctor</a>
        <a href="cits/appointment-history.php" class="btn btn-blue">Your Appointments</a>
    </div>
</div>
</div>                
                <div>
                    <iframe src="weight_chart.php"></iframe>
                </div>
                <div>
                    <div class="form-control">
                        <label>Last Weight Measurement</label>
                        <input type="text" value="14 kgs">
                    </div>
                    <div class="form-control">
                        <label>Average Weight For This Age - Male</label>
                        <input type="text" value="14 kgs">
                    </div>
                    <div class="form-control">
                        <label>Status</label>
                        <div class="status status-green">Healthy</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once '../common/footer_module.php'; ?>

    <script>
        // Image Upload Preview
        document.getElementById('imageUploadInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const container = document.getElementById('imagePreviewContainer');
            container.innerHTML = '';

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';
                    img.style.borderRadius = '6px';
                    container.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>