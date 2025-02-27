<?php
include '../config.php';

if (isset($_GET['id'])) {
    $lessonId = intval($_GET['id']);

    $sql = "SELECT title, description, content, created_at FROM lessons WHERE id = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $lessonId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $lesson = $result->fetch_assoc();
    } else {
        echo "Lesson not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

$link->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($lesson['title']); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($lesson['title']); ?></h1>
    <p><?php echo htmlspecialchars($lesson['description']); ?></p>
    <div><?php echo htmlspecialchars($lesson['content']); ?></div>
    <p><small>Created on: <?php echo htmlspecialchars($lesson['created_at']); ?></small></p>
</body>
</html>
