<?php
# Initialize the session
session_start();

# If user is not logged in then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
  echo "<script>" . "window.location.href='../login';" . "</script>";
  exit;
}

// Include database connection
require_once "../config.php";

// Query to fetch lessons from the database
$query = "SELECT id, title FROM lessons";
$result_lesson = mysqli_query($link, $query);

// Fetch the user's first and last names
$user_id = $_SESSION["id"];
$first_name = "";
$last_name = "";
$email = "";

$sql = "SELECT first_name, last_name, email FROM users WHERE id = ?";
if ($stmt = $link->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        $stmt->bind_result($first_name, $last_name, $email);
        $stmt->fetch();
    }
    $stmt->close();
}

$name = $first_name . ' ' . $last_name;

// Process form submission
$name_input = $email_input = $description_input = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate inputs
    $name_input = trim($_POST["name"]);
    $email_input = trim($_POST["email"]);
    $description_input = trim($_POST["description"]);

    // Insert data into database
    $sql_insert = "INSERT INTO bug_reports (name, email, description) VALUES (?, ?, ?)";
    if ($stmt = $link->prepare($sql_insert)) {
        $stmt->bind_param("sss", $name_input, $email_input, $description_input);
        if ($stmt->execute()) {
            $_SESSION["success_message"] = "Bug report submitted successfully";
            // Redirect to prevent form resubmission
            header("Location: report_bug.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: Unable to prepare statement";
    }
}

$link->close();
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

        /* Bug Report Form Styling */
.bug-report-form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.bug-report-form h1 {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    font-size: 1.1rem;
    font-weight: 500;
    color: #333;
}

input[type="text"], input[type="email"], textarea {
    width: 100%;
    padding: 12px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #fff;
    box-sizing: border-box;
}

input[type="text"]:readonly, input[type="email"]:readonly {
    background-color: #f0f0f0;
}

textarea {
    resize: vertical;
}

input[type="submit"] {
    background-color: #28a745;
    border: none;
    padding: 12px 24px;
    font-size: 1.1rem;
    color: white;
    border-radius: 6px;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #218838;
}

.alert-success {
    margin-top: 20px;
    font-size: 1.1rem;
    padding: 15px;
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
    border-radius: 6px;
}


    </style>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion toggled" id="accordionSidebar" style="z-index: 1;">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon rotate-n-15">
                <img src="img/e-favicon.png" alt="Your Website Logo" class="logo-pic">
            </div>
            <div class="sidebar-brand-text mx-3">STUDENT</div>
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
    <div class="container">
        <h1 class="text-center mb-4">Report a Bug/Send Suggestions</h1>
        <form action="report_bug.php" method="post" class="bug-report-form">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" required readonly>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>" required readonly>
            </div>

            <div class="form-group">
                <label for="description">Bug Description:</label> 
                <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
            </div>

            <?php if (isset($_SESSION["success_message"])) : ?>
                <div class="alert alert-success mt-3" role="alert">
                    <?php echo $_SESSION["success_message"]; ?>
                </div>
                <?php unset($_SESSION["success_message"]); ?>
            <?php endif; ?>

            <div class="form-group text-center">
                <input type="submit" value="Submit" class="btn btn-success btn-lg">
            </div>
        </form>
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
