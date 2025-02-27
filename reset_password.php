<?php
require_once "./config.php";  // Include the database configuration file

$error_message = $new_password_err = $confirm_password_err = "";
$success_message = "";
$show_form = true;  // Flag to control form display
$invalid_token = false;  // Flag to track invalid or expired token

// Check if the token parameter is present in the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Prepare a statement to select the user with the given reset token
    $sql = "SELECT id, token_expiry FROM users WHERE reset_token = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $token);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            // Check if a user was found with the given token
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $token_expiry);
                mysqli_stmt_fetch($stmt);

                // Check if the token has expired
                if (strtotime($token_expiry) > time()) {
                    // Token is valid, proceed with password reset
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Validate and sanitize new password
                        $new_password = trim($_POST["new_password"]);
                        $confirm_password = trim($_POST["confirm_password"]);

                        if (empty($new_password)) {
                            $new_password_err = "Please enter a new password.";
                        } elseif (strlen($new_password) < 8) {
                            $new_password_err = "Password must have at least 8 characters.";
                        }

                        if (empty($confirm_password)) {
                            $confirm_password_err = "Please confirm your new password.";
                        } elseif ($new_password != $confirm_password) {
                            $confirm_password_err = "Passwords do not match.";
                        }

                        if (empty($new_password_err) && empty($confirm_password_err)) {
                            // Hash the new password
                            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                            // Update the user's password in the database
                            $update_sql = "UPDATE users SET password = ?, reset_token = NULL, token_expiry = NULL WHERE id = ?";
                            if ($update_stmt = mysqli_prepare($link, $update_sql)) {
                                mysqli_stmt_bind_param($update_stmt, "si", $hashed_password, $id);
                                if (mysqli_stmt_execute($update_stmt)) {
                                    $success_message = "Password has been reset successfully. <a href='login.php'>Log in</a>";
                                    $show_form = false;  // Hide the form after successful password reset
                                } else {
                                    $error_message = "Something went wrong. Please try again later.";
                                }
                                mysqli_stmt_close($update_stmt);
                            }
                        }
                    }
                } else {
                    $error_message = "Invalid or expired token.";
                    $invalid_token = true;  // Set flag for invalid token
                }
            } else {
                $error_message = "Invalid or expired token.";
                $invalid_token = true;  // Set flag for invalid token
            }
        } else {
            $error_message = "Something went wrong. Please try again later.";
        }
        mysqli_stmt_close($stmt);
    }
} else {
    $error_message = "No token provided.";
    $invalid_token = true;  // Set flag for invalid token
}

// Close the database connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../img/E-favicon.png" type="image/x-icon">
  <title>Reset Password</title>
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

    .alert-info,
    .alert-danger,
    .alert-success {
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
      <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
      <p>Please enter your new password below.</p>

      <?php
        if (!empty($error_message)) {
            echo "<div class='alert alert-danger'>$error_message</div>";
            $show_form = false;  // Hide form if there is an error message
        } elseif (!empty($success_message)) {
            echo "<div class='alert alert-success'>$success_message</div>";
            $show_form = false;  // Hide form after successful password reset
        }

        if ($show_form) {
      ?>
      <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"] . "?token=" . urlencode($token)); ?>" method="post" novalidate>
        <div class="mb-3">
          <label for="new_password" class="form-label">New Password</label>
          <input type="password" class="form-control" name="new_password" id="new_password">
          <small class="text-danger"><?= $new_password_err; ?></small>
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" name="confirm_password" id="confirm_password">
          <small class="text-danger"><?= $confirm_password_err; ?></small>
        </div>
        <div class="mb-3">
          <input type="submit" class="btn btn-reset form-control" value="Reset Password">
        </div>
      </form>
      <?php
        } else {
            // Provide a link to go back to the login page if the form is not displayed
            echo "<p><a href='login.php' class='btn btn-danger'>Go Back to Login</a></p>";
        }
      ?>
    </div>
  </div>
</body>
</html>
