<?php

# Initialize session
session_start();

# Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
    echo "<script>" . "window.location.href='../login.php';" . "</script>";
    exit;
}

include("../config.php");

# Check if 'id' parameter is passed in URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "No lesson selected!";
    exit();
}

$lesson_id = $_GET['id'];

# Fetch lesson data
$query = "SELECT * FROM lessons WHERE id = '$lesson_id'";
$result = mysqli_query($link, $query);


$lesson = mysqli_fetch_assoc($result);

# Fetch assessment_id from the 'assessments' table based on the lesson_id
$query_assessment = "SELECT assessment_id AS assessment_id FROM assessments WHERE lesson_id = '$lesson_id'";
$result_assessment = mysqli_query($link, $query_assessment);

if (mysqli_num_rows($result_assessment) == 0) {
    echo "No assessment found for this lesson!";
    exit();
}

$assessment = mysqli_fetch_assoc($result_assessment);
$assessment_id = $assessment['assessment_id'];  // Correctly fetching the assessment_id related to the lesson

# Fetch content for this lesson
$query_content = "SELECT * FROM lesson_content WHERE lesson_id = '$lesson_id'";
$content_result = mysqli_query($link, $query_content);

# Fetch user progress
$user_id = $_SESSION['id'];
$query_progress = "SELECT progress FROM lesson_progress WHERE lesson_id = ? AND user_id = ?";
$stmt_progress = $link->prepare($query_progress);
$stmt_progress->bind_param("ii", $lesson_id, $user_id);
$stmt_progress->execute();
$result_progress = $stmt_progress->get_result();

$is_completed = false;
if ($row = $result_progress->fetch_assoc()) {
    $is_completed = (trim($row['progress']) === 'complete');
}

# Check if the user has already completed the assessment
$query_check_completed = "SELECT COUNT(*) AS completed FROM user_scores WHERE user_id = ? AND assessment_id = ?";
$stmt_check_completed = $link->prepare($query_check_completed);
$stmt_check_completed->bind_param("ii", $user_id, $assessment_id);
$stmt_check_completed->execute();
$result_check_completed = $stmt_check_completed->get_result();
$completed = $result_check_completed->fetch_assoc()['completed'] > 0;



$stmt_check_completed->close();
$stmt_progress->close();

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Lesson Preview</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    

    <style>
        .logo-pic{
        height: 40px;
        }

        .collapse-item {
            display: block; /* Ensures the link behaves like a block element */
            white-space: nowrap; /* Prevents text from wrapping */
            overflow: hidden; /* Hides overflowed text */
            text-overflow: ellipsis; /* Adds ellipsis (...) for overflowing text */
            max-width: 100%; /* Ensures the text stays within the container */
        }

        button:hover {
            background-color: <?php echo $is_completed ? '#218838' : '#5a6268'; ?>; /* Darker shades */
        }


    </style>

</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion toggled" id="accordionSidebar" style="z-index: 1;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon">
                    <img src="img/e-favicon.png" alt="Your Website Logo" class="logo-pic">
                </div>
                <div class="sidebar-brand-text mx-3">ADMIN</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Lessons</span>
                </a>    
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Lessons</h6>
                        <?php
                        // Check if there are results
                        if ($result && mysqli_num_rows($result) > 0) {
                            // Loop through the lessons and create nav items
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<a class="collapse-item" href="lesson_preview?id=' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['title']) . '</a>';
                            }
                        } else {
                            // If no lessons are found
                            echo '<span class="collapse-item">No lessons available</span>';
                        }
                        ?>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="report_bug.php">
                    <i class="fas fa-fw fa-bug"></i>
                    <span>Report a Bug</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="https://linktr.ee/eprepdevs">
                    <i class="fas fa-fw fa-info-circle"></i>
                    <span>About Developers</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
        


        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= htmlspecialchars($_SESSION["first_name"]); ?> <?= htmlspecialchars($_SESSION["last_name"]);?></span>
                                <img class="img-profile rounded-circle"
                                    src="./img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->


                <div class="container-fluid mt-5">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h1 mb-0 text-gray-800"><?php echo htmlspecialchars($lesson['title']); ?></h1>
        <a href="dashboard.php" class="btn btn-secondary">Back to Lessons</a>
    </div>

    <?php while ($content = mysqli_fetch_assoc($content_result)) { ?>
        <div class="content-section mb-0 text-gray-800">
            <br>
            <h4 hidden><?php echo htmlspecialchars($content['section_title']); ?></h4>
            <!-- Display raw HTML content for the section body -->
            <div>
                <?php
                    // Fix the image paths in the content if any
                    $content_body = $content['section_body'];
                    
                    // Replace relative image paths with the full URL
                    $content_body = preg_replace('/(src="uploads\/images\/)/', 'src="http://localhost/eprep_revise/admin/uploads/images/', $content_body);
                    
                    echo $content_body;
                ?>
            </div>
        </div>
    <?php } ?>

<!-- Button: Mark Complete, Take Assessment, View Results, or Open Lab Buttons -->
<div class="text-center mt-4">
    <form action="update_progress.php" method="POST">
        <input type="hidden" name="lesson_id" value="<?php echo htmlspecialchars($lesson_id); ?>">

        <?php if ($completed): ?>
            <!-- If the assessment is completed, show the 'View Results' button -->
            <a href="results.php?lesson_id=<?php echo $lesson_id; ?>&assessment_id=<?php echo $assessment_id; ?>" class="btn btn-info btn-lg">
                <i class="fas fa-eye"></i> View Results
            </a>
        <?php elseif ($is_completed): ?>
            <!-- If completed, show Take Assessment button -->
            <a href="assessment.php?lesson_id=<?php echo $lesson_id; ?>&assessment_id=<?php echo $assessment_id; ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-pencil-alt"></i> Take Assessment
            </a>
        <?php else: ?>
            <!-- If not completed, show Mark Complete button -->
            <button type="submit" class="btn btn-success btn-lg">
                <i class="fas fa-check-circle"></i> Mark as Complete
            </button>
        <?php endif; ?>

        <?php
        // Check if there are matching virtual labs for this lesson
        $query = "SELECT * FROM virtual_labs WHERE lesson_id = ?";
        $stmt = $link->prepare($query);
        $stmt->bind_param("i", $lesson_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0 && ($completed || $is_completed)): 
            // Loop through each lab and create a button for it
            while ($lab = $result->fetch_assoc()):
                // Remove the 'uploads/labs/' part and the '.zip' extension from the lab_data field
                $lab_folder = basename($lab['lab_data'], ".zip"); // Extract folder name without the .zip extension

                // Remove '/user/' from lab_data and launch_file to get the correct path
                // We ensure both parts are stripped of '/user/'
                $lab_data_path = str_replace('/user/', '/', $lab['lab_data']);
                $launch_file_path = str_replace('/user/', '/', $lab['launch_file']);

                // Ensure the path is correct by removing unnecessary slashes
                $lab_data_path = rtrim($lab_data_path, '/');
                $launch_file_path = ltrim($launch_file_path, '/');

                // Combine the lab_data and launch_file to get the full path, prepended with 'admin/'
                $lab_full_path = 'admin/' . $lab_data_path . '/' . $launch_file_path;

                // Ensure the URL is correct, now lab_full_path should be relative
        ?>
                <!-- Create a button for each lab with dynamic name -->
                <a href="<?php echo htmlspecialchars($lab_full_path); ?>" class="btn btn-warning btn-lg" target="_blank">
                    <i class="fas fa-flask"></i> Open Lab: <?php echo htmlspecialchars(ucfirst($lab_folder)); ?>
                </a>
        <?php 
            endwhile;
        endif;
        ?>
    </form>
</div>
</div>

</div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white" style="position: sticky; bottom: 0; left: 0; width: 100%;">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; E-Prep 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->


</div>


</div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <!-- Logout button that triggers PHP logout -->
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>
</html>
