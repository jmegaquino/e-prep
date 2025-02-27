<?php
include '../config.php';

// Query to count assessments
$sql = "SELECT COUNT(*) as total_assessments FROM assessments";
$result = $link->query($sql);

$total = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total = $row['total_assessments'];
}

echo $total;

$link->close();
?>
