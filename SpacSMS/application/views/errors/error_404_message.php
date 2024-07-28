<!doctype html>
<html lang="en">
<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <title>404 Page Not Found</title>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900&display=swap" rel="stylesheet"> 
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.css" />
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <style>
        html,
        body {
            min-height: 100%;
        }
        body {
            line-height: 1.7;
            color: #777777;
            font-size: 14px;
            font-family: 'Raleway', sans-serif;
            font-weight: 300;
            background-color: #fff;
            background-attachment: fixed;
        }
        .display-table {
            display: table;
            height: 100%;
            position: relative;
            width: 100%;
            z-index: 1;
        }
        .display-table-cell {
            display: table-cell;
            height: 100%;
            vertical-align: middle;
        }
        .text-theme-colored {
            color: #00a3c8 !important;
            font-size: 150px !important;
            font-weight: 800 !important;
        }
        .mb-5 {
            margin-bottom: 5px !important;
        }
        .fullscreen {
            height: 100vh;
        }
        .btn-primary {
            padding: 10px 25px;
            background-color: #0091cd;
            border-color: #0091cd;
        }
        .btn-primary:hover {
            background-color: #005a80;
        }
        .back-404 {
            background-color: #fff;
            max-width: 400px;
            padding-bottom: 40px;
            position: relative;
            margin: auto;
        }

        .back-404 h4, .back-404 h3 {
            font-size: 28px !important;
        }
        .back-404:before {
            content: "";
            left: 125px;
            bottom: -18px;
            position: absolute;
            border: 5px solid #0091cd;
            transform: rotate(35deg);
            z-index: -1;
            width: 390px;
            height: 390px;
        }
        @media (max-width: 991px) {
            .back-404:before {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div id="wrapper" class="clearfix">
        <!-- Start main-content -->
        <div class="main-content">
            <!-- Section: home -->
            <section id="home" class="fullscreen bg-lightest">
                <div class="display-table text-center">
                    <div class="display-table-cell">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                <div class="back-404">
                                    <h1 class="text-theme-colored">404</h1>
                                    <h3 class="mb-5">Oops! Page Not Found</h3>
                                    <p>The page you were looking for could not be found.</p>
                                    <button class="btn btn-primary" onclick="history.go(-1);">Take Me Previous Page</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end wrapper -->
    <!-- Footer Scripts -->
    <!-- JS | Custom script for all pages -->
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
</body>
</html>