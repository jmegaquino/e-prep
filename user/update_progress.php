<?php
// Include database connection
include('../config.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php"); // Redirect to login if not logged in
    exit();
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lesson_id = intval($_POST['lesson_id']); // Ensure lesson_id is an integer
    $user_id = $_SESSION['id'];

    // Check if the progress record already exists
    $query = "SELECT progress FROM lesson_progress WHERE lesson_id = ? AND user_id = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param("ii", $lesson_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Record found, check progress
        $row = $result->fetch_assoc();
        if ($row['progress'] !== 'complete') {
            // Update progress to "complete"
            $update_query = "UPDATE lesson_progress SET progress = 'complete', updated_at = NOW() WHERE lesson_id = ? AND user_id = ?";
            $update_stmt = $link->prepare($update_query);
            $update_stmt->bind_param("ii", $lesson_id, $user_id);
            $update_stmt->execute();
        }
    } else {
        // No record found, insert new progress record
        $insert_query = "INSERT INTO lesson_progress (lesson_id, user_id, progress) VALUES (?, ?, 'complete')";
        $insert_stmt = $link->prepare($insert_query);
        $insert_stmt->bind_param("ii", $lesson_id, $user_id);
        $insert_stmt->execute();
    }

    // Redirect back to the lesson page or dashboard with a success message
    header("Location: dashboard.php?status=progress_updated");
    exit();
} else {
    echo "Invalid request.";
}
?>
