<?php
# Start the session
session_start();

# Check if the admin is logged in
if (isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"] === true) {
    # Unset the specific session variable for admin login
    unset($_SESSION["loggedin_admin"]);


    # Destroy the session if it is now empty
    if (empty($_SESSION)) {
        session_destroy();
    }
}

# Redirect to the admin login page
header("Location: ../login_admin.php");
exit;
?>
