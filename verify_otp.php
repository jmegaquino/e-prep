<?php



session_start();
require 'vendor/autoload.php'; // Include PHPMailer autoload file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


# Define variables and initialize with empty values
$otp_err = "";

# Resend OTP process
if (isset($_POST['resend_otp'])) {
    // Generate and send a new OTP
    $new_otp = rand(100000, 999999); // Generate a new OTP
    $_SESSION['otp'] = $new_otp;
    $_SESSION['otp_expiry'] = time() + 300; // OTP expires after 5 minutes
    $_SESSION['otp_sent_time'] = time();
    $_SESSION['resend_cooldown_end'] = time() + 180; // 3 minutes cooldown

    // Send the OTP email using PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'eprepsys@gmail.com'; // Replace with your email
        $mail->Password = 'lkxn pqks xwxe lotr'; // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        // Recipients
        $mail->setFrom('eprepsys@gmail.com', 'E-Prep');
        $mail->addAddress($_SESSION['email'], $_SESSION['first_name'] . ' ' . $_SESSION['last_name']);
        
            // Content
            $mail->isHTML(true);
            $mail->Subject = 'OTP for Account Registration';
            $mail->Body = '
            <p>Hi there,</p>
            <p>Thanks for signing up with E-Prep! To finish setting up your account, use the new OTP code below:</p>
            <h2>Your OTP: ' . $new_otp . '</h2>
            <p>This code is valid for 3 minutes. Enter it on the registration page to verify your email.</p>
            <p>If you didn’t request this, please ignore this email or let us know.</p>
            <p>Thanks,<br>The E-Prep Team</p>
        ';

        $mail->send();
        echo "<script>alert('A new OTP has been sent to your email.');</script>";
    } catch (Exception $e) {
        echo "<script>alert('Could not send OTP. Please try again.');</script>";
    }
}

# Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['resend_otp'])) {
    $entered_otp = trim($_POST["otp"]);

    # Validate OTP
    if (empty($entered_otp)) {
        $otp_err = "Please enter the OTP.";
    } elseif (time() > $_SESSION['otp_expiry']) {
        $otp_err = "The OTP has expired. Please request a new one.";
    } elseif ($entered_otp != $_SESSION['otp']) {
        $otp_err = "Invalid OTP.";
    } else {
        # Prepare an insert statement
        require_once "config.php";
        $sql = "INSERT INTO users (student_number, last_name, first_name, username, email, password) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssss", $param_student_number, $param_last_name, $param_first_name, $param_username, $param_email, $param_password);

            # Set parameters from session
            $param_student_number = $_SESSION['student_number'];
            $param_last_name = $_SESSION['last_name'];
            $param_first_name = $_SESSION['first_name'];
            $param_username = $_SESSION['username'];
            $param_email = $_SESSION['email'];
            $param_password = $_SESSION['password'];

            # Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Registration completed successfully. Login to continue.');</script>";
                echo "<script>window.location.href='login.php';</script>";
                exit;
            } else {
                echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
                echo mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);

        # Clear session data
        session_unset();
        session_destroy();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/register.css">
    <style>
        body {
            background: url('img/siena-building.png') no-repeat center center;
            background-size: cover;
            height: 100vh;
        }

        .otp-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .otp-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .otp-input-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 20px;
        }

        .otp-input {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
            text-align: center;
            border: 2px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: border 0.3s ease;
        }

        .otp-input:focus {
            border-color: #4e73df;
        }

        .timer {
            font-size: 1rem;
            color: #666;
            margin-top: 10px;
        }

        .btn-verify {
            background-color: #4e73df;
            color: white;
            border-radius: 50px;
            padding: 10px 20px;
            width: 100%;
            border: none;
        }

        .btn-verify:hover {
            background-color: #2e59d9;
        }

        .btn-resend {
            background-color: #e2e2e2;
            border: none;
            border-radius: 50px;
            padding: 5px 20px;
            width: 100%;
            margin-top: 10px;
        }

        .btn-resend:hover {
            background-color: #ccc;
        }

    </style>
</head>
<body>
<div class="container otp-wrapper">
    <div class="otp-container">
        <h1 class="h4 text-gray-900 mb-4">Verify OTP</h1>
        <p>Please enter the OTP sent to your email.</p>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="otp-form">
            <div class="otp-input-group">
                <input type="text" class="form-control otp-input" maxlength="1" pattern="\d" required>
                <input type="text" class="form-control otp-input" maxlength="1" pattern="\d" required>
                <input type="text" class="form-control otp-input" maxlength="1" pattern="\d" required>
                <input type="text" class="form-control otp-input" maxlength="1" pattern="\d" required>
                <input type="text" class="form-control otp-input" maxlength="1" pattern="\d" required>
                <input type="text" class="form-control otp-input" maxlength="1" pattern="\d" required>
            </div>
            <input type="hidden" name="otp" id="otp" value="">
            <small class="text-danger"><?= $otp_err; ?></small>
            <div class="mb-3">
                <input type="submit" class="btn btn-verify form-control" value="Verify OTP">
            </div>
        </form>

        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="resend_otp" value="1">
            <button type="submit" class="btn btn-resend" id="resend-btn" disabled>Resend OTP</button>
        </form>
        <div class="timer" id="timer">You can resend OTP in 3:00</div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const otpInputs = document.querySelectorAll('.otp-input');
        const otpHiddenInput = document.getElementById('otp');
        const resendBtn = document.getElementById('resend-btn');
        const timerDisplay = document.getElementById('timer');

        const resendCooldownKey = 'resendCooldownEnd';
        let cooldownEnd = localStorage.getItem(resendCooldownKey);

        function startTimer() {
            if (!cooldownEnd) {
                cooldownEnd = Date.now() + 180 * 1000; // 3 minutes
                localStorage.setItem(resendCooldownKey, cooldownEnd);
            }
            updateTimer();
            setInterval(updateTimer, 1000); // Update every second
        }

        function updateTimer() {
            const now = Date.now();
            const timeLeft = cooldownEnd - now;
            if (timeLeft <= 0) {
                resendBtn.disabled = false;
                timerDisplay.textContent = 'You can resend OTP now.';
                localStorage.removeItem(resendCooldownKey);
            } else {
                resendBtn.disabled = true;
                const minutes = Math.floor(timeLeft / 60000);
                const seconds = Math.floor((timeLeft % 60000) / 1000);
                timerDisplay.textContent = `You can resend OTP in ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            }
        }

        startTimer();

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
                updateHiddenOTP();
            });

            input.addEventListener('keydown', (event) => {
                if (event.key === 'Backspace' && input.value === '' && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });

        function updateHiddenOTP() {
            otpHiddenInput.value = Array.from(otpInputs).map(input => input.value).join('');
        }
    });
</script>
</body>
</html>

