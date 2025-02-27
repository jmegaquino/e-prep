<?php
# Initialize the session
session_start();

// Check if the admin user is logged in
if (empty($_SESSION["loggedin_admin"]) || $_SESSION["loggedin_admin"] !== TRUE) {
    // Redirect to the admin login page if not logged in
    echo "<script>window.location.href='../login_admin';</script>";
    exit;
}
// index.php (main page)
include '../config.php';


$sql = "SELECT * FROM assessments";
$result = mysqli_query($link, $sql);

if (!$result) {
    die("Error fetching assessments: " . mysqli_error($link));
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

    <title>Assessment Management - E-Prep</title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">



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
    <h1 class="h3 mb-2 text-gray-800">Assessment Management</h1>

    <!-- Assessment Table -->
    <div class="card shadow mb-4">
        <!-- Add New Assessment Button -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <a href="#" class="btn btn-primary btn-sm btn-icon-split" data-toggle="modal" data-target="#addAssessmentModal">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Add New Assessment</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Assessment Code</th> <!-- 'Assessment Code' as an alternative for ID -->
                    <th>Assessment Name</th> <!-- 'Name' for Title -->
                    <th>Details</th> <!-- 'Details' instead of Description -->
                    <th>Deadline</th> <!-- 'Deadline' instead of Due Date -->
                    <th>Options</th> <!-- 'Options' as a more general label for Actions -->
                </tr>
            </thead>
                <tbody>
                <?php
    // Loop through each assessment record
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['assessment_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
        echo "<td>" . htmlspecialchars($row['due_date']) . "</td>";
        echo "<td>
                <div class='d-flex justify-content-center align-items-center'>
                    <!-- Edit Button -->
                    <button 
                        class='btn btn-info btn-sm edit-btn' 
                        data-toggle='modal' 
                        data-target='#editAssessmentModal'
                        data-id='{$row['id']}'
                        data-title='{$row['title']}'
                        data-description='{$row['description']}'
                        data-due-date='{$row['due_date']}'
                        data-time-duration='{$row['time_duration']}'
                        data-lesson-id='{$row['lesson_id']}'
                        data-num-questions='{$row['num_questions']}'>
                        <i class='fas fa-edit'></i>
                    </button>

                    <!-- Eye Button -->
                    <span class='mx-2'>|</span>
                    <button class='btn btn-warning btn-sm view-btn' data-assessment_id='{$row['assessment_id']}'>
                        <i class='fas fa-eye'></i>
                    </button>

                    <!-- Delete Button -->
                    <span class='mx-2'>|</span>
                    <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['id']}'>
                        <i class='fas fa-trash'></i>
                    </button>
                </div>
            </td>";
        echo "</tr>";
    }
?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<!-- Add New Assessment Modal -->
<div class="modal fade" id="addAssessmentModal" tabindex="-1" role="dialog" aria-labelledby="addAssessmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- Large modal -->
        <form method="POST" action="add_assessment.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAssessmentModalLabel">Add New Assessment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Select Lesson -->
                    <div class="form-group">
                        <label for="lesson_id">Select Lesson</label>
                        <select name="lesson_id" class="form-control" required>
                            <option value="">Select a lesson</option>
                            <?php
                            include '../config.php';
                            $sql = "SELECT * FROM lessons";
                            $result = mysqli_query($link, $sql);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['id']}'>{$row['title']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Assessment Title -->
                    <div class="form-group">
                        <label for="title">Assessment Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <!-- Assessment Description -->
                    <div class="form-group">
                        <label for="description">Assessment Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                    </div>

                    <!-- Due Date -->
                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input type="date" name="due_date" id="due_date" class="form-control" required>
                    </div>

                    <!-- Time Duration -->
                    <div class="form-group">
                        <label for="time_duration">Time Duration (in minutes)</label>
                        <input type="number" name="time_duration" id="time_duration" class="form-control" required>
                    </div>

                    <!-- Number of Questions -->
                    <div class="form-group">
                        <label for="num_questions">Number of Questions</label>
                        <input type="number" name="num_questions" id="num_questions" class="form-control" min="1" required>
                    </div>

                    <!-- Questions and Choices Table -->
                    <div class="form-group">
                        <label>Questions and Choices</label>
                        <table class="table table-bordered" id="questionsTable">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Choices</th>
                                    <th>Correct Answer</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="questionRows">
                                <!-- Dynamic rows will be added here -->
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary" onclick="addQuestionRow()">Add Question</button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Assessment</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Assessment Modal -->
<div class="modal fade" id="editAssessmentModal" tabindex="-1" role="dialog" aria-labelledby="editAssessmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="editAssessmentForm" method="POST" action="edit_assessment.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAssessmentModalLabel">Edit Assessment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Hidden Assessment ID -->
                    <input type="hidden" name="id" id="edit-assessment-id">

                    <!-- Select Lesson -->
                    <div class="form-group">
                        <label for="lesson_id">Select Lesson</label>
                        <select name="lesson_id" id="lesson_id" class="form-control" >
                            <option value="" disabled selected>Select a lesson</option>
                            <?php
                            $sql = "SELECT * FROM lessons";
                            $result = mysqli_query($link, $sql);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['id']}'>{$row['title']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Assessment Title -->
                    <div class="form-group">
                        <label for="title">Assessment Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter assessment title" >
                    </div>

                    <!-- Assessment Description -->
                    <div class="form-group">
                        <label for="description">Assessment Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter a brief description of the assessment" ></textarea>
                    </div>

                    <!-- Due Date -->
                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input type="date" name="due_date" id="due_date" class="form-control" >
                    </div>

                    <!-- Time Duration -->
                    <div class="form-group">
                        <label for="time_duration">Time Duration (in minutes)</label>
                        <input type="number" name="time_duration" id="time_duration" class="form-control" placeholder="e.g., 30" min="1" >
                    </div>

                    <!-- Number of Questions -->
                    <div class="form-group">
                        <label for="num_questions">Number of Questions</label>
                        <input type="number" name="num_questions" id="num_questions" class="form-control" placeholder="e.g., 10" min="1" >
                    </div>

                    <!-- Questions and Choices Section -->
                    <div class="form-group">
                        <label>Questions and Choices</label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Choices</th>
                                    <th>Correct Answer</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="questionRows">
                                <!-- Questions will be dynamically populated here -->
                            </tbody>
                        </table>

                        <!-- Add Question Button -->
                        <button type="button" id="addQuestion" class="btn btn-primary">Add Question</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal for Previewing Assessment -->
<div class="modal fade" id="previewAssessmentModal" tabindex="-1" role="dialog" aria-labelledby="previewAssessmentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="previewAssessmentModalLabel">Assessment Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="assessmentDetails">
          <!-- Assessment details (Title, Description) -->
        </div>
        <div id="questionsList">
          <!-- Questions will be dynamically populated here -->
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Delete Assessment Modal -->
<div class="modal fade" id="deleteAssessmentModal" tabindex="-1" role="dialog" aria-labelledby="deleteAssessmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="delete_assessment.php">
            <input type="hidden" name="id" id="delete-assessment-id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAssessmentModalLabel">Delete Assessment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this assessment?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>


</div>
<!-- /.container-fluid -->

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

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Success Message Modal -->
<div class="modal fade" id="successMessageModal" tabindex="-1" role="dialog" aria-labelledby="successMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successMessageModalLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="successMessageText"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Error Message Modal -->
<div class="modal fade" id="errorMessageModal" tabindex="-1" role="dialog" aria-labelledby="errorMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorMessageModalLabel">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="errorMessageText"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
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
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

<script>
$(document).ready(function() {
    // Function to check for duplicates
    function checkDuplicates(form, callback) {
        const data = {
            student_number: form.find('[name="student_number"]').val(),
            username: form.find('[name="username"]').val(),
            email: form.find('[name="email"]').val(),
            id: form.find('[name="id"]').val() // Only for edit
        };

        $.post('check_duplicates.php', data, function(response) {
            if (response.exists) {
                // Show error message if a duplicate is found
                form.find(`input[name="${response.field}"]`).addClass('is-invalid');
                form.find(`.${response.field}-error`).text(`${response.field.replace('_', ' ')} already exists.`);
                callback(false);
            } else {
                // Clear previous errors
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.error-message').text('');
                callback(true);
            }
        }, 'json');
    }

    // Attach submit handler to Add and Edit forms
    $('#addUserModal form, #editUserModal form').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        const form = $(this);

        checkDuplicates(form, function(isValid) {
            if (isValid) {
                form.off('submit').submit(); // Submit the form if no duplicates are found
            }
        });
    });
});
</script>

<!-- JavaScript to handle dynamic question and choice addition -->
<script>
// Function to add a question row
function addQuestionRow() {
    const numQuestions = parseInt(document.getElementById('num_questions').value);
    const table = document.getElementById('questionRows');
    const rowCount = table.rows.length;

    if (rowCount >= numQuestions) {
        alert('You can only add ' + numQuestions + ' questions.');
        return; // Prevent adding more rows
    }

    const row = table.insertRow(rowCount);

    // Question input
    const cell1 = row.insertCell(0);
    cell1.innerHTML = `<input type="text" name="questions[]" class="form-control" placeholder="Enter question" required>`;

    // Choices inputs in one column
    const cell2 = row.insertCell(1);
    cell2.innerHTML = `
        <div>
            <label>A:</label>
            <input type="text" name="choices[${rowCount}][A]" class="form-control my-1" placeholder="Choice A" required>
            <label>B:</label>
            <input type="text" name="choices[${rowCount}][B]" class="form-control my-1" placeholder="Choice B" required>
            <label>C:</label>
            <input type="text" name="choices[${rowCount}][C]" class="form-control my-1" placeholder="Choice C" required>
            <label>D:</label>
            <input type="text" name="choices[${rowCount}][D]" class="form-control my-1" placeholder="Choice D" required>
        </div>
    `;

    // Correct Answer dropdown
    const cell3 = row.insertCell(2);
    cell3.innerHTML = `
        <select name="correct_answers[]" class="form-control" required>
            <option value="">Select correct answer</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select>
    `;

    // Actions
    const cell4 = row.insertCell(3);
    cell4.innerHTML = `<button type="button" class="btn btn-danger" onclick="removeQuestionRow(this)">Remove</button>`;
}

// Function to remove a question row
function removeQuestionRow(button) {
    const row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}
</script>

<script>
$('#editAssessmentModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget); // Button that triggered the modal
    const assessmentId = button.data('id'); // Extract assessment ID from data attribute

    // Clear the modal fields
    $('#editAssessmentForm')[0].reset();
    $('#questionRows').empty();

    // Fetch data for the selected assessment
    $.ajax({
        url: 'get_assessment_data.php',
        method: 'GET',
        data: { id: assessmentId },
        dataType: 'json',
        success: function (response) {
            if (response.error) {
                alert(response.error);
                return;
            }

            // Populate assessment details
            const assessment = response.assessment;
            $('#edit-assessment-id').val(assessment.id);
            $('#lesson_id').val(assessment.lesson_id);
            $('#title').val(assessment.title);
            $('#description').val(assessment.description);
            $('#due_date').val(assessment.due_date);
            $('#time_duration').val(assessment.time_duration);
            $('#num_questions').val(assessment.num_questions);

            // Populate questions if available
            if (response.questions && response.questions.length > 0) {
                response.questions.forEach(question => {
                    $('#questionRows').append(`
                        <tr>
                            <td><input type="text" name="questions[]" class="form-control" value="${question.question}" required></td>
                            <td>
                                <input type="text" name="choices_A[]" class="form-control" value="${question.choice_A}" required>
                                <input type="text" name="choices_B[]" class="form-control" value="${question.choice_B}" required>
                                <input type="text" name="choices_C[]" class="form-control" value="${question.choice_C}" required>
                                <input type="text" name="choices_D[]" class="form-control" value="${question.choice_D}" required>
                            </td>
                            <td><input type="text" name="correct_answers[]" class="form-control" value="${question.correct_answer}" required></td>
                            <td><button type="button" class="btn btn-danger btn-sm removeQuestion">Remove</button></td>
                        </tr>
                    `);
                });
            } else {
                $('#questionRows').append('<tr><td colspan="4" class="text-center">No questions found. Add new ones!</td></tr>');
            }
        },
        error: function () {
            alert('Failed to fetch data. Please try again.');
        }
    });
});

// Handle dynamic removal of questions
$(document).on('click', '.removeQuestion', function () {
    $(this).closest('tr').remove();
});

</script>

<script>
$(document).on('click', '.view-btn', function() {
    var assessmentId = $(this).data('assessment_id'); // Get the correct assessment ID
    console.log("Assessment ID:", assessmentId); // Log the ID to check its value

    // Ensure the assessment ID is a valid integer
    if (isNaN(assessmentId) || assessmentId <= 0) {
        alert("Invalid assessment ID");
        return;
    }

    // AJAX request to fetch assessment details and questions
    $.ajax({
        url: 'fetch_assessment_details.php',
        type: 'GET',
        data: { assessment_id: assessmentId },
        success: function(response) {
            console.log(response); // Log the response to see the returned data

            var data = JSON.parse(response);
            if (data.error) {
                alert(data.error); // If no data found, show an alert
            } else {
                // Populate assessment details
                var assessmentDetails = `
                    <h4>${data.title}</h4>
                    <p><strong>Description:</strong> ${data.description || 'No description available'}</p>
                    <p><strong>Due Date:</strong> ${data.due_date || 'Not specified'}</p>
                    <p><strong>Time Duration:</strong> ${data.time_duration || 'Not specified'}</p>
                    <p><strong>Number of Questions:</strong> ${data.num_questions || 'N/A'}</p>
                `;
                $('#assessmentDetails').html(assessmentDetails);

                // Prepare questions list
                var questionsList = '<ul>';
                if (data.questions.length > 0) {
                    data.questions.forEach(function(question) {
                        questionsList += `
                            <li>
                                <p><strong>Question:</strong> ${question.question}</p>
                                <ul>
                                    <li><strong>A)</strong> ${question.choice_A}</li>
                                    <li><strong>B)</strong> ${question.choice_B}</li>
                                    <li><strong>C)</strong> ${question.choice_C}</li>
                                    <li><strong>D)</strong> ${question.choice_D}</li>
                                </ul>
                                <p><strong>Correct Answer:</strong> ${question.correct_answer}</p>
                            </li>
                        `;
                    });
                } else {
                    questionsList += '<li>No questions available.</li>';
                }
                questionsList += '</ul>';

                $('#questionsList').html(questionsList);
                $('#previewAssessmentModal').modal('show');
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: ", status, error);
            alert("An error occurred while fetching assessment details.");
        }
    });
});
</script>


</body>


</html>