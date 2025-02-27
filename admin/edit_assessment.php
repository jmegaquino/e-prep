<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get assessment details
    $id = $_POST['id'];
    $lesson_id = $_POST['lesson_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $time_duration = $_POST['time_duration'];
    $num_questions = $_POST['num_questions'];

    // Update the assessments table
    $updateAssessmentQuery = "
        UPDATE assessments 
        SET 
            lesson_id = ?, 
            title = ?, 
            description = ?, 
            due_date = ?, 
            time_duration = ?, 
            num_questions = ?
        WHERE id = ?";
    $stmt = $link->prepare($updateAssessmentQuery);
    $stmt->bind_param("isssiii", $lesson_id, $title, $description, $due_date, $time_duration, $num_questions, $id);
    if (!$stmt->execute()) {
        die("Error updating assessment: " . $stmt->error);
    }

    // Remove existing questions for the assessment
    $deleteQuestionsQuery = "DELETE FROM assessment_questions WHERE assessment_id = ?";
    $stmt = $link->prepare($deleteQuestionsQuery);
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        die("Error deleting old questions: " . $stmt->error);
    }

    // Add updated questions
    if (!empty($_POST['questions'])) {
        $questions = $_POST['questions'];
        $choiceAs = $_POST['choice_A'];
        $choiceBs = $_POST['choice_B'];
        $choiceCs = $_POST['choice_C'];
        $choiceDs = $_POST['choice_D'];
        $correctAnswers = $_POST['correct_answer'];

        $insertQuestionQuery = "
            INSERT INTO assessment_questions 
            (assessment_id, question, choice_A, choice_B, choice_C, choice_D, correct_answer) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $link->prepare($insertQuestionQuery);

        foreach ($questions as $index => $question) {
            $choiceA = $choiceAs[$index];
            $choiceB = $choiceBs[$index];
            $choiceC = $choiceCs[$index];
            $choiceD = $choiceDs[$index];
            $correctAnswer = $correctAnswers[$index];

            $stmt->bind_param("issssss", $id, $question, $choiceA, $choiceB, $choiceC, $choiceD, $correctAnswer);
            if (!$stmt->execute()) {
                die("Error inserting questions: " . $stmt->error);
            }
        }
    }

    // Redirect to the assessments page with a success message
    header("Location: quiz_management.php?status=success");
    exit();
}
?>
