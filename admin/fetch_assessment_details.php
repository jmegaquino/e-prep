<?php
// fetch_assessment_details.php

// Include database connection
include('../config.php');

// Get the assessment_id from the GET or POST request
$assessment_id = isset($_GET['assessment_id']) ? (int)$_GET['assessment_id'] : null;

// Check if the assessment_id is provided
if (!$assessment_id) {
    echo json_encode(['error' => 'No assessment ID provided']);
    exit;
}

// Fetch the assessment details
$query = "SELECT title, description, due_date, time_duration, num_questions, lesson_id 
          FROM assessments 
          WHERE assessment_id = ?";
$stmt = $link->prepare($query);
$stmt->bind_param('i', $assessment_id); // Bind the assessment_id as an integer
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($title, $description, $due_date, $time_duration, $num_questions, $lesson_id);

if ($stmt->num_rows > 0) {
    $stmt->fetch(); // Get the result

    // Fetch assessment questions
    $questions_query = "SELECT question, choice_A, choice_B, choice_C, choice_D, correct_answer 
                        FROM assessment_questions 
                        WHERE assessment_id = ?";
    $questions_stmt = $link->prepare($questions_query);
    $questions_stmt->bind_param('i', $assessment_id); // Bind the assessment_id to the question query
    $questions_stmt->execute();
    $questions_stmt->store_result();
    $questions_stmt->bind_result($question, $choice_A, $choice_B, $choice_C, $choice_D, $correct_answer);

    $questions = [];
    while ($questions_stmt->fetch()) {
        $questions[] = [
            'question' => $question,
            'choice_A' => $choice_A,
            'choice_B' => $choice_B,
            'choice_C' => $choice_C,
            'choice_D' => $choice_D,
            'correct_answer' => $correct_answer
        ];
    }

    $data = [
        'title' => $title,
        'description' => $description,
        'due_date' => $due_date,
        'time_duration' => $time_duration,
        'num_questions' => $num_questions,
        'lesson_id' => $lesson_id,
        'questions' => $questions
    ];

    // Return the data as JSON
    echo json_encode($data);
} else {
    // Return an error message if no data is found
    echo json_encode(['error' => 'No data found for this assessment']);
}
