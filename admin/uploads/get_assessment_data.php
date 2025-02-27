<?php
require '../config.php'; // Include your database connection

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Assessment primary key

    // Fetch assessment details
    $assessment_sql = "SELECT * FROM assessments WHERE id = $id";
    $assessment_result = mysqli_query($link, $assessment_sql);
    $assessment = mysqli_fetch_assoc($assessment_result);

    if ($assessment) {
        // Fetch questions related to the assessment
        $assessment_id = $assessment['assessment_id'];
        $questions_sql = "SELECT * FROM assessment_questions WHERE assessment_id = $assessment_id";
        $questions_result = mysqli_query($link, $questions_sql);
        $questions = mysqli_fetch_all($questions_result, MYSQLI_ASSOC);

        // Send response as JSON
        echo json_encode(['assessment' => $assessment, 'questions' => $questions]);
    } else {
        echo json_encode(['error' => 'Assessment not found.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request.']);
}

?>
