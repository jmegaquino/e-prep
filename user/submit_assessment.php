<?php
session_start();
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate required fields
    if (!isset($_POST['assessment_id'], $_POST['lesson_id'], $_POST['question_ids'], $_SESSION['id'])) {
        header("Location: error.php?error=missing_data");
        exit();
    }

    $assessment_id = intval($_POST['assessment_id']);
    $lesson_id = intval($_POST['lesson_id']);
    $user_id = $_SESSION['id'];
    $question_ids = $_POST['question_ids'];

    // Fetch total number of questions
    $total_questions = count($question_ids);
    $score = 0;

    try {
        // Prepare queries
        $query_insert = "INSERT INTO user_answers (user_id, assessment_id, question_id, answer) VALUES (?, ?, ?, ?)";
        $query_correct = "SELECT correct_answer FROM assessment_questions WHERE id = ?";
        $query_score = "INSERT INTO user_scores (user_id, assessment_id, score, total_questions) VALUES (?, ?, ?, ?)";
        $query_delete_previous = "DELETE FROM user_answers WHERE user_id = ? AND assessment_id = ?";
        $query_delete_score = "DELETE FROM user_scores WHERE user_id = ? AND assessment_id = ?";

        // Prepare statements
        $stmt_insert = $link->prepare($query_insert);
        $stmt_correct = $link->prepare($query_correct);
        $stmt_score = $link->prepare($query_score);
        $stmt_delete_answers = $link->prepare($query_delete_previous);
        $stmt_delete_score = $link->prepare($query_delete_score);

        // Delete previous data
        $stmt_delete_answers->bind_param("ii", $user_id, $assessment_id);
        $stmt_delete_answers->execute();

        $stmt_delete_score->bind_param("ii", $user_id, $assessment_id);
        $stmt_delete_score->execute();

        // Iterate over each question
        foreach ($question_ids as $question_id) {
            $user_answer = $_POST["answer_$question_id"] ?? null;

            // Skip if no answer is provided
            if ($user_answer === null) {
                continue;
            }

            // Insert user's answer
            $stmt_insert->bind_param("iiis", $user_id, $assessment_id, $question_id, $user_answer);
            $stmt_insert->execute();

            // Check the correct answer
            $stmt_correct->bind_param("i", $question_id);
            $stmt_correct->execute();
            $result_correct = $stmt_correct->get_result();
            if ($result_correct->num_rows > 0) {
                $correct_answer = $result_correct->fetch_assoc()['correct_answer'];

                // Increment score for correct answers
                if ($user_answer === $correct_answer) {
                    $score++;
                }
            }
        }

        // Insert the score
        $stmt_score->bind_param("iiii", $user_id, $assessment_id, $score, $total_questions);
        $stmt_score->execute();

        // Redirect to results page
        header("Location: results.php?lesson_id=$lesson_id&assessment_id=$assessment_id&score=$score&total=$total_questions");
        exit();

    } catch (Exception $e) {
        // Log the error and redirect to an error page
        error_log($e->getMessage());
        header("Location: error.php?error=database_error");
        exit();
    } finally {
        // Close all statements
        $stmt_insert->close();
        $stmt_correct->close();
        $stmt_score->close();
        $stmt_delete_answers->close();
        $stmt_delete_score->close();
        mysqli_close($link);
    }
}
?>
