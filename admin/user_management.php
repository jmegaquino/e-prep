<?php
# Initialize the session
session_start();

// Check if the admin user is logged in
if (empty($_SESSION["loggedin_admin"]) || $_SESSION["loggedin_admin"] !== TRUE) {
    // Redirect to the admin login page if not logged in
    echo "<script>window.location.href='../login_admin';</script>";
    exit;
}

// Include your database connection file
include '../config.php'; // replace with your actual database connection file

// Fetch user data from the database
$query = "SELECT * FROM users";
$result = mysqli_query($link, $query);
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Management - E-Prep</title>

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
    <h1 class="h3 mb-2 text-gray-800">User Management</h1>

    <!-- User Table -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="btn-group">
                <!-- Add User Button -->
                <a href="#" class="btn btn-primary btn-sm btn-icon-split" data-toggle="modal" data-target="#addUserModal">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add User</span>
                </a>

                <!-- Add Admin User Button with margin-left -->
                <a href="#" class="btn btn-success btn-sm btn-icon-split ml-2" data-toggle="modal" data-target="#addAdminUserModal">
                    <span class="icon text-white-50">
                        <i class="fa fa-user-shield"></i>
                    </span>
                    <span class="text">Add Admin User</span>
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Student No.</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Reg Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Loop through each user record
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['student_number']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['reg_date']) . "</td>";
                        echo "<td>
                                <div class='d-flex align-items-center'>
                                    <!-- Edit Button with Icon -->
                                    <button class='btn btn-info btn-sm edit-btn' data-toggle='modal' data-target='#editUserModal' data-id='{$row['id']}' data-student-number='{$row['student_number']}' data-last-name='{$row['last_name']}' data-first-name='{$row['first_name']}' data-username='{$row['username']}' data-email='{$row['email']}'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    
                                    <!-- Divider -->
                                    <span class='mx-2'>|</span>
                                    
                                    <!-- Delete Button with Icon -->
                                    <button class='btn btn-danger btn-sm delete-btn' data-toggle='modal' data-target='#deleteUserModal' data-id='{$row['id']}'>
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

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="add_user.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Student Number</label>
                        <input type="text" name="student_number" class="form-control" 
                               maxlength="10" minlength="10" 
                               pattern="\d{10}" 
                               oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                               required>
                        <small class="form-text text-muted">Student number must be exactly 10 digits.</small>
                        <div class="invalid-feedback student_number-error error-message"></div>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                        <div class="invalid-feedback username-error error-message"></div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                        <div class="invalid-feedback email-error error-message"></div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="edit_user.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-user-id">
                    <div class="form-group">
                        <label>Student Number</label>
                        <input type="text" name="student_number" id="edit-student-number" class="form-control" 
                               maxlength="10" minlength="10" 
                               pattern="\d{10}" 
                               oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                               required>
                        <small class="form-text text-muted">Student number must be exactly 10 digits.</small>
                        <div class="invalid-feedback student_number-error error-message"></div>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" id="edit-last-name" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" id="edit-first-name" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" id="edit-username" class="form-control" >
                        <div class="invalid-feedback username-error error-message"></div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="edit-email" class="form-control">
                        <div class="invalid-feedback email-error error-message"></div>
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

<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="delete_user.php">
            <input type="hidden" name="id" id="delete-user-id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Add Admin User Modal -->
<div class="modal fade" id="addAdminUserModal" tabindex="-1" aria-labelledby="addAdminUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="add_admin_user.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdminUserModalLabel">Add New Admin User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- Username Field -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" required>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add Admin</button>
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
    // Fill Edit Modal with data
    $(document).on('click', '.edit-btn', function() {
        $('#edit-user-id').val($(this).data('id'));
        $('#edit-student-number').val($(this).data('student-number'));
        $('#edit-last-name').val($(this).data('last-name'));
        $('#edit-first-name').val($(this).data('first-name'));
        $('#edit-username').val($(this).data('username'));
        $('#edit-email').val($(this).data('email'));
    });

    // Set Delete Modal ID
    $(document).on('click', '.delete-btn', function() {
        $('#delete-user-id').val($(this).data('id'));
    });
</script>

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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const urlParams = new URLSearchParams(window.location.search);

        if (urlParams.has('message')) {
            const message = urlParams.get('message');
            document.getElementById('successMessageText').textContent = message;
            $('#successMessageModal').modal('show');
        }

        if (urlParams.has('error')) {
            const error = urlParams.get('error');
            document.getElementById('errorMessageText').textContent = error;
            $('#errorMessageModal').modal('show');
        }
    });
</script>



    

</body>


</html>