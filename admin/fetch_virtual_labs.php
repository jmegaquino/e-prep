<?php
// fetch_virtual_labs.php
include('config.php'); // Include database connection

// Check if lesson ID is provided
if (isset($_GET['lessonId'])) {
    $lessonId = $_GET['lessonId'];

    // Query to fetch virtual labs for the selected lesson
    $sql = "SELECT * FROM virtual_labs WHERE lesson_id = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param('i', $lessonId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Array to store virtual labs
    $virtualLabs = [];

    // Fetch labs data
    while ($row = $result->fetch_assoc()) {
        $virtualLabs[] = [
            'id' => $row['id'],
            'lab_type' => $row['lab_type'],
            'lab_data' => $row['lab_data'],  // URL or file path
            'launch_file' => $row['launch_file'] // Launch file for folder type
        ];
    }

    // Return virtual labs as JSON
    echo json_encode(['virtualLabs' => $virtualLabs]);
} else {
    echo json_encode(['virtualLabs' => []]);
}
?>
