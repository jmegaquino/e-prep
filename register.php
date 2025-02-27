<?php
# Include connection
require_once "config.php";
require 'vendor/autoload.php'; // Include PHPMailer autoload file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

# Define variables and initialize with empty values
$username_err = $email_err = $password_err = $confirm_password_err = $student_number_err = $last_name_err = $first_name_err = "";

$username = $email = $password = $confirm_password = $student_number = $last_name = $first_name = "";

# Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Your existing form validation code goes here...

    # Validate student number
    if (empty(trim($_POST["student_number"]))) {
        $student_number_err = "Please enter a student number.";
    } elseif (!preg_match('/^\d{10}$/', trim($_POST["student_number"]))) {
        $student_number_err = "Student number must contain exactly 10 numbers.";
    } else {
        $student_number = trim($_POST["student_number"]);
        # Check if student number is already registered
        $sql = "SELECT id FROM users WHERE student_number = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            # Bind variables to the statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_student_number);

            # Set parameters
            $param_student_number = $student_number;

            # Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                # Store result
                mysqli_stmt_store_result($stmt);

                # Check if student number is already registered
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $student_number_err = "This student number is already registered.";
                }
            } else {
                echo "<script>" . "alert('Oops! Something went wrong. Please try again later.')" . "</script>";
            }

            # Close statement
            mysqli_stmt_close($stmt);
        }
    }

    # Validate last name
    if (empty(trim($_POST["last_name"]))) {
        $last_name_err = "Please enter a last name.";
    } else {
        $last_name = trim($_POST["last_name"]);
    }

    # Validate first name
    if (empty(trim($_POST["first_name"]))) {
        $first_name_err = "Please enter a first name.";
    } else {
        $first_name = trim($_POST["first_name"]);
    }

    # Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
        if (!ctype_alnum(str_replace(array("@", "-", "_"), "", $username))) {
            $username_err = "Username can only contain letters, numbers and symbols like '@', '_', or '-'.";
        } else {
            # Prepare a select statement
            $sql = "SELECT id FROM users WHERE username = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                # Bind variables to the statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                # Set parameters
                $param_username = $username;

                # Execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    # Store result
                    mysqli_stmt_store_result($stmt);

                    # Check if username is already registered
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $username_err = "This username is already registered.";
                    }
                } else {
                    echo "<script>" . "alert('Oops! Something went wrong. Please try again later.')" . "</script>";
                }

                # Close statement
                mysqli_stmt_close($stmt);
            }
        }
    }

    # Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email address";
    } else {
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Please enter a valid email address.";
        } else {
            # Prepare a select statement
            $sql = "SELECT id FROM users WHERE email = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                # Bind variables to the statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                # Set parameters
                $param_email = $email;

                # Execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    # Store result
                    mysqli_stmt_store_result($stmt);

                    # Check if email is already registered
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $email_err = "This email is already registered.";
                    }
                } else {
                    echo "<script>" . "alert('Oops! Something went wrong. Please try again later.');" . "</script>";
                }

                # Close statement
                mysqli_stmt_close($stmt);
            }
        }
    }

    # Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } else {
        $password = trim($_POST["password"]);
        if (strlen($password) < 8) {
            $password_err = "Password must contain at least 8 or more characters.";
        }
    }

    # Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if ($password != $confirm_password) {
            $confirm_password_err = "Passwords do not match.";
        }
    }

    # Check input errors before inserting data into database
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($student_number_err) && empty($last_name_err) && empty($first_name_err)) {

        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Generate OTP
        $otp = rand(100000, 999999);

        // Send OTP to user's email
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'eprepsys@gmail.com'; // Replace with your email address
            $mail->Password   = 'lkxn pqks xwxe lotr'; // Replace with your email account password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587; // Typically 587 for TLS

            // Recipients
            $mail->setFrom('eprepsys@gmail.com', 'E-Prep');
            $mail->addAddress($email, $first_name . ' ' . $last_name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'OTP for Account Registration';
            $mail->Body = '
            <p>Hi there,</p>
            <p>Thanks for signing up with E-Prep! To finish setting up your account, use the OTP code below:</p>
            <h2>Your OTP: ' . $otp . '</h2>
            <p>This code is valid for 3 minutes. Enter it on the registration page to verify your email.</p>
            <p>If you didn’t request this, please ignore this email or let us know.</p>
            <p>Thanks,<br>The E-Prep Team</p>
        ';
                    
            $mail->send();
            echo 'OTP has been sent to your email.';

            // Store the OTP and other details in the session
            session_start();
            $_SESSION['otp'] = $otp;
            $_SESSION['otp_expiry'] = time() + 180; // Current time + 180 seconds (3 minutes)
            $_SESSION['student_number'] = $student_number;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $hashed_password; // Store the hashed password
        
            // Redirect to OTP verification page
            header("location: verify_otp.php");
            exit;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    # Close connection
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="./img/e-favicon.png" type="image/x-icon">
    <script defer src="./js/script.js"></script>
</head>

<body style="background: url('img/siena-building.png') no-repeat center center; background-size: cover; height: 100vh;" class="d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" 
                            style="background: url('img/e-prep-logo.png') no-repeat center center; background-color: #f0f0f0;"></div>
                            <div class="col-lg-6" style="background-color: #f0f0f0;">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Sign Up</h1>
                                        <p>Please fill this form to register</p>
                                    </div>
                                    <?php if (!empty($login_err)): ?>
                                        <div class="alert alert-danger"><?= $login_err; ?></div>
                                    <?php endif; ?>
                                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
                                        <div class="row">
                                            <!-- Student Number & Last Name -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="student_number" class="form-label">Student Number</label>
                                                    <input type="text" class="form-control form-control-user" name="student_number" id="student_number" value="<?= $student_number; ?>" pattern="[0-9]{10}">
                                                    <small class="text-danger"><?= $student_number_err; ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="last_name" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control form-control-user" name="last_name" id="last_name" value="<?= $last_name; ?>">
                                                    <small class="text-danger"><?= $last_name_err; ?></small>
                                                </div>
                                            </div>
                                            
                                            <!-- First Name & Username -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="first_name" class="form-label">First Name</label>
                                                    <input type="text" class="form-control form-control-user" name="first_name" id="first_name" value="<?= $first_name; ?>">
                                                    <small class="text-danger"><?= $first_name_err; ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control form-control-user" name="username" id="username" value="<?= $username; ?>">
                                                    <small class="text-danger"><?= $username_err; ?></small>
                                                </div>
                                            </div>
                                            
                                            <!-- Email & Password -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email" class="form-label">Email Address</label>
                                                    <input type="email" class="form-control form-control-user" name="email" id="email" value="<?= $email; ?>">
                                                    <small class="text-danger"><?= $email_err; ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" class="form-control form-control-user" name="password" id="password" value="<?= $password; ?>">
                                                    <small class="text-danger"><?= $password_err; ?></small>
                                                </div>
                                            </div>
                                            
                                            <!-- Confirm Password & Show Password -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                                    <input type="password" class="form-control form-control-user" name="confirm_password" id="confirm_password">
                                                    <small class="text-danger"><?= $confirm_password_err; ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox small">
                                                        <input type="checkbox" class="custom-control-input" id="togglePassword">
                                                        <label class="custom-control-label" for="togglePassword">Show Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" name="submit" value="Sign Up">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <p class="mb-0">Already have an account? <a href="login.php">Log In</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('change', function (e) {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm_password');
            const type = e.target.checked ? 'text' : 'password';
            password.type = type;
            confirmPassword.type = type;
        });
    </script>
</body>

</html>
