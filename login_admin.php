<?php
// Start session
session_start();

// Include database configuration
require_once "config.php";

// Define variables and initialize with empty values
$admin_login = $admin_password = "";
$admin_login_err = $admin_password_err = $login_err = "";

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate admin login (username only)
    if (empty(trim($_POST["admin_login"]))) {
        $admin_login_err = "Please enter your username.";
    } else {
        $admin_login = trim($_POST["admin_login"]);
    }

    // Validate password
    if (empty(trim($_POST["admin_password"]))) {
        $admin_password_err = "Please enter your password.";
    } else {
        $admin_password = trim($_POST["admin_password"]);
    }

    // Validate credentials if no errors
    if (empty($admin_login_err) && empty($admin_password_err)) {
        // Prepare SQL statement
        $sql = "SELECT id, username, password FROM admin WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement
            mysqli_stmt_bind_param($stmt, "s", $param_admin_login);

            // Set parameters
            $param_admin_login = $admin_login;

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if admin exists
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

                    if (mysqli_stmt_fetch($stmt)) {
                        // Debugging: Show the hashed password
                        echo "Hashed Password from DB: " . $hashed_password . "<br>";

                        // Verify password
                        if (password_verify($admin_password, $hashed_password)) {
                            // Debugging: Success message
                            echo "Password verified successfully for user: " . $username . "<br>";

                            // Password is correct, start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin_admin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect to admin dashboard
                            header("location: admin/index.php");
                            exit;
                        } else {
                            // Invalid password
                            $login_err = "Invalid username or password.";
                            echo "Invalid password attempt for user: " . $admin_login . "<br>";
                        }
                    }
                } else {
                    // Admin not found
                    $login_err = "Invalid username or password.";
                    echo "Admin user not found: " . $admin_login . "<br>";
                }
            } else {
                // Error with SQL execution
                echo "Error executing the SQL statement: " . mysqli_error($link) . "<br>";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close database connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-prep | Teacher Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body style="background: url('img/siena-building.png') no-repeat center center; background-size: cover; height: 100vh;" class="d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image" 
                   style="background: url('img/e-prep-logo.png') no-repeat center center; background-color: #f0f0f0;">
              </div>
              <div class="col-lg-6" style="background-color: #f0f0f0;">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Admin Login</h1>
                  </div>

                  <!-- Show errors on the page -->
                  <?php if (!empty($login_err)): ?>
                    <div class="alert alert-danger"><?= $login_err; ?></div>
                  <?php endif; ?>

                  <!-- Admin login form starts here -->
                  <form class="user" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
                    <div class="form-group">
                      <label for="admin_login" class="form-label">Username</label>
                      <input type="text" name="admin_login" class="form-control form-control-user" id="admin_login" 
                             placeholder="Enter Username..." value="<?= htmlspecialchars($admin_login); ?>">
                      <small class="text-danger"><?= $admin_login_err; ?></small>
                    </div>
                    <div class="form-group">
                      <label for="admin_password" class="form-label">Password</label>
                      <input type="password" name="admin_password" class="form-control form-control-user" id="admin_password" 
                             placeholder="Password">
                      <small class="text-danger"><?= $admin_password_err; ?></small>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <input type="submit" class="btn btn-danger btn-user btn-block" name="submit" value="Log In">
                  </form>
                  <!-- Admin login form ends here -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
