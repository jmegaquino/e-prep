<?php
# Initialize the session
session_start();

# If user is logged in as admin, then proceed with logout
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === TRUE) {
    # Unset the session variable for admin login
    unset($_SESSION["loggedin"]);

    # Destroy the session if there are no more admin-related session variables
    if (empty($_SESSION)) {
        session_destroy();
    }
}

# Redirect to login page
echo "<script>" . "window.location.href='../login.php';" . "</script>";
exit;
?>
