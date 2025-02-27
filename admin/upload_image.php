<?php
// Set Content-Type to application/json
header('Content-Type: application/json');

// Check if a file has been uploaded
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $uploadDir = 'uploads/images/'; // Directory where images will be stored
    $uploadedFile = $uploadDir . basename($_FILES['file']['name']);

    // Check if the uploaded file is a valid image
    if (getimagesize($_FILES['file']['tmp_name'])) {
        // Move the uploaded file to the uploads/images directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFile)) {
            // Respond with the full image URL (corrected path to make it accessible from the browser)
            echo json_encode(['location' => 'http://localhost/eprep_revise/admin/' . $uploadedFile]);
        } else {
            // Respond with error if file move failed
            echo json_encode(['error' => 'Error uploading file.']);
        }
    } else {
        // Respond with error if the file is not an image
        echo json_encode(['error' => 'Uploaded file is not an image.']);
    }
} else {
    // Respond with error if no file is uploaded
    echo json_encode(['error' => 'No file uploaded.']);
}
?>
