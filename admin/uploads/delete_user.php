<?php
// delete_user.php
include '../config.php'; // Ensure this file contains your database connection setup

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if ID is set and not empty
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = intval($_POST['id']); // Sanitize ID to ensure it's an integer

        // Use prepared statements to prevent SQL injection
        $sql = "DELETE FROM users WHERE id = ?";
        if ($stmt = $link->prepare($sql)) {
            $stmt->bind_param("i", $id);

            // Execute the statement
            if ($stmt->execute()) {
                header("Location: user_management.php?message=User+deleted+successfully");
                exit();
            } else {
                // Handle execution error
                echo "Error executing query: " . $stmt->error;
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            // Handle preparation error
            echo "Error preparing query: " . $link->error;
        }
    } else {
        // Handle missing or invalid ID
        echo "Invalid or missing user ID.";
    }
} else {
    // Handle invalid request method
    echo "Invalid request method.";
}

// Close the database connection
$link->close();
?>
