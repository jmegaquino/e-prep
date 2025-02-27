<?php
// Include the database connection
include('../../../config.php');

// Check if chapter_id is set and not empty
if (isset($_POST['chapter_id']) && !empty($_POST['chapter_id'])) {
    // Retrieve the chapter_id from POST request
    $chapter_id = intval($_POST['chapter_id']); // Use intval to ensure it's an integer

    // Get the user ID, assuming a session is started
    session_start();
    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id']; // Assuming user_id is stored in the session

        // Step 1: Fetch the corresponding lesson_id from the virtual_labs table based on chapter_id
        $query = "SELECT lesson_id FROM virtual_labs WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bind_param("i", $chapter_id); // Bind the chapter_id to the query
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($lesson_id);
        
        if ($stmt->num_rows > 0) {
            // Fetch the lesson_id associated with this chapter_id
            $stmt->fetch();
            
            // Step 2: Check if progress already exists for the user and lesson_id
            $checkQuery = "SELECT * FROM progress WHERE user_id = ? AND lesson_id = ?";
            $stmt2 = $link->prepare($checkQuery);
            $stmt2->bind_param("ii", $user_id, $lesson_id);
            $stmt2->execute();
            $result = $stmt2->get_result();

            if ($result->num_rows > 0) {
                // If progress exists, update it
                $updateQuery = "UPDATE progress SET progress_status = 'completed' WHERE user_id = ? AND lesson_id = ?";
                $stmt2 = $link->prepare($updateQuery);
                $stmt2->bind_param("ii", $user_id, $lesson_id);
                $stmt2->execute();
                echo "success"; // Respond with success for JavaScript to handle
            } else {
                // If progress doesn't exist, insert new record
                $insertQuery = "INSERT INTO progress (user_id, lesson_id, progress_status) VALUES (?, ?, ?)";
                $stmt2 = $link->prepare($insertQuery);
                $progress_status = 'completed'; // Set initial status to 'completed' or as required
                $stmt2->bind_param("iis", $user_id, $lesson_id, $progress_status);
                $stmt2->execute();
                echo "success"; // Respond with success for JavaScript to handle
            }

            $stmt2->close();
        } else {
            echo "No lesson found for the given chapter."; // If no lesson is found
        }

        $stmt->close();
    } else {
        echo "User not logged in."; // If user is not logged in
    }
} else {
    echo "Invalid chapter ID."; // If no chapter_id is provided or it's invalid
}

// Close the database connection
$link->close();
?>
