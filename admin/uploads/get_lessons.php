<?php
include '../config.php';

$sql = "SELECT COUNT(*) as total_lessons FROM lessons";
$result = $link->query($sql);

$total = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total = $row['total_lessons'];
}

echo $total;

$link->close();
?>
