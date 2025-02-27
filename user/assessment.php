<?php
// Start session and include database connection
session_start();
include('../config.php');

if (!isset($_GET['lesson_id']) || !isset($_GET['assessment_id'])) {
    echo "<div class='alert alert-danger'>Missing parameters!</div>";
    exit();
}

$lesson_id = intval($_GET['lesson_id']);
$assessment_id = intval($_GET['assessment_id']);

// Fetch assessment details
$query_assessment = "SELECT * FROM assessments WHERE lesson_id = ? AND assessment_id = ?";
$stmt = $link->prepare($query_assessment);
$stmt->bind_param("ii", $lesson_id, $assessment_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='alert alert-danger'>No assessment found for this lesson!</div>";
    exit();
}

$assessment = $result->fetch_assoc();
$time_duration = intval($assessment['time_duration']);
$stmt->close();

// Fetch questions for the assessment
$query_questions = "SELECT * FROM assessment_questions WHERE assessment_id = ?";
$stmt_questions = $link->prepare($query_questions);
$stmt_questions->bind_param("i", $assessment_id);
$stmt_questions->execute();
$result_questions = $stmt_questions->get_result();

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lesson Assessments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Lesson Assessments</h1>

    <!-- Timer Modal -->
    <div class="modal fade" id="timerModal" tabindex="-1" aria-labelledby="timerModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="timerModalLabel">Time Up!</h5>
                </div>
                <div class="modal-body" id="modalMessage">
                    Your answers are being submitted automatically. Please wait...
                </div>
            </div>
        </div>
    </div>

    <!-- Timer Display -->
    <div class="alert alert-info text-center" id="timer">Time Remaining: --:--</div>

    <!-- Assessment Introduction -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h2 class="h5 mb-0"><?php echo htmlspecialchars($assessment['title']); ?></h2>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> <?php echo htmlspecialchars($assessment['description']); ?></p>
            <p><strong>Due Date:</strong> <?php echo htmlspecialchars($assessment['due_date']); ?></p>
            <p><strong>Duration:</strong> <?php echo $time_duration; ?> minutes</p>
        </div>
    </div>

    <!-- Questions Section -->
    <form id="assessment-form" action="submit_assessment.php" method="POST">
        <input type="hidden" name="assessment_id" value="<?php echo $assessment_id; ?>">
        <input type="hidden" name="lesson_id" value="<?php echo $lesson_id; ?>">

        <?php if ($result_questions->num_rows > 0): ?>
            <?php $question_number = 1; ?>
            <?php while ($question = $result_questions->fetch_assoc()): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Question <?php echo $question_number++; ?></h5>
                        <p><?php echo htmlspecialchars($question['question']); ?></p>
                        <input type="hidden" name="question_ids[]" value="<?php echo $question['id']; ?>">

                        <?php foreach (['A', 'B', 'C', 'D'] as $choice): ?>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="answer_<?php echo $question['id']; ?>" value="<?php echo $choice; ?>" required>
                                <label class="form-check-label"><?php echo htmlspecialchars($question["choice_$choice"]); ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="alert alert-warning">No questions found for this assessment!</div>
        <?php endif; ?>
        <?php $stmt_questions->close(); ?>

        <button type="submit" class="btn btn-success mt-3">Submit Assessment</button>
    </form>
</div>


<!-- Exit Warning Modal -->
<div class="modal fade" id="exitWarningModal" tabindex="-1" aria-labelledby="exitWarningLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exitWarningLabel">Exit Warning</h5>
            </div>
            <div class="modal-body">
                If you leave this page, your assessment will be automatically submitted.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelExit">Stay</button>
                <button type="button" class="btn btn-primary" id="confirmExit">Exit & Submit</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
let timeRemaining = <?php echo intval($assessment['time_duration']) * 60; ?>; // Convert minutes to seconds
let isExiting = false; // Track if the user is attempting to exit
let timerExpired = false; // Track if the timer has expired

// Function to start the timer
function startTimer() {
    const timerDisplay = document.getElementById('timer');
    const timerModal = new bootstrap.Modal(document.getElementById('timerModal'), {
        backdrop: 'static',
        keyboard: false
    });

    const timerInterval = setInterval(() => {
        let minutes = Math.floor(timeRemaining / 60);
        let seconds = timeRemaining % 60;

        if (seconds < 10) seconds = '0' + seconds;
        if (minutes < 10) minutes = '0' + minutes;

        timerDisplay.textContent = `Time Remaining: ${minutes}:${seconds}`;

        if (timeRemaining <= 0) {
            clearInterval(timerInterval);
            timerExpired = true; // Set the timer expired flag to true

            // Show modal and submit the form
            timerModal.show();
            setTimeout(() => {
                document.getElementById('assessment-form').submit();
            }, 2000); // Add a slight delay for user awareness
        }

        timeRemaining--;
    }, 1000);
}

startTimer();

// Warn user before leaving only if the timer has not expired
window.addEventListener('beforeunload', (event) => {
    if (!isExiting && !timerExpired) { // Only show the exit warning if timer hasn't expired
        // Cancel the event
        event.preventDefault();
        event.returnValue = ''; // Required for most browsers

        // Show the exit warning modal
        const exitWarningModal = new bootstrap.Modal(document.getElementById('exitWarningModal'));
        exitWarningModal.show();
    }
});

// Modal button actions
document.getElementById('cancelExit').addEventListener('click', () => {
    isExiting = false;
    const exitWarningModal = bootstrap.Modal.getInstance(document.getElementById('exitWarningModal'));
    exitWarningModal.hide();
});

document.getElementById('confirmExit').addEventListener('click', () => {
    isExiting = true;
    document.getElementById('assessment-form').submit(); // Submit the form when exiting
});
</script>

</body>
</html>
