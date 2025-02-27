<?php
# Include connection
require_once "../config.php";
require '../vendor/autoload.php'; // Include PHPMailer autoload file

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
            header("location: verify_otp");
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
    <title>Sign Up | E-Prep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="shortcut icon" href="./img/E-favicon.png" type="image/x-icon">
    <script defer src="./js/script.js"></script>

    <style>
        .divider:after,
        .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
        }

        .h-custom {
        height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
            height: 100%;
            }
        }

        body{
            background-image: url('img/bg.jpg');
        }

    </style>
</head>

<body>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5 mt-n3">
        <img src="img/esiena.png" class="img-fluid mb-2" alt="Sample image" style="margin-top: -20px; padding-bottom: 30px">
        <div class="col-lg-12 d-flex align-items-center gradient-custom-2">
            <div class="px-4 py-3 p-md-0 mx-md-5">
                <h3 class="mb-2">Welcome to E-Prep</h4>
                <p class="lead small" style="font-weight: 300;">Your go-to hub for effortless learning and development. 
                    Access your personalized dashboard, take part in interactive lessons, 
                    and reach your educational goals — all in one convenient place.</p>
                <p class="lead small mb-0" style="font-weight: 400;">
                    Log in to start your journey today!
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form class="bg-light p-3 rounded">
            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                <p class="lead fw-normal mb-0 me-3">Sign Up</p>
            </div>

            <div class="divider d-flex align-items-center my-4"></div>

            <!-- First Name and Last Name in the same row -->
            <div class="row mb-2">
                <!-- First Name input -->
                <div class="col-md-6 form-outline mb-0" data-mdb-input-init>
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $first_name; ?>">
                    <small class="text-danger"><?= $first_name_err; ?></small>
                </div>

                <!-- Last Name input -->
                <div class="col-md-6 form-outline mb-0" data-mdb-input-init>
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" value="<?= $last_name; ?>">
                    <small class="text-danger"><?= $last_name_err; ?></small>
                </div>
            </div>

            <!-- Student Number input -->
            <div data-mdb-input-init class="form-outline mb-2">
                <label for="student_number" class="form-label">Student Number</label>
                <input type="text" class="form-control" name="student_number" id="student_number" value="<?= $student_number; ?>" pattern="[0-9]{10}">
                <small class="text-danger"><?= $student_number_err; ?></small>
            </div>

            <!-- Username input -->
            <div data-mdb-input-init class="form-outline mb-2">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= $username; ?>">
                <small class="text-danger"><?= $username_err; ?></small>
            </div>
            
            <!-- Email Address input -->
            <div data-mdb-input-init class="form-outline mb-2">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" id="email" value="<?= $email; ?>">
                <small class="text-danger"><?= $email_err; ?></small>
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-0">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="<?= $password; ?>">
                <small class="text-danger"><?= $password_err; ?></small>
            </div>

            <!-- Confirm Password input -->
            <div data-mdb-input-init class="form-outline mb-2">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                <small class="text-danger"><?= $confirm_password_err; ?></small>
            </div>

            <div class="col-md-6 align-self-end">
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="togglePassword">
                    <label for="togglePassword" class="form-check-label">Show Password</label>
                </div>
            </div>


            <div class="text-center text-lg-start mt-2 pt-2">
                <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-md"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Sign up</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="#!"
                    class="link-danger">Log in</a></p>
            </div>

        </form>
      </div>
    </div>
  </div>
  <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-3 px-4 px-xl-5 bg-dark"
  style="position: fixed; bottom: 0; left: 0; width: 100%; z-index: 10;">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © E-Prep 2024. All rights reserved.
    </div>
    <!-- Copyright -->

    <!-- Right -->
    <div>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-google"></i>
      </a>
      <a href="#!" class="text-white">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
    <!-- Right -->
  </div>
</section>

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