<?php
// Start the session to access user details
session_start();
require '../../../../config.php'; // Include the database configuration

// Check if the user is logged in
if (!isset($_SESSION['student_number'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

// Get user details from session
$studentNumber = $_SESSION['student_number'];
$firstName = $_SESSION['first_name'];
$lastName = $_SESSION['last_name'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>E-Prep Virtual Lab Complete</title>
    <!-- Font Awesome icons (free version)-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet">
    <!-- Fonts CSS-->
    <link rel="stylesheet" href="css/heading.css">
    <link rel="stylesheet" href="css/body.css">
    <style>
        /* Ensure the entire page takes full height */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /* The main content should take up the remaining space */
        .content {
            flex: 1;
        }

        /* Sticky footer styling */
        .copyright {
            background-color: #222; /* Example background color */
            color: gray;
            padding: 10px 0;
            text-align: center;
        }
    </style>
</head>
<body id="page-top">
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top" id="mainNav">
        <div class="container bg-gray-900">
            <a class="navbar-brand mx-auto js-scroll-trigger" style="color:darkgrey" href="../../../dashboard.php">E-PREP © 2024</a>
            <button class="navbar-toggler navbar-toggler-right font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content masthead bg-white text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->
            <img class="masthead-avatar mb-5" src="assets/img/avataaars.svg" alt="">
            <!-- Masthead Heading-->
            <h1 class="masthead-heading mb-0 text-secondary" style="white-space: nowrap;">
                Congratulations, <?php echo htmlspecialchars($firstName . ' ' . $lastName); ?>!
            </h1>
            <h3 class="text-secondary mt-3">You have successfully completed your virtual laboratory</h3>
            <!-- Icon Divider-->
            <div class="divider-custom divider-dark">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Masthead Subheading-->
            <button type="button" class="btn btn-info btn-xl" onclick="window.location.href='../../../dashboard.php'">CONTINUE</button>
        </div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
    <div class="scroll-to-top d-lg-none position-fixed">
        <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>
