<?php
# Initialize session
session_start();

# Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
    echo "<script>" . "window.location.href='../login.php';" . "</script>";
    exit;
}

// Ensure both assessment_id and lesson_id are present in the URL
if (isset($_GET['assessment_id']) && !empty($_GET['assessment_id']) && isset($_GET['lesson_id']) && !empty($_GET['lesson_id'])) {
    $assessment_id = intval($_GET['assessment_id']);
    $lesson_id = intval($_GET['lesson_id']);
    
    // Assuming you are storing scores and total questions in the user_scores table
    include("../config.php");
    
    // Fetch the user's score and total questions from the user_scores table
    $user_id = $_SESSION['id'];
    $query = "SELECT score, total_questions FROM user_scores WHERE user_id = ? AND assessment_id = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param("ii", $user_id, $assessment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // User has attempted the assessment, fetch score and total questions
        $row = $result->fetch_assoc();
        $score = $row['score'];
        $total_questions = $row['total_questions'];
        
        // Calculate the percentage
        $percentage = ($score / $total_questions) * 100;
    } else {
        // If no record found, display an error message
        die("Invalid or no score data found for this assessment.");
    }

    $stmt->close();
} else {
    die("Assessment ID or Lesson ID is missing.");
}

// If the user clicks to retake the assessment, reset the score
if (isset($_POST['retake'])) {
    // Reset the user's score for this assessment
    $resetQuery = "UPDATE user_scores SET score = 0 WHERE user_id = ? AND assessment_id = ?";
    $stmt = $link->prepare($resetQuery);
    $stmt->bind_param("ii", $user_id, $assessment_id);
    
    if ($stmt->execute()) {
        // Include the lesson_id in the redirect URL
        echo "<script>alert('Your score has been reset. You can now retake the assessment.'); window.location.href = 'assessment.php?assessment_id=$assessment_id&lesson_id=$lesson_id';</script>";
    } else {
        echo "Error resetting the score: " . $stmt->error;
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow" style="max-width: 500px; width: 100%;">
            <div class="card-header bg-primary text-white text-center">
                <h1>Your Results</h1>
            </div>
            <div class="card-body text-center">
                <h4 class="card-title">Assessment Summary</h4>
                <p class="card-text">
                    <strong>Score:</strong> <?php echo $score; ?> / <?php echo $total_questions; ?>
                </p>
                <p class="card-text">
                    <strong>Percentage:</strong> <?php echo round($percentage, 2); ?>%
                </p>
                <?php if ($percentage >= 50): ?>
                    <p class="text-success"><strong>Congratulations!</strong> You passed the assessment.</p>
                <?php else: ?>
                    <p class="text-danger"><strong>Unfortunately,</strong> you didn't pass. Better luck next time!</p>
                    <!-- Retake Assessment Button -->
                    <form method="post">
                        <button type="submit" name="retake" class="btn btn-warning mt-3">Retake Assessment</button>
                    </form>
                <?php endif; ?>
                <a href="dashboard.php" class="btn btn-primary mt-3">Back to Dashboard</a>
            </div>
            <div class="card-footer text-center text-muted">
                <small>&copy; E-Prep <?php echo date("Y"); ?></small>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
