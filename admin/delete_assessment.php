<?php
// delete_assessment.php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($link, $_POST['assessment_id']);

    $sql = "DELETE FROM assessments WHERE assessment_id=$id";
    if (mysqli_query($link, $sql)) {
        header("Location: index.php?message=Assessment deleted successfully");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}
?>
