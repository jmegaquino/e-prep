<?php

session_start();
require_once "../config.php";


if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
  echo "<script>" . "window.location.href='../login.php';" . "</script>";
  exit;
}


// Function to generate quiz link
function generateQuizLink($quizTable) {
    // Assuming your quiz pages are named quiz.php and you pass the quiz table name as a query parameter
    return "quiz?table=$quizTable";
}

// Query to fetch lessons from the database
$query = "SELECT id, title FROM lessons";
$result_lesson = mysqli_query($link, $query);

// Fetch the logged-in user's details from the `users` table
$query = "SELECT first_name, last_name, email, student_number FROM users WHERE id = ?";
$stmt = $link->prepare($query);
$stmt->bind_param("i", $_SESSION['id']); // Replace with the session's user ID
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();


// Initialize flag to check if all relevant activities are completed
$allCompleted = true;

// Fetch all lessons from the database
$sql = "SELECT id FROM lessons";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    while ($lesson = $result->fetch_assoc()) {
        $lessonId = $lesson['id'];

        // Check lesson completion
        $query_progress = "SELECT progress FROM lesson_progress WHERE lesson_id = ? AND user_id = ?";
        $stmt_progress = $link->prepare($query_progress);
        $stmt_progress->bind_param("ii", $lessonId, $_SESSION['id']);
        $stmt_progress->execute();
        $result_progress = $stmt_progress->get_result();
        $is_completed = false;

        if ($row = $result_progress->fetch_assoc()) {
            $is_completed = (trim($row['progress']) === 'complete');
        }
        $stmt_progress->close();

        // Check quiz completion
        $query_score = "SELECT score FROM user_scores WHERE user_id = ? AND assessment_id = (SELECT assessment_id FROM assessments WHERE lesson_id = ?)";
        $stmt_score = $link->prepare($query_score);
        $stmt_score->bind_param("ii", $_SESSION['id'], $lessonId);
        $stmt_score->execute();
        $result_score = $stmt_score->get_result();
        $quizAttempted = ($result_score->num_rows > 0); // At least one attempt
        $stmt_score->close();

        // Check if the lesson has a virtual lab
        $query_virtual_lab = "SELECT id FROM virtual_labs WHERE lesson_id = ?";
        $stmt_virtual_lab = $link->prepare($query_virtual_lab);
        $stmt_virtual_lab->bind_param("i", $lessonId);
        $stmt_virtual_lab->execute();
        $result_virtual_lab = $stmt_virtual_lab->get_result();
        $hasVirtualLab = ($result_virtual_lab->num_rows > 0);
        $stmt_virtual_lab->close();

        // Check virtual lab completion if the lesson has a virtual lab
        $labCompleted = true; // Default to true if no virtual lab exists
        if ($hasVirtualLab) {
            $query_lab_progress = "SELECT progress_status FROM progress WHERE lesson_id = ? AND user_id = ?";
            $stmt_lab_progress = $link->prepare($query_lab_progress);
            $stmt_lab_progress->bind_param("ii", $lessonId, $_SESSION['id']);
            $stmt_lab_progress->execute();
            $result_lab_progress = $stmt_lab_progress->get_result();
            $labCompleted = false;

            if ($row = $result_lab_progress->fetch_assoc()) {
                $labCompleted = (trim($row['progress_status']) === 'completed');
            }
            $stmt_lab_progress->close();
        }

        // If any required activity is incomplete, set the flag to false
        if (!$is_completed || !$quizAttempted || !$labCompleted) {
            $allCompleted = false;
            break; // Exit loop early if any activity is incomplete
        }
    }
}


?>




<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-prep Dashboard</title>

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
        transform: rotate(15deg);
        }

        .card-container .card{
            width: 32%;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease; /* Smooth transition */
        }

        .card-container .card:hover{
            transform: scale(1.05);
        }

        #nocollapse::after{
            display: none;
        }

        .collapse-item {
            display: block; /* Ensures the link behaves like a block element */
            white-space: nowrap; /* Prevents text from wrapping */
            overflow: hidden; /* Hides overflowed text */
            text-overflow: ellipsis; /* Adds ellipsis (...) for overflowing text */
            max-width: 100%; /* Ensures the text stays within the container */
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
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="img/e-favicon.png" alt="Your Website Logo" class="logo-pic">
                </div>
                <div class="sidebar-brand-text mx-3">STUDENT</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
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
                        if ($result_lesson && mysqli_num_rows($result_lesson) > 0) {
                            // Loop through the lessons and create nav items
                            while ($row = mysqli_fetch_assoc($result_lesson)) {
                                echo '<a class="collapse-item" href="lesson_preview.php?id=' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['title']) . '</a>';
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

        <!-- Content Wrapper -->
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

                

                        <!-- Conditionally display the Download Certificate button or message -->
                        <?php if ($allCompleted): ?>
                            <li class="nav-item dropdown no-arrow">
                                <a 
                                    class="nav-link dropdown-toggle" 
                                    href="#" 
                                    id="userDropdown" 
                                    role="button" 
                                    data-toggle="dropdown" 
                                    aria-haspopup="true" 
                                    aria-expanded="false"
                                >
                                    <button 
                                        id="downloadCertificate" 
                                        class="btn btn-success btn-lg text-white" 
                                        style="box-shadow: 0 8px 15px rgba(0, 128, 0, 0.3); border-radius: 8px; font-size: 1.2rem; padding: 10px 20px;"
                                        onclick="triggerConfettiAndDownload()"
                                    >
                                        🎉 Download Certificate 🎓
                                    </button>
                                </a>
                            </li>
                        <?php else: ?>
                            <p 
                                class="text-warning mt-3" 
                                style="font-size: 1.1rem; text-align: center; font-weight: bold; margin-top: 20px;"
                            >
                                ⚠️ You need to complete all required activities to download the certificate.
                            </p>
                        <?php endif; ?>

                        <div class="topbar-divider d-none d-sm-block"></div>

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

                <!-- Begin Page Content -->
                <div class="container-fluid" style="padding: 20px;"> <!-- Add padding here -->

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Lessons Section -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Lessons</h6>
                                </div>

                                <div class="card-body">
                        <!-- Row for Lessons -->
                        <div class="card-container" style="display: flex; flex-wrap: wrap; gap: 15px; justify-content: space-between; padding: 15px;">
                            <?php
                            // Fetch all lessons from the database
                            $sql = "SELECT id, title, description FROM lessons";
                            $result = $link->query($sql);

                            if ($result->num_rows > 0) {
                                while ($lesson = $result->fetch_assoc()) {
                                    $lessonId = $lesson['id'];
                                    $lessonTitle = $lesson['title'];
                                    $lessonDescription = $lesson['description'];

                                    // Fetch the lesson progress for the user
                                    $query_progress = "SELECT progress FROM lesson_progress WHERE lesson_id = ? AND user_id = ?";
                                    $stmt_progress = $link->prepare($query_progress);
                                    $stmt_progress->bind_param("ii", $lessonId, $_SESSION['id']);
                                    $stmt_progress->execute();
                                    $result_progress = $stmt_progress->get_result();
                                    $progress = 0; // Default to 0% progress if no data found
                                    $is_completed = false;
                                    if ($row = $result_progress->fetch_assoc()) {
                                        // Check if the lesson is completed
                                        $is_completed = (trim($row['progress']) === 'complete');
                                    }
                                    $stmt_progress->close();

                                    // Fetch the quiz score for this lesson (if available)
                                    $query_score = "SELECT score, total_questions FROM user_scores WHERE user_id = ? AND assessment_id = (SELECT assessment_id FROM assessments WHERE lesson_id = ?)";
                                    $stmt_score = $link->prepare($query_score);
                                    $stmt_score->bind_param("ii", $_SESSION['id'], $lessonId);
                                    $stmt_score->execute();
                                    $result_score = $stmt_score->get_result();
                                    $quizScore = 0;
                                    $totalQuestions = 1; // Default to 1 to avoid division by zero if no record found
                                    $quizAttempted = false; // Flag to check if quiz was attempted
                                    if ($row = $result_score->fetch_assoc()) {
                                        $quizScore = $row['score'];
                                        $totalQuestions = $row['total_questions'];
                                        $quizAttempted = true; // If a record exists, set quiz as attempted
                                    }
                                    $stmt_score->close();

                                    // Check if a virtual lab exists for this lesson
                                    $hasVirtualLab = false;
                                    $query_virtual_lab = "SELECT id FROM virtual_labs WHERE lesson_id = ?";
                                    $stmt_virtual_lab = $link->prepare($query_virtual_lab);
                                    $stmt_virtual_lab->bind_param("i", $lessonId);
                                    $stmt_virtual_lab->execute();
                                    $result_virtual_lab = $stmt_virtual_lab->get_result();
                                    if ($result_virtual_lab->num_rows > 0) {
                                        $hasVirtualLab = true;
                                    }
                                    $stmt_virtual_lab->close();

                                    // Fetch the virtual lab progress for this lesson and user (if a virtual lab exists)
                                    $labProgress = "Not Started"; // Default status
                                    if ($hasVirtualLab) {
                                        $query_lab_progress = "SELECT progress_status FROM progress WHERE lesson_id = ? AND user_id = ?";
                                        $stmt_lab_progress = $link->prepare($query_lab_progress);
                                        $stmt_lab_progress->bind_param("ii", $lessonId, $_SESSION['id']);
                                        $stmt_lab_progress->execute();
                                        $result_lab_progress = $stmt_lab_progress->get_result();
                                        if ($row = $result_lab_progress->fetch_assoc()) {
                                            $labProgress = $row['progress_status'];
                                        }
                                        $stmt_lab_progress->close();
                                    }

                                    // Calculate the quiz percentage (0% if no quiz score or total questions are 0)
                                    $quizPercentage = ($totalQuestions > 0) ? ($quizScore / $totalQuestions) * 100 : 0;

                                    // Start with 0% progress
                                    $progress = 0;

                                    // Add 60% if the lesson is marked as complete
                                    if ($is_completed) {
                                        $progress += 60;
                                    }

                                    // Add 40% if the user has attempted the quiz (even if the score is 0)
                                    if ($quizAttempted) {
                                        $progress += 40;
                                    }

                                    // Ensure progress does not exceed 100%
                                    if ($progress > 100) {
                                        $progress = 100;
                                    }
                            ?>
                            <!-- Individual Lesson Card -->
                            <div class="card border-left-primary shadow" 
                                style="width: 32%; border: 1px solid #ddd; border-radius: 5px; padding: 15px; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);" 
                                onclick="window.location.href='lesson_preview.php?id=<?php echo $lessonId; ?>';">
                                <!-- Progress and Quiz Score -->
                                <div style="margin-bottom: 15px;">
                                    <!-- Progress Bar -->
                                    <h6 class="small font-weight-bold">Progress: <span class="float-right"><?php echo $progress; ?>%</span></h6>
                                    <div class="progress mb-2" style="height: 10px;">
                                        <div class="progress-bar bg-primary" role="progressbar" 
                                            style="width: <?php echo $progress; ?>%" 
                                            aria-valuenow="<?php echo $progress; ?>" 
                                            aria-valuemin="0" 
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                    
                                    <!-- Quiz Score Bar -->
                                    <h6 class="small font-weight-bold">Quiz Score: <span class="float-right"><?php echo round($quizPercentage, 2); ?>%</span></h6>
                                    <div class="progress mb-2" style="height: 10px;">
                                        <div class="progress-bar bg-success" role="progressbar" 
                                            style="width: <?php echo round($quizPercentage, 2); ?>%" 
                                            aria-valuenow="<?php echo round($quizPercentage, 2); ?>" 
                                            aria-valuemin="0" 
                                            aria-valuemax="100">
                                        </div>
                                    </div>

                                    <!-- Virtual Lab Progress -->
                                    <?php if ($hasVirtualLab): ?>
                                    <h6 class="small font-weight-bold">Lab Progress: <span class="float-right"><?php echo htmlspecialchars($labProgress); ?></span></h6>
                                    <?php endif; ?>
                                </div>
                                <!-- Lesson Title and Description -->
                                <h5 class="card-title" style="font-size: 18px; font-weight: bold;"><?php echo htmlspecialchars($lessonTitle); ?></h5>
                                <p style="font-size: 14px; color: #555;"><?php echo htmlspecialchars($lessonDescription); ?></p>
                            </div>
                            <?php
                                }
                            } else {
                                echo "<p>No lessons available.</p>";
                            }

                            $link->close();
                            ?>
                        </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Section -->
                        <div class="col-xl-4 col-lg-5">
                            <!-- Display Current Date -->
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h5 class="font-weight-bold text-center" style="margin-bottom: 20px;">
                                        <?php echo date('l, F j, Y'); // Display the current date ?>
                                    </h5>
                                </div>
                            </div>

                            <!-- Profile Card -->
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">My Profile</h6>
                                </div>
                                <div class="card-body text-center">
                                    <!-- Profile Image -->
                                    <img src="./img/undraw_profile.svg" 
                                        alt="Profile Picture" 
                                        class="img-fluid rounded-circle mb-3" 
                                        style="width: 120px; height: 120px; object-fit: cover;">
                                    
                                    <!-- Profile Details -->
                                    <h5 class="font-weight-bold"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h5>
                                    <p class="text-muted"><?php echo htmlspecialchars($user['student_number']); ?></p>
                                    <p class="text-muted"><?php echo htmlspecialchars($user['email']); ?></p>


                                    <!-- Edit Profile Button -->
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

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
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

<!-- Modal for Editing Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Profile Edit Form -->
                <form action="edit_profile.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="student_number">Student Number</label>
                        <input type="text" class="form-control" id="student_number" name="student_number" value="<?php echo htmlspecialchars($user['student_number']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


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

<?php
    if (isset($_GET['status']) && $_GET['status'] == 'success') {
        echo '
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Profile Update Success</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Your profile has been updated successfully.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>';
    }
    ?>

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
<!-- Include Confetti Script -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
<script>
    // Function to trigger confetti and navigate to certificate page
    function triggerConfettiAndDownload() {
        // Trigger confetti effect
        confetti({
            particleCount: 100,
            spread: 70,
            origin: { x: 0.5, y: 0.5 } // Center of the screen
        });

        // Delay to let confetti play before navigation
        setTimeout(() => {
            window.location.href = 'certificate.php';
        }, 2000); // Adjust timing as needed
    }
</script>


<script>
        // Show the modal if the status is success
        <?php
        if (isset($_GET['status']) && $_GET['status'] == 'success') {
            echo '$("#successModal").modal("show");';
        }
        ?>
    </script>

</body>

</html>


