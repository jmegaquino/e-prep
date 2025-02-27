<?php
// add_lesson.php
include '../config.php';

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Enable error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Get form data and sanitize inputs
    $lessonTitle = mysqli_real_escape_string($link, strip_tags($_POST['lessonTitle']));
    $lessonDescription = mysqli_real_escape_string($link, strip_tags($_POST['lessonDescription']));

    // Insert the lesson data into the lessons table
    $sql = "INSERT INTO lessons (title, description) VALUES (?, ?)";
    $stmt = $link->prepare($sql);
    if ($stmt === false) {
        die("Error in SQL prepare: " . $link->error);
    }
    $stmt->bind_param("ss", $lessonTitle, $lessonDescription);

    // Execute the statement and check if the lesson was inserted
    if ($stmt->execute()) {
        $lesson_id = $stmt->insert_id; // Get the inserted lesson's ID

        // Process virtual labs
        if (isset($_POST['virtualLabType'])) {
            foreach ($_POST['virtualLabType'] as $index => $virtualLabType) {
                $virtualLabData = null;
                $launchFile = $_POST['launchFile'][$index] ?? null; // Store the file to launch if provided

                // Handle virtual lab data based on type
                if ($virtualLabType === 'embedLink' && isset($_POST['virtualLabLink'][$index])) {
                    $virtualLabData = mysqli_real_escape_string($link, $_POST['virtualLabLink'][$index]);
                } elseif ($virtualLabType === 'uploadFile' && isset($_FILES['virtualLabFile']['tmp_name'][$index])) {
                    $targetDir = "uploads/labs/";
                    $targetFile = $targetDir . basename($_FILES['virtualLabFile']['name'][$index]);
                    if (move_uploaded_file($_FILES['virtualLabFile']['tmp_name'][$index], $targetFile)) {
                        $virtualLabData = $targetFile; // Save the file path
                    }
                } elseif ($virtualLabType === 'uploadFolder' && isset($_FILES['virtualLabFolder']['tmp_name'][$index])) {
                    $zipFile = $_FILES['virtualLabFolder']['tmp_name'][$index];
                    $extractDir = "uploads/labs/" . pathinfo($_FILES['virtualLabFolder']['name'][$index], PATHINFO_FILENAME);
                    mkdir($extractDir, 0777, true);
                    $zip = new ZipArchive;
                    if ($zip->open($zipFile) === TRUE) {
                        $zip->extractTo($extractDir);
                        $zip->close();
                        $virtualLabData = $extractDir;
                    }
                }

                // Insert the virtual lab data into the virtual_labs table
                if ($virtualLabData) {
                    $virtualLab_sql = "INSERT INTO virtual_labs (lesson_id, lab_type, lab_data, launch_file) VALUES (?, ?, ?, ?)";
                    $virtualLab_stmt = $link->prepare($virtualLab_sql);
                    $virtualLab_stmt->bind_param("isss", $lesson_id, $virtualLabType, $virtualLabData, $launchFile);

                    if (!$virtualLab_stmt->execute()) {
                        echo "Error inserting virtual lab: " . $link->error;
                    }

                    $virtualLab_stmt->close();
                }
            }
        }

        // Prepare structured content data and insert it
        foreach ($_POST['contentTitle'] as $index => $title) {
            $sectionTitle = htmlspecialchars($title);
            $sectionBody = $_POST['contentBody'][$index];

            // Insert each content section into the lesson_content table
            $content_sql = "INSERT INTO lesson_content (lesson_id, section_title, section_body) VALUES (?, ?, ?)";
            $content_stmt = $link->prepare($content_sql);
            if ($content_stmt === false) {
                die("Error in content SQL prepare: " . $link->error);
            }
            $content_stmt->bind_param("iss", $lesson_id, $sectionTitle, $sectionBody);

            if (!$content_stmt->execute()) {
                echo "Error inserting content section: " . $link->error;
            }

            $content_stmt->close();
        }

        echo "<script>
                alert('Lesson, content, and virtual labs added successfully!');
                window.location.href = 'lesson_man.php';
              </script>";
    } else {
        // Error inserting lesson
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
mysqli_close($link);
?>
