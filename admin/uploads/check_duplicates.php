<?php
// check_duplicates.php
include '../config.php';

$response = ['exists' => false, 'field' => ''];
$conditions = [];

if (!empty($_POST['student_number'])) {
    $student_number = $_POST['student_number'];
    $conditions[] = "student_number = '$student_number'";
}
if (!empty($_POST['username'])) {
    $username = $_POST['username'];
    $conditions[] = "username = '$username'";
}
if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    $conditions[] = "email = '$email'";
}

if (!empty($conditions)) {
    $sql = "SELECT * FROM users WHERE (" . implode(" OR ", $conditions) . ")";
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $sql .= " AND id != '$id'";
    }

    $result = $link->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['student_number'] == $student_number) $response = ['exists' => true, 'field' => 'student_number'];
        elseif ($row['username'] == $username) $response = ['exists' => true, 'field' => 'username'];
        elseif ($row['email'] == $email) $response = ['exists' => true, 'field' => 'email'];
    }
}

echo json_encode($response);
$link->close();
?>
