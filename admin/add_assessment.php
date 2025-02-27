<?php
// add_assessment.php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $lesson_id = mysqli_real_escape_string($link, $_POST['lesson_id']);
    $title = mysqli_real_escape_string($link, $_POST['title']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $due_date = mysqli_real_escape_string($link, $_POST['due_date']);
    $time_duration = mysqli_real_escape_string($link, $_POST['time_duration']);
    $num_questions = mysqli_real_escape_string($link, $_POST['num_questions']);

    // Create a unique assessment ID (using current timestamp)
    $assessment_id = time();

    // Insert the new assessment into the assessments table
    $sql = "INSERT INTO assessments (assessment_id, title, description, due_date, time_duration, num_questions, lesson_id) 
            VALUES ('$assessment_id', '$title', '$description', '$due_date', '$time_duration', '$num_questions', '$lesson_id')";

    if (mysqli_query($link, $sql)) {
        // Now handle each question, choices, and correct answers
        for ($i = 0; $i < $num_questions; $i++) {
            // Fetch the question, choices, and correct answer from the POST data
            $question = mysqli_real_escape_string($link, $_POST['questions'][$i]);
            $choices_A = mysqli_real_escape_string($link, $_POST['choices'][$i]['A']);
            $choices_B = mysqli_real_escape_string($link, $_POST['choices'][$i]['B']);
            $choices_C = mysqli_real_escape_string($link, $_POST['choices'][$i]['C']);
            $choices_D = mysqli_real_escape_string($link, $_POST['choices'][$i]['D']);
            $correct_answer = mysqli_real_escape_string($link, $_POST['correct_answers'][$i]);

            // Insert each question's details into a question table (e.g., 'assessment_questions')
            $sql_question = "INSERT INTO assessment_questions (assessment_id, question, choice_A, choice_B, choice_C, choice_D, correct_answer)
                             VALUES ('$assessment_id', '$question', '$choices_A', '$choices_B', '$choices_C', '$choices_D', '$correct_answer')";

            if (!mysqli_query($link, $sql_question)) {
                echo "Error inserting question: " . mysqli_error($link);
                exit; // Stop the process if any error occurs
            }
        }
        
        // Redirect after successful insertion
        header("Location: quiz_management.php?message=Assessment added successfully");
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
?>
