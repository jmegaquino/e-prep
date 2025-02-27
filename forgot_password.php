<?php
session_start();
require_once "./config.php";
require 'vendor/autoload.php'; // Include PHPMailer autoload file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email_err = $message = "";
$show_form = true; // Flag to control form display

$email = ""; // Initialize the variable at the top


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);

        // Check if the email exists in the database
        $sql = "SELECT id FROM users WHERE email = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Generate a unique reset token
                    $reset_token = bin2hex(random_bytes(32));
                    $token_expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));

                    // Store the reset token and expiry in the database
                    $update_sql = "UPDATE users SET reset_token = ?, token_expiry = ? WHERE email = ?";
                    if ($update_stmt = mysqli_prepare($link, $update_sql)) {
                        mysqli_stmt_bind_param($update_stmt, "sss", $reset_token, $token_expiry, $email);
                        if (mysqli_stmt_execute($update_stmt)) {
                            // Send the password reset email using PHPMailer
                            $reset_link = "http://localhost/eprep_revise/reset_password.php?token=" . $reset_token;
                            $subject = "Password Reset Request";
                            $message_body = "Click the link below to reset your password: <a href='$reset_link'>$reset_link</a>";

                            $mail = new PHPMailer(true);

                            try {
                                // Server settings
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
                                $mail->SMTPAuth = true;
                                $mail->Username = 'eprepsys@gmail.com'; // Your SMTP username
                                $mail->Password = 'lkxn pqks xwxe lotr'; // Your SMTP password
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
                                $mail->Port = 587; // TCP port to connect to

                                // Recipients
                                $mail->setFrom('no-reply@eprep.com', 'E-Prep Support');
                                $mail->addAddress($email); // Add a recipient

                                // Content
                                $mail->isHTML(true); // Set email format to HTML
                                $mail->Subject = $subject;
                                $mail->Body    = $message_body;

                                $mail->send();
                                $message = "A password reset link has been sent to your email. <a href='login.php'>Go back to login</a>";
                                $show_form = false;  // Hide the form after sending the reset link
                            } catch (Exception $e) {
                                $message = "Failed to send reset email. Mailer Error: {$mail->ErrorInfo}";
                            }

                        } else {
                            $message = "Failed to update the reset token. Please try again later.";
                        }
                        mysqli_stmt_close($update_stmt);
                    }
                } else {
                    $email_err = "No account found with that email address.";
                }
            } else {
                $message = "Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="../img/E-favicon.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/main.css">
  <style>
    body {
      background: url('../img/siena-building.png') no-repeat center center;
      background-size: cover;
      height: 100vh;
    }

    .form-wrapper {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100%;
    }

    .form-container {
      background-color: rgba(255, 255, 255, 0.8);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .form-container h1 {
      margin-bottom: 20px;
    }

    .form-container p {
      margin-bottom: 20px;
      font-size: 1rem;
      color: #555;
    }

    .form-control {
      border-radius: 8px;
      margin-bottom: 20px;
    }

    .btn-reset {
      background-color: #e74a3b;
      color: white;
      border-radius: 50px;
      padding: 10px 20px;
      width: 100%;
      border: none;
    }

    .btn-reset:hover {
      background-color: #d13a2c;
    }

    .alert-info {
      margin-bottom: 20px;
      padding: 15px;
      background-color: #f0f8ff;
      border-radius: 8px;
    }

    .btn-back {
      background-color: #f8f9fa;
      border: none;
      border-radius: 50px;
      padding: 5px 20px;
      width: 100%;
      margin-top: 10px;
    }

    .btn-back:hover {
      background-color: #e2e6ea;
    }

  </style>
</head>
<body>
  <div class="container form-wrapper">
    <div class="form-container">
      <h1 class="h4 text-gray-900 mb-4">Forgot Password</h1>
      <p>Please enter your email address to receive a password reset link.</p>

      <?php if (!empty($message)) echo "<div class='alert alert-info'>$message</div>"; ?>

      <?php if ($show_form) : ?>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($email); ?>">
            <small class="text-danger"><?= $email_err; ?></small>
          </div>
          <div class="mb-3">
            <input type="submit" class="btn btn-reset form-control" value="Send Reset Link">
          </div>
        </form>
      <?php endif; ?>

      <form action="login.php" method="get">
        <button type="submit" class="btn btn-back">Back to Login</button>
      </form>
    </div>
  </div>
</body>
</html>
