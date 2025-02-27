<?php
include '../config.php';

// Query to count users
$sql = "SELECT COUNT(*) as total_users FROM users";
$result = $link->query($sql);

$total = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total = $row['total_users'];
}

echo $total;

$link->close();
?>
