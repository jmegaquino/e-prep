<?php
// add_user.php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_number = $_POST['student_number'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $role = $_POST['role']; // Get the selected role from the form

    // Check for duplicates
    $checkDuplicate = "SELECT * FROM users WHERE student_number = '$student_number' OR username = '$username' OR email = '$email'";
    $result = $link->query($checkDuplicate);

    if ($result->num_rows > 0) {
        // Duplicate found
        header("Location: user_management.php?error=Duplicate entry found for student number, username, or email");
    } else {
        // No duplicate found, insert new user with role
        $sql = "INSERT INTO users (student_number, last_name, first_name, username, email, password, role) 
                VALUES ('$student_number', '$last_name', '$first_name', '$username', '$email', '$password', '$role')";

        if ($link->query($sql) === TRUE) {
            header("Location: user_management.php?message=User added successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }
    }
}

$link->close();
?>
