<?php

# Initialize the session
session_start();

# If admin user is not logged in then redirect him to login page
if (!isset($_SESSION["loggedin_admin"]) || $_SESSION["loggedin_admin"] !== TRUE) {
  echo "<script>" . "window.location.href='../login_admin';" . "</script>";
  exit;
}

include("../config.php");

$query = "SELECT * FROM lessons";
$result = mysqli_query($link, $query);



?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lesson Management - E-Prep</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    

    <style>
        .logo-pic{
        height: 40px;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index">
                <div class="sidebar-brand-icon">
                    <img src="../img/e-favicon.png" alt="Your Website Logo" class="logo-pic">
                </div>
                <div class="sidebar-brand-text mx-3">ADMIN</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link" href="index">
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
                        <h6 class="collapse-header">Lessons:</h6>
                        <a class="collapse-item" href="lesson_man">Lesson Management</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw  fa-user"></i>
                    <span>Users</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Users:</h6>
                        <a class="collapse-item" href="user_management">User Management</a>
                    </div>
                </div>
            </li>

                <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAssessment"
                    aria-expanded="true" aria-controls="collapseAssessment">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Assessments</span>
                </a>
                <div id="collapseAssessment" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Assessments:</h6>
                        <a class="collapse-item" href="quiz_management">Assessment Management</a>
                    </div>
                </div>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= htmlspecialchars($_SESSION["username"]); ?></span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
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
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lesson Management</h1>
    </div>

    <div class="row">

        <!-- Display Lessons Card (Scrollable) -->
        <div class="col-lg-12">
            <div class="card mb-4 shadow">
                <div class="card-header d-flex justify-content-start align-items-center">
                    <!-- Add Lesson Button -->
                    <a href="#" class="btn btn-primary btn-icon-split mr-2" data-toggle="modal" data-target="#addLessonModal">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">Add Lesson</span>
                    </a>

                    <!-- Manage Virtual Labs Button for a specific lesson -->
                    <a href="#" class="btn btn-secondary btn-icon-split" data-toggle="modal" data-target="#manageVirtualLabsModal" onclick="setLessonId(<?php echo $lessonId; ?>)">
                        <span class="icon text-white-50">
                            <i class="fa fa-cogs"></i>
                        </span>
                        <span class="text">Manage Virtual Labs</span>
                    </a>
                </div>
                <div class="card-body">
                    <!-- Scrollable container for lessons -->
                    <div class="lesson-cards-container" style="max-height: 500px; overflow-y: auto;">
                        <div class="row">
                            <?php
                            // Fetch lessons along with their content sections from the database
                            $sql = "
                                SELECT 
                                    l.id AS lesson_id, 
                                    l.title AS lesson_title, 
                                    l.description AS lesson_description, 
                                    lc.id AS content_id, 
                                    lc.section_title, 
                                    lc.section_body
                                FROM 
                                    lessons l
                                LEFT JOIN 
                                    lesson_content lc 
                                ON 
                                    l.id = lc.lesson_id
                                ORDER BY 
                                    l.id DESC
                            ";
                            $result = mysqli_query($link, $sql);

                                // Check if there are any lessons
                                if ($result && mysqli_num_rows($result) > 0) {
                                    $lesson_data = [];

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $lessonId = $row['lesson_id'];

                                        // Initialize lesson data if it hasn't been added yet
                                        if (!isset($lesson_data[$lessonId])) {
                                            $lesson_data[$lessonId] = [
                                                'id' => $lessonId,
                                                'title' => $row['lesson_title'],
                                                'description' => $row['lesson_description'],
                                                'content' => [] // Initialize content as an empty array
                                            ];
                                        }

                                        // Add content section if it exists
                                        if (!empty($row['section_title'])) {
                                            $lesson_data[$lessonId]['content'][] = [
                                                'id' => $row['content_id'] ?? null, // Include content ID if available
                                                'section_title' => $row['section_title'],
                                                'section_body' => $row['section_body']
                                            ];
                                        }
                                    }


                                // Iterate through the lessons and display them
                                foreach ($lesson_data as $lessonId => $lesson) {
                                    echo '
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="card shadow mb-4">
                                            <!-- Card Header with Dropdown -->
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">' . htmlspecialchars($lesson['title']) . '</h6>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink' . $lessonId . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink' . $lessonId . '">
                                                        <div class="dropdown-header">Lesson Options:</div>
                                                        <a class="dropdown-item edit-lesson-btn" href="#" data-id="' . $lessonId . '" data-title="' . htmlspecialchars($lesson['title']) . '" data-description="' . htmlspecialchars($lesson['description']) . '" data-content="' . htmlspecialchars(json_encode($lesson['content'])) . '" data-toggle="modal" data-target="#editLessonModal' . $lessonId . '">Edit</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteLessonModal' . $lessonId . '">Delete</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="lesson_preview.php?id=' . $lessonId . '">Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Card Body -->
                                            <div class="card-body">
                                                <p class="card-text">' . htmlspecialchars($lesson['description']) . '</p>
                                            </div>
                                        </div>
                                    </div>';

                                    // Fetch the virtual labs related to the lesson from the database
                                    $virtualLabsQuery = "SELECT * FROM virtual_labs WHERE lesson_id = '$lessonId'";
                                    $virtualLabsResult = mysqli_query($link, $virtualLabsQuery);

                                    // Check if there are any virtual labs
                                    $virtualLabs = [];
                                    if (mysqli_num_rows($virtualLabsResult) > 0) {
                                        $virtualLabs = mysqli_fetch_all($virtualLabsResult, MYSQLI_ASSOC);
                                    }

                                        // Fetch the virtual labs related to the lesson from the database
                                        $virtualLabsQuery = "SELECT * FROM virtual_labs WHERE lesson_id = '$lessonId'";
                                        $virtualLabsResult = mysqli_query($link, $virtualLabsQuery);

                                        // Check if there are any virtual labs
                                        $virtualLabs = [];
                                        if (mysqli_num_rows($virtualLabsResult) > 0) {
                                            $virtualLabs = mysqli_fetch_all($virtualLabsResult, MYSQLI_ASSOC);
                                        }

                                        // Edit Lesson Modal (without Virtual Labs part)
                                        echo '
                                        <div class="modal fade" id="editLessonModal' . $lessonId . '" tabindex="-1" role="dialog" aria-labelledby="editLessonModalLabel' . $lessonId . '" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editLessonModalLabel' . $lessonId . '">Edit Lesson</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="edit_lesson.php" method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <!-- Hidden field for Lesson ID -->
                                                            <input type="hidden" name="id" value="' . $lessonId . '">

                                                            <!-- Lesson Title -->
                                                            <div class="form-group">
                                                                <label for="lessonTitle">Lesson Title</label>
                                                                <input type="text" class="form-control" id="lessonTitle' . $lessonId . '" name="lessonTitle" value="' . htmlspecialchars($lesson['title']) . '" required>
                                                            </div>

                                                            <!-- Lesson Description -->
                                                            <div class="form-group">
                                                                <label for="lessonDescription">Description</label>
                                                                <input type="text" class="form-control" id="lessonDescription' . $lessonId . '" name="lessonDescription" value="' . htmlspecialchars($lesson['description']) . '" required>
                                                            </div>

                                                            <!-- Content Sections -->
                                                            <div class="form-group">
                                                                <label>Content Sections</label>';

                                                                // Display Content Sections
                                                                if (!empty($lesson['content'])) {
                                                                    foreach ($lesson['content'] as $index => $section) {
                                                                        $contentId = isset($section['id']) ? htmlspecialchars($section['id']) : ''; // Retrieve the content ID
                                                                        $sectionTitle = isset($section['section_title']) ? htmlspecialchars($section['section_title']) : '';
                                                                        $sectionBody = isset($section['section_body']) ? htmlspecialchars($section['section_body']) : '';
                                                                    
                                                                        echo '
                                                                        <div class="content-item mb-3">
                                                                            <input type="hidden" name="existingContentIds[]" value="' . $contentId . '"> <!-- Hidden input for content ID -->
                                                                            <input type="text" class="form-control mb-2" name="sectionTitle[]" value="' . $sectionTitle . '" placeholder="Section Title" required>
                                                                            <textarea class="form-control" name="sectionBody[]" rows="3" placeholder="Section Content" required>' . $sectionBody . '</textarea>
                                                                            <button type="button" class="btn btn-danger mt-2" onclick="removeSection(this)">Remove Section</button>
                                                                        </div>';
                                                                    }
                                                                } else {
                                                                    echo '<p>No sections available for this lesson.</p>';
                                                                }

                                                                echo '
                                                                <button type="button" class="btn btn-secondary mt-2" onclick="addSection()">Add New Section</button>
                                                            </div>
                                                        </div>

                                                        <!-- Modal Footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';

                                    
                                    // Delete Lesson Modal
                                    echo '
                                    <div class="modal fade" id="deleteLessonModal' . $lessonId . '" tabindex="-1" role="dialog" aria-labelledby="deleteLessonModalLabel' . $lessonId . '" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteLessonModalLabel' . $lessonId . '">Delete Lesson</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="delete_lesson.php" method="post">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="lesson_id" value="' . $lessonId . '">
                                                        <p>Are you sure you want to delete this lesson?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>';

                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
// Check if there's a success message in the URL
if (isset($_GET['message'])) {
    $success_message = htmlspecialchars($_GET['message']);
    echo '
    <div class="modal fade" id="successDeleteModal" tabindex="-1" role="dialog" aria-labelledby="successDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successDeleteModalLabel">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>' . $success_message . '</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>';
    // Automatically trigger the modal using JavaScript
    echo '<script>
        $(document).ready(function() {
            $("#successDeleteModal").modal("show");
        });
    </script>';
}
?>

<!-- Modal for Adding Lessons -->
<div class="modal fade" id="addLessonModal" tabindex="-1" role="dialog" aria-labelledby="addLessonModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLessonModalLabel">Add New Lesson</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="add_lesson.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="lessonTitle">Lesson Title</label>
                        <input type="text" class="form-control" id="lessonTitle" name="lessonTitle" required>
                    </div>
                    <div class="form-group">
                        <label for="lessonDescription">Description</label>
                        <textarea class="form-control" id="lessonDescription" name="lessonDescription" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Content Sections</label>
                        <div id="contentSections">
                            <div class="content-item mb-3">
                                <input type="text" class="form-control mb-2" name="contentTitle[]" placeholder="Section Title" required>
                                <textarea class="form-control" name="contentBody[]" rows="3" placeholder="Section Content"></textarea>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary mt-2" onclick="addSection()">Add New Section</button>
                    </div>

                    <!-- Virtual Lab Section -->
                    <div class="form-group">
                        <label>Include Virtual Labs</label>
                        <div id="virtualLabs">
                            <div class="virtual-lab-item mb-3" id="virtualLabItem_0">
                                <label>Virtual Lab Type</label>
                                <select class="form-control mb-2" name="virtualLabType[]" onchange="toggleLabInputFields(this)">
                                    <option value="" selected disabled>Choose an option</option>
                                    <option value="embedLink">Embedded Link</option>
                                    <option value="uploadFile">Upload Single File</option>
                                    <option value="uploadFolder">Upload Folder (as ZIP)</option>
                                </select>
                                <div class="embedLinkField" style="display: none;">
                                    <input type="url" class="form-control mb-2" name="virtualLabLink[]" placeholder="Enter the URL for the virtual lab">
                                </div>
                                <div class="uploadFileField" style="display: none;">
                                    <input type="file" class="form-control-file" name="virtualLabFile[]">
                                </div>
                                <div class="uploadFolderField" style="display: none;">
                                    <input type="file" class="form-control-file" name="virtualLabFolder[]" accept=".zip">
                                    <small class="form-text text-muted">Upload a ZIP archive containing all files (HTML, CSS, JS, etc.).</small>
                                </div>
                                <div class="launchFileField" style="display: none;">
                                    <label for="launchFile">Launch File</label>
                                    <input type="text" class="form-control mb-2" name="launchFile[]" placeholder="Enter the launch file (e.g., index.html, start.php)">
                                    <small class="form-text text-muted">Enter the name of the launch file inside the folder (e.g., index.html).</small>
                                </div>
                                <button type="button" class="btn btn-danger" onclick="removeVirtualLab(this)">Remove Virtual Lab</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary mt-2" onclick="addVirtualLab()">Add Another Virtual Lab</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Lesson</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal for Managing Virtual Labs -->
<div class="modal fade" id="manageVirtualLabsModal" tabindex="-1" role="dialog" aria-labelledby="manageVirtualLabsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageVirtualLabsModalLabel">Manage Virtual Labs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="manage_virtual_labs.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Dropdown for selecting a lesson -->
                    <div class="form-group">
                        <label for="lessonSelect">Select Lesson</label>
                        <select class="form-control" id="lessonSelect" name="lessonId" onchange="fetchVirtualLabsForLesson()">
                            <option value="" disabled selected>Select a Lesson</option>
                            <!-- Options will be dynamically loaded using JavaScript -->
                        </select>
                    </div>

                    <!-- Virtual Labs for selected lesson -->
                    <div class="form-group">
                        <label>Virtual Labs</label>
                        <div id="virtualLabsList">
                            <!-- Existing Virtual Labs for the selected lesson will be dynamically injected here -->
                        </div>
                        <!-- Initially hidden Add Virtual Lab button -->
                        <button type="button" class="btn btn-secondary mt-2" id="addVirtualLabButton" style="display:none;" onclick="manageVirtualLab()">Add Another Virtual Lab</button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


</div>


<!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="successMessage">
                <?php
                // Display success message from session if set
                if (isset($_SESSION['success_message'])) {
                    echo $_SESSION['success_message'];
                    unset($_SESSION['success_message']); // Clear the message after displaying it
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                        <div class="modal-body">Select "Logout" below to log out of your admin session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="logout_admin">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

<!-- Include TinyMCE CDN -->
<script src="https://cdn.tiny.cloud/1/avbaz0hs2mhpti4lpxuh1h2umxc5qs8nle34kqsdecuigzzq/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Initialize TinyMCE -->
<script>
// Initialize TinyMCE on page load
tinymce.init({
  selector: 'textarea', // Apply TinyMCE to all textarea elements
  plugins: [
    'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
    'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
    'importword', 'exportword', 'exportpdf'
  ],
  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
  tinycomments_mode: 'embedded',
  tinycomments_author: 'Author name',
  mergetags_list: [
    { value: 'First.Name', title: 'First Name' },
    { value: 'Email', title: 'Email' },
  ],
  // Image upload handling
  images_upload_url: 'upload_image.php',
  automatic_uploads: true,
  file_picker_types: 'image',

  images_upload_handler: function (success, failure) {
    const formData = new FormData();
    formData.append('file');

    fetch('upload_image.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.location) {
        // Insert image with fixed dimensions and centered alignment
        const styledImageHtml = `<img src="${data.location}" style="display: block; margin: 0 auto; width: 728px; height: 323px;" alt="Image">`;
        tinymce.activeEditor.insertContent(styledImageHtml);
        success(data.location);
      } else {
        failure("Error: " + (data.error || "Image upload failed"));
      }
    })
    .catch(error => failure("Error: " + error));
  },

  file_picker_callback: function (callback, value, meta) {
    var input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = function () {
      var file = input.files[0];
      
      var formData = new FormData();
      formData.append("file", file);
      
      fetch('upload_image.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.location) {
          // Insert image with fixed dimensions and center alignment
          callback(data.location, {
            alt: file.name
          });
          
          // Use a small timeout to ensure the image is inserted before applying the style
          setTimeout(() => {
            let images = tinymce.activeEditor.dom.select('img[src="' + data.location + '"]');
            images.forEach(img => {
              img.style.width = '728px';
              img.style.height = '323px';
              img.style.display = 'block';
              img.style.margin = '0 auto';
            });
          }, 100);
        } else {
          alert("Error uploading image: " + data.error);
        }
      })
      .catch(error => {
        alert("Error uploading image: " + error);
      });
    };
    input.click();
  },

  setup: function (editor) {
    // Apply default style to any image after inserting into the editor
    editor.on('NodeChange', function (e) {
      if (e.element.nodeName === 'IMG') {
        e.element.style.width = '728px';
        e.element.style.height = '323px';
        e.element.style.display = 'block';
        e.element.style.margin = '0 auto';
      }
    });
  }
});

// Function to add a new content section dynamically with TinyMCE support
function addSection() {
  const container = document.getElementById('contentSections');
  const newSection = document.createElement('div');
  newSection.classList.add('content-item', 'mb-3');
  newSection.innerHTML = `
    <input type="text" class="form-control mb-2" name="contentTitle[]" placeholder="Section Title" required>
    <textarea class="form-control" name="contentBody[]" rows="3" placeholder="Section Content" required></textarea>
  `;
  container.appendChild(newSection);

  // Initialize TinyMCE on the newly added textarea
  tinymce.init({
    selector: `textarea[name='contentBody[]']:last-of-type`, // Only initialize the last added textarea
    plugins: [
      'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
      'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
      'importword', 'exportword', 'exportpdf'
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    images_upload_url: 'upload_image.php',
    automatic_uploads: true,
    file_picker_types: 'image',
  });
}

// Open Edit Modal and populate with lesson data
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".edit-lesson-btn").forEach(button => {
    button.addEventListener("click", function() {
      const lessonId = this.getAttribute("data-id");
      const lessonTitle = this.getAttribute("data-title");
      const lessonDescription = this.getAttribute("data-description");
      const lessonContent = JSON.parse(this.getAttribute("data-content"));

      const editModal = document.getElementById(`editLessonModal${lessonId}`);
      editModal.querySelector(".editLessonId").value = lessonId;
      editModal.querySelector(".editLessonTitle").value = lessonTitle;
      editModal.querySelector(".editLessonDescription").value = lessonDescription;

      const contentSectionsContainer = editModal.querySelector("#contentSections");
      contentSectionsContainer.innerHTML = ''; // Clear existing sections

      lessonContent.forEach((section, index) => {
        const sectionHTML = `
          <div class="content-item mb-3">
            <input type="text" class="form-control mb-2" name="contentTitle[]" value="${section.section_title}" placeholder="Section Title" required>
            <textarea class="form-control" name="contentBody[]" rows="3" placeholder="Section Content">${section.section_body}</textarea>
          </div>
        `;
        contentSectionsContainer.insertAdjacentHTML('beforeend', sectionHTML);
      });

      // Initialize TinyMCE on all textareas in the modal
      tinymce.init({
        selector: `textarea[name='contentBody[]']:last-of-type`, // Only initialize the last added textarea
        plugins: [
          'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
          'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
          'importword', 'exportword', 'exportpdf'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
          { value: 'First.Name', title: 'First Name' },
          { value: 'Email', title: 'Email' },
        ],
        images_upload_url: 'upload_image.php',
        automatic_uploads: true,
        file_picker_types: 'image',
      });

      $(`#editLessonModal${lessonId}`).modal("show");
    });
  });

  document.querySelectorAll(".delete-lesson-btn").forEach(button => {
    button.addEventListener("click", function() {
      const lessonId = this.getAttribute("data-id");
      const deleteModal = document.getElementById(`deleteLessonModal${lessonId}`);
      deleteModal.querySelector(".deleteLessonId").value = lessonId;
      $(`#deleteLessonModal${lessonId}`).modal("show");
    });
  });
});
</script>

<script>
    function removeSection(button) {
        var sectionItem = button.closest('.content-item');
        sectionItem.remove();
    }
</script>

<script>
// Add a new virtual lab input set
function addVirtualLab() {
    const virtualLabsContainer = document.getElementById('virtualLabs');
    const index = virtualLabsContainer.children.length;
    
    // Create new virtual lab input fields
    const virtualLabDiv = document.createElement('div');
    virtualLabDiv.classList.add('virtual-lab-item', 'mb-3');
    virtualLabDiv.id = `virtualLabItem_${index}`;
    
    virtualLabDiv.innerHTML = `
        <label>Virtual Lab Type</label>
        <select class="form-control mb-2" name="virtualLabType[]" onchange="toggleLabInputFields(this)">
            <option value="" selected disabled>Choose an option</option>
            <option value="embedLink">Embedded Link</option>
            <option value="uploadFile">Upload Single File</option>
            <option value="uploadFolder">Upload Folder (as ZIP)</option>
        </select>
        <div class="embedLinkField" style="display: none;">
            <input type="url" class="form-control mb-2" name="virtualLabLink[]" placeholder="Enter the URL for the virtual lab">
        </div>
        <div class="uploadFileField" style="display: none;">
            <input type="file" class="form-control-file" name="virtualLabFile[]">
        </div>
        <div class="uploadFolderField" style="display: none;">
            <input type="file" class="form-control-file" name="virtualLabFolder[]" accept=".zip">
            <small class="form-text text-muted">Upload a ZIP archive containing all files (HTML, CSS, JS, etc.).</small>
        </div>
        <div class="launchFileField" style="display: none;">
            <label for="launchFile">Launch File</label>
            <input type="text" class="form-control mb-2" name="launchFile[]" placeholder="Enter the launch file (e.g., index.html, start.php)">
            <small class="form-text text-muted">Enter the name of the launch file inside the folder (e.g., index.html).</small>
        </div>
        <button type="button" class="btn btn-danger" onclick="removeVirtualLab(this)">Remove Virtual Lab</button>
    `;
    
    // Append the new virtual lab fields
    virtualLabsContainer.appendChild(virtualLabDiv);
}

// Remove a virtual lab input set
function removeVirtualLab(button) {
    button.closest('.virtual-lab-item').remove();
}

// Toggle visibility of fields based on selected virtual lab type
function toggleLabInputFields(selectElement) {
    const selectedValue = selectElement.value;
    const virtualLabItem = selectElement.closest('.virtual-lab-item');
    
    // Hide all lab input fields
    virtualLabItem.querySelector('.embedLinkField').style.display = 'none';
    virtualLabItem.querySelector('.uploadFileField').style.display = 'none';
    virtualLabItem.querySelector('.uploadFolderField').style.display = 'none';
    virtualLabItem.querySelector('.launchFileField').style.display = 'none';

    // Show the appropriate input field
    if (selectedValue === 'embedLink') {
        virtualLabItem.querySelector('.embedLinkField').style.display = 'block';
    } else if (selectedValue === 'uploadFile') {
        virtualLabItem.querySelector('.uploadFileField').style.display = 'block';
    } else if (selectedValue === 'uploadFolder') {
        virtualLabItem.querySelector('.uploadFolderField').style.display = 'block';
        virtualLabItem.querySelector('.launchFileField').style.display = 'block'; // Show launch file input for folder
    }
}
</script>

<script>
// Function to create and manage a new virtual lab setup
function manageVirtualLab() {
    const labsContainer = document.getElementById('virtualLabsList');
    const labIndex = labsContainer.children.length; // Get current number of virtual labs

    // Create a new div container for this virtual lab
    const newLabDiv = document.createElement('div');
    newLabDiv.classList.add('virtual-lab-item', 'mb-3');
    newLabDiv.id = `virtualLab_${labIndex}`;

    // Define the HTML content for the new virtual lab fields
    newLabDiv.innerHTML = `
        <label>Virtual Lab Type</label>
        <select class="form-control mb-2" name="virtualLabType[]" onchange="manageLabInputFields(this)">
            <option value="" selected disabled>Choose an option</option>
            <option value="embedLink">Embedded Link</option>
            <option value="uploadFile">Upload Single File</option>
            <option value="uploadFolder">Upload Folder (ZIP)</option>
        </select>
        
        <!-- Embedded Link Input (Initially hidden) -->
        <div class="embedLinkField" style="display: none;">
            <input type="url" class="form-control mb-2" name="virtualLabLink[]" placeholder="Enter URL for the virtual lab">
        </div>
        
        <!-- Upload File Input (Initially hidden) -->
        <div class="uploadFileField" style="display: none;">
            <input type="file" class="form-control-file" name="virtualLabFile[]">
        </div>
        
        <!-- Upload Folder Input (Initially hidden) -->
        <div class="uploadFolderField" style="display: none;">
            <input type="file" class="form-control-file" name="virtualLabFolder[]" accept=".zip">
            <small class="form-text text-muted">Upload a ZIP file (HTML, CSS, JS, etc.).</small>
        </div>
        
        <!-- Launch File for Folder (Initially hidden) -->
        <div class="launchFileField" style="display: none;">
            <label for="launchFile">Launch File</label>
            <input type="text" class="form-control mb-2" name="launchFile[]" placeholder="Enter launch file (e.g., index.html)">
            <small class="form-text text-muted">Enter the name of the launch file inside the folder (e.g., index.html).</small>
        </div>
        
        <!-- Remove Virtual Lab Button -->
        <button type="button" class="btn btn-danger" onclick="removeVirtualLabSetup(this)">Remove Virtual Lab</button>
    `;
    
    // Append the new virtual lab form to the container
    labsContainer.appendChild(newLabDiv);
}

// Function to remove a virtual lab setup
function removeVirtualLabSetup(button) {
    button.closest('.virtual-lab-item').remove();
}

// Function to manage the visibility of input fields based on the selected lab type
function manageLabInputFields(selectElement) {
    const selectedType = selectElement.value;
    const labItem = selectElement.closest('.virtual-lab-item');
    
    // Hide all input fields first
    labItem.querySelector('.embedLinkField').style.display = 'none';
    labItem.querySelector('.uploadFileField').style.display = 'none';
    labItem.querySelector('.uploadFolderField').style.display = 'none';
    labItem.querySelector('.launchFileField').style.display = 'none';

    // Display the appropriate input fields based on the selected option
    switch (selectedType) {
        case 'embedLink':
            labItem.querySelector('.embedLinkField').style.display = 'block';
            break;
        case 'uploadFile':
            labItem.querySelector('.uploadFileField').style.display = 'block';
            break;
        case 'uploadFolder':
            labItem.querySelector('.uploadFolderField').style.display = 'block';
            labItem.querySelector('.launchFileField').style.display = 'block'; // Show launch file field for folder
            break;
        default:
            break;
    }
}

// Function to load lessons into the select dropdown
function loadLessons() {
    // Fetch lessons from the server
    fetch('fetch_lessons.php')
        .then(response => response.json())
        .then(data => {
            const lessonSelect = document.getElementById('lessonSelect');
            lessonSelect.innerHTML = '';  // Clear any existing options

            // Create a default "Select a Lesson" option
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.text = 'Select a Lesson';
            lessonSelect.appendChild(defaultOption);

            // Populate the dropdown with lessons
            data.forEach(lesson => {
                const option = document.createElement('option');
                option.value = lesson.id;  // The lesson ID
                option.text = lesson.title; // The lesson name
                lessonSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error loading lessons:', error);
        });
}

// Function to handle the selection of a lesson
function setLessonId() {
    const lessonSelect = document.getElementById('lessonSelect');
    const lessonId = lessonSelect.value;

    // Set the lesson ID in the form or hidden field
    document.getElementById('lessonIdInput').value = lessonId;

    // Update the modal title dynamically based on lesson ID
    const lessonName = lessonSelect.options[lessonSelect.selectedIndex].text;
    document.getElementById('manageVirtualLabsModalLabel').innerText = `Manage Virtual Labs for ${lessonName}`;

    // Show the virtual labs section after selecting a lesson
    const virtualLabsSection = document.getElementById('virtualLabsSection');
    virtualLabsSection.style.display = (lessonId) ? 'block' : 'none';  // Show if a lesson is selected, otherwise keep it hidden

    // Fetch virtual labs for the selected lesson (optional)
    if (lessonId) {
        fetchVirtualLabs(lessonId);
    }
}

// Function to fetch virtual labs for a specific lesson
function fetchVirtualLabs(lessonId) {
    // Use the lesson ID to fetch virtual labs related to that lesson from the server
    fetch('fetch_virtual_labs.php?lessonId=' + lessonId)
        .then(response => response.json())
        .then(data => {
            const labsContainer = document.getElementById('virtualLabsList');
            labsContainer.innerHTML = ''; // Clear any existing virtual labs

            // If there are virtual labs, populate the list
            if (data.virtualLabs && data.virtualLabs.length > 0) {
                data.virtualLabs.forEach(lab => {
                    const labDiv = document.createElement('div');
                    labDiv.classList.add('virtual-lab-item', 'mb-3');
                    labDiv.innerHTML = `
                        <label>Virtual Lab Type</label>
                        <select class="form-control mb-2" name="virtualLabType[]" onchange="manageLabInputFields(this)">
                            <option value="embedLink" ${lab.lab_type === 'embedLink' ? 'selected' : ''}>Embedded Link</option>
                            <option value="uploadFile" ${lab.lab_type === 'uploadFile' ? 'selected' : ''}>Upload Single File</option>
                            <option value="uploadFolder" ${lab.lab_type === 'uploadFolder' ? 'selected' : ''}>Upload Folder (ZIP)</option>
                        </select>
                        
                        <!-- Embedded Link Input -->
                        <div class="embedLinkField" style="${lab.lab_type === 'embedLink' ? 'display:block;' : 'display:none;'}">
                            <input type="url" class="form-control mb-2" name="virtualLabLink[]" value="${lab.lab_data}" placeholder="Enter URL for the virtual lab">
                        </div>
                        
                        <!-- Upload File Input -->
                        <div class="uploadFileField" style="${lab.lab_type === 'uploadFile' ? 'display:block;' : 'display:none;'}">
                            <input type="file" class="form-control-file" name="virtualLabFile[]">
                        </div>
                        
                        <!-- Upload Folder Input -->
                        <div class="uploadFolderField" style="${lab.lab_type === 'uploadFolder' ? 'display:block;' : 'display:none;'}">
                            <input type="file" class="form-control-file" name="virtualLabFolder[]" accept=".zip">
                            <small class="form-text text-muted">Upload a ZIP file (HTML, CSS, JS, etc.).</small>
                        </div>
                        
                        <!-- Launch File Input for Folder -->
                        <div class="launchFileField" style="${lab.lab_type === 'uploadFolder' ? 'display:block;' : 'display:none;'}">
                            <label for="launchFile">Launch File</label>
                            <input type="text" class="form-control mb-2" name="launchFile[]" value="${lab.launch_file}" placeholder="Enter launch file (e.g., index.html)">
                            <small class="form-text text-muted">Enter the name of the launch file inside the folder (e.g., index.html).</small>
                        </div>
                        
                        <!-- Remove Virtual Lab Button -->
                        <button type="button" class="btn btn-danger" onclick="removeVirtualLabSetup(this)">Remove Virtual Lab</button>
                    `;
                    labsContainer.appendChild(labDiv);
                });
            }

            // Ensure "Add Virtual Lab" button is visible after loading (or if no virtual labs)
            document.getElementById('addVirtualLabButton').style.display = 'block';
        })
        .catch(error => {
            console.error('Error fetching virtual labs:', error);
        });
}

// Function to handle the lesson selection and show virtual lab management options
function fetchVirtualLabsForLesson() {
    const lessonId = document.getElementById('lessonSelect').value;

    // If a lesson is selected, show the Add Virtual Lab button
    if (lessonId) {
        // Make sure the "Add Virtual Lab" button is visible
        document.getElementById('addVirtualLabButton').style.display = 'block';

        // Fetch the virtual labs for the selected lesson
        fetchVirtualLabs(lessonId);
    } else {
        // If no lesson is selected, hide the virtual labs section and the "Add Virtual Lab" button
        document.getElementById('virtualLabsList').innerHTML = '';
        document.getElementById('addVirtualLabButton').style.display = 'none';
    }
}

// Ensure lessons are loaded when the modal is opened
$('#manageVirtualLabsModal').on('show.bs.modal', function () {
    loadLessons();
});
</script>


<script>
// Check if the success modal should be shown on page load
$(document).ready(function() {
    // Display modal if the success message exists
    if ($('#successMessage').text().trim() !== '') {
        $('#successModal').modal('show');
    }
});
</script>

</body>

</html>