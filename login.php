<?php
// Start session
session_start();

// Check if user is already logged in, If yes then redirect to dashboard
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    echo "<script>window.location.href='user/dashboard.php'</script>";
    exit;
}

// Include connection
require_once "config.php";

// Define variables and initialize with empty values
$user_login_err = $user_password_err = $login_err = "";
$user_login = $user_password = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate user login (username or email)
    if (empty(trim($_POST["user_login"]))) {
        $user_login_err = "Please enter your username or email.";
    } else {
        $user_login = trim($_POST["user_login"]);
    }

    // Validate password
    if (empty(trim($_POST["user_password"]))) {
        $user_password_err = "Please enter your password.";
    } else {
        $user_password = trim($_POST["user_password"]);
    }

    // Validate credentials 
    if (empty($user_login_err) && empty($user_password_err)) {
        // Prepare SQL query to check if username/email exists
        $sql = "SELECT id, username, email, student_number, last_name, first_name, password FROM users WHERE username = ? OR email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $param_user_login, $param_user_login);

            $param_user_login = $user_login;

            // Execute the query
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                // Check if user exists
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $email, $student_number, $last_name, $first_name, $hashed_password);

                    // Fetch the result
                    if (mysqli_stmt_fetch($stmt)) {
                        // Verify the password
                        if (password_verify($user_password, $hashed_password)) {
                            // Password is correct, start a new session
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["email"] = $email;
                            $_SESSION["last_name"] = $last_name;
                            $_SESSION["first_name"] = $first_name;
                            $_SESSION["student_number"] = $student_number;
                            $_SESSION["loggedin"] = true;

                            // Log the login attempt
                            $login_time = date("Y-m-d H:i:s");
                            $log_sql = "INSERT INTO user_logins (user_id, login_time) VALUES (?, ?)";
                            if ($log_stmt = mysqli_prepare($link, $log_sql)) {
                                mysqli_stmt_bind_param($log_stmt, "is", $id, $login_time);
                                mysqli_stmt_execute($log_stmt);
                                mysqli_stmt_close($log_stmt);
                            }

                            // Redirect to the dashboard
                            echo "<script>window.location.href='user/dashboard.php'</script>";
                            exit;
                        } else {
                            $login_err = "The password you entered is incorrect.";
                        }
                    }
                } else {
                    $login_err = "Invalid username or email.";
                }
            } else {
                echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Prep Student Login</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body style="background: url('img/siena-building.png') no-repeat center center; background-size: cover;height: 100vh;" class="d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image" 
                        style="background: url('img/e-prep-logo.png') no-repeat center center; background-color: #f0f0f0; "></div>
                            <div class="col-lg-6" style="background-color: #f0f0f0;">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?php if (!empty($login_err)): ?>
                                        <div class="alert alert-danger"><?= $login_err; ?></div>
                                    <?php endif; ?>
                                    <form class="user" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <div class="form-group">
                                            <input type="text" name="user_login" class="form-control form-control-user" placeholder="Enter Email Address or Username..." value="<?= htmlspecialchars($user_login); ?>">
                                            <small class="text-danger"><?= $user_login_err; ?></small>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="user_password" class="form-control form-control-user" placeholder="Password">
                                            <small class="text-danger"><?= $user_password_err; ?></small>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot_password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account</a>
                                    </div>
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
