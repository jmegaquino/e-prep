<?php
session_start();
include('../config.php'); // Include your database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the lesson ID and user ID
    $lesson_id = $_POST['lesson_id'];
    $user_id = $_SESSION['user_id']; // Assuming user ID is stored in session

    // Insert or update the progress for this lesson
    $progress = 100; // Assume completion means 100% progress for the specific lesson

    // Check if the user has already recorded progress for this lesson
    $checkProgressSql = "SELECT * FROM lesson_progress WHERE lesson_id = ? AND user_id = ?";
    if ($stmt = $link->prepare($checkProgressSql)) {
        // Bind parameters
        $stmt->bind_param("ii", $lesson_id, $user_id);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // If progress already exists, update it
            $updateProgressSql = "UPDATE lesson_progress SET progress = ? WHERE lesson_id = ? AND user_id = ?";
            if ($updateStmt = $link->prepare($updateProgressSql)) {
                // Bind parameters
                $updateStmt->bind_param("iii", $progress, $lesson_id, $user_id);

                // Execute the update
                $updateStmt->execute();
            }
        } else {
            // If no progress exists, insert new record
            $insertProgressSql = "INSERT INTO lesson_progress (lesson_id, user_id, progress) VALUES (?, ?, ?)";
            if ($insertStmt = $link->prepare($insertProgressSql)) {
                // Bind parameters
                $insertStmt->bind_param("iii", $lesson_id, $user_id, $progress);

                // Execute the insert
                $insertStmt->execute();
            }
        }
        
        // Close statements
        $stmt->close();
    }

    // Redirect back to the lesson preview page with a success message
    header("Location: lesson_preview.php?id=" . $lesson_id . "&message=Lesson%20completed%20successfully");
    exit;
}

// Close the database connection
$link->close();
?>
