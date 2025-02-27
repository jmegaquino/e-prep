<?php
// edit_user.php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $student_number = $_POST['student_number'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Check for duplicates excluding the current user ID
    $checkDuplicate = "SELECT * FROM users WHERE (student_number = '$student_number' OR username = '$username' OR email = '$email') AND id != '$id'";
    $result = $link->query($checkDuplicate);

    if ($result->num_rows > 0) {
        // Duplicate found
        header("Location: user_management.php?error=Duplicate entry found for student number, username, or email");
    } else {
        // No duplicate found, update user
        $sql = "UPDATE users SET 
                student_number = '$student_number', 
                last_name = '$last_name', 
                first_name = '$first_name', 
                username = '$username', 
                email = '$email' 
                WHERE id = '$id'";

        if ($link->query($sql) === TRUE) {
            header("Location: user_management.php?message=User updated successfully");
        } else {
            echo "Error updating record: " . $link->error;
        }
    }
}

$link->close();
?>
