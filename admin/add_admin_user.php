<?php
// Include the database connection
include '../config.php';

// Start the session
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    die("Access denied: You must be logged in as an admin to perform this action.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize form data
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($username)) {
        die("Error: Username cannot be empty.");
    }

    if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
        die("Error: Username must be 3-20 characters long and contain only letters, numbers, or underscores.");
    }

    if (empty($password)) {
        die("Error: Password cannot be empty.");
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check for duplicate username
    $check_sql = "SELECT id FROM admin WHERE username = ?";
    if ($stmt = $link->prepare($check_sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Error: Username already exists.";
            $stmt->close();
            exit;
        }
        $stmt->close();
    } else {
        die("Error preparing check statement: " . $link->error);
    }

    // SQL query to insert a new admin user into the 'admin' table
    $sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
    if ($stmt = $link->prepare($sql)) {
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            echo "Admin user added successfully!";
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        $stmt->close();
    } else {
        die("Error preparing insert statement: " . $link->error);
    }

    // Close the database connection
    $link->close();
}
?>
