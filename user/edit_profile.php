<?php
session_start();
require_once(__DIR__ . '/../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newFirstName = $_POST['first_name'];
    $newLastName = $_POST['last_name'];

    // Update user profile in the database
    $stmt = $link->prepare("UPDATE users SET first_name=?, last_name=? WHERE id=?");
    $stmt->bind_param("ssi", $newFirstName, $newLastName, $_SESSION['id']);

    if ($stmt->execute()) {
        // Update session data
        $_SESSION["first_name"] = $newFirstName;
        $_SESSION["last_name"] = $newLastName;

        // Redirect to dashboard.php with a success status
        header("Location: dashboard.php?status=success");
        exit;
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
    $link->close();
}
?>
