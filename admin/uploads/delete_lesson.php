<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lesson_id = $_POST['lesson_id'];

    // Delete related assessments first
    $stmt_delete_assessments = $link->prepare("DELETE FROM assessments WHERE lesson_id = ?");
    $stmt_delete_assessments->bind_param("i", $lesson_id);
    $stmt_delete_assessments->execute();

    if ($stmt_delete_assessments->affected_rows > 0 || $stmt_delete_assessments->affected_rows == 0) {
        // Delete the lesson content
        $stmt_delete_content = $link->prepare("DELETE FROM lesson_content WHERE lesson_id = ?");
        $stmt_delete_content->bind_param("i", $lesson_id);
        $stmt_delete_content->execute();

        if ($stmt_delete_content->affected_rows > 0) {
            // Delete the lesson
            $stmt_delete = $link->prepare("DELETE FROM lessons WHERE id = ?");
            $stmt_delete->bind_param("i", $lesson_id);
            $stmt_delete->execute();

            if ($stmt_delete->affected_rows > 0) {
                // Redirect with a success message
                header("Location: lesson_man.php?message=Lesson deleted successfully");
            } else {
                echo "Error deleting lesson: " . $link->error;
            }

            $stmt_delete_content->close();
            $stmt_delete->close();
        } else {
            echo "Error deleting lesson content: " . $link->error;
        }

        $stmt_delete_assessments->close();
    } else {
        echo "Error deleting assessments: " . $link->error;
    }
}

$link->close();
?>
