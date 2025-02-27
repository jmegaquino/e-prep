<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Introduction</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1><?php echo htmlspecialchars($assessment['title']); ?></h1>
        <p><?php echo htmlspecialchars($assessment['description']); ?></p>
        <p>Number of Questions: <?php echo $assessment['num_questions']; ?></p>
        <p>Time Limit: <?php echo $assessment['time_duration']; ?> minutes</p>
        <a href="quiz.php?assessment_id=<?php echo $assessment_id; ?>" class="btn btn-primary">Start Quiz</a>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS (Optional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <!-- Custom JS (Optional) -->
    <script src="js/custom.js"></script>
</body>
</html>
