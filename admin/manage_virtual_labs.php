<?php
// Start session to keep track of flash messages
session_start();

// Include database connection
include('../config.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a lesson ID is provided
    if (!empty($_POST['lessonId'])) {
        $lessonId = $_POST['lessonId'];

        // Loop through the virtual labs data to insert or update labs
        $labTypes = $_POST['virtualLabType'];
        $labLinks = isset($_POST['virtualLabLink']) ? $_POST['virtualLabLink'] : [];
        $labFiles = isset($_FILES['virtualLabFile']) ? $_FILES['virtualLabFile'] : [];
        $labFolders = isset($_FILES['virtualLabFolder']) ? $_FILES['virtualLabFolder'] : [];
        $launchFiles = isset($_POST['launchFile']) ? $_POST['launchFile'] : [];

        // Process each virtual lab
        foreach ($labTypes as $index => $labType) {
            // Initialize variables
            $labData = '';
            $launchFile = isset($launchFiles[$index]) ? $launchFiles[$index] : '';

            // Handle different lab types
            if ($labType === 'embedLink') {
                $labData = $labLinks[$index];
            } elseif ($labType === 'uploadFile' && isset($labFiles['tmp_name'][$index])) {
                // Handle file upload
                $targetDir = "../user/uploads/labs/";
                $fileName = basename($labFiles['name'][$index]);
                $targetFilePath = $targetDir . $fileName;

                if (move_uploaded_file($labFiles['tmp_name'][$index], $targetFilePath)) {
                    $labData = $targetFilePath;
                } else {
                    // Return error as JSON and exit
                    echo json_encode(['status' => 'error', 'message' => 'Error uploading file.']);
                    exit;
                }
            } elseif ($labType === 'uploadFolder' && isset($labFolders['tmp_name'][$index])) {
                // Handle folder upload (zip file)
                $targetDir = "../user/uploads/labs/";
                $fileName = basename($labFolders['name'][$index]);
                $targetFilePath = $targetDir . $fileName;

                if (move_uploaded_file($labFolders['tmp_name'][$index], $targetFilePath)) {
                    // Automatically unzip the uploaded zip file
                    $zip = new ZipArchive;
                    if ($zip->open($targetFilePath) === TRUE) {
                        // Create a directory to unzip the files into
                        $extractDir = $targetDir . pathinfo($fileName, PATHINFO_FILENAME);
                        if (!file_exists($extractDir)) {
                            mkdir($extractDir, 0777, true);
                        }
                        // Extract the zip file
                        $zip->extractTo($extractDir);
                        $zip->close();

                        // Set the labData to the path of the unzipped folder
                        $labData = $extractDir . '/';  // The folder where the contents are unzipped
                    } else {
                        // Return error as JSON and exit if zip extraction fails
                        echo json_encode(['status' => 'error', 'message' => 'Error unzipping the file.']);
                        exit;
                    }
                } else {
                    // Return error as JSON and exit
                    echo json_encode(['status' => 'error', 'message' => 'Error uploading folder.']);
                    exit;
                }
            }

            // Insert the virtual lab into the database
            $query = "INSERT INTO virtual_labs (lesson_id, lab_type, lab_data, launch_file) VALUES (?, ?, ?, ?)";
            if ($stmt = mysqli_prepare($link, $query)) {
                mysqli_stmt_bind_param($stmt, "isss", $lessonId, $labType, $labData, $launchFile);
                if (!mysqli_stmt_execute($stmt)) {
                    // Return error as JSON and exit
                    echo json_encode(['status' => 'error', 'message' => 'Error executing query: ' . mysqli_error($link)]);
                    exit;
                }
                mysqli_stmt_close($stmt);
            } else {
                // Return error as JSON and exit
                echo json_encode(['status' => 'error', 'message' => 'Error preparing query: ' . mysqli_error($link)]);
                exit;
            }
        }

        // Get the lesson title
        $lessonQuery = "SELECT title FROM lessons WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $lessonQuery)) {
            mysqli_stmt_bind_param($stmt, "i", $lessonId);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $lessonTitle);
                mysqli_stmt_fetch($stmt);

                // Set a session variable with the success message
                $_SESSION['success_message'] = "Virtual labs have been successfully added to the lesson '$lessonTitle'.";
            }
            mysqli_stmt_close($stmt);
        } else {
            // Return error as JSON and exit
            echo json_encode(['status' => 'error', 'message' => 'Error retrieving lesson information.']);
            exit;
        }

        // Redirect to the lesson management page
        header('Location: lesson_man.php');
        exit; // Ensure no further code is executed after the redirect
    } else {
        // If no lesson ID is provided, return error message
        echo json_encode(['status' => 'error', 'message' => 'Lesson ID is required!']);
        exit;
    }
}
?>
