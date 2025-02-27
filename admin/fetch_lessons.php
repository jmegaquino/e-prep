<?php
// Include the database configuration file
include('../config.php');

// Initialize an empty array to store the lessons
$lessons = [];

// Fetch lessons from the database
$query = "SELECT id, title FROM lessons";  // Adjust the table/column names as per your database schema
$result = mysqli_query($link, $query);

// Check if the query was successful
if ($result) {
    // Fetch each lesson and add it to the $lessons array
    while ($row = mysqli_fetch_assoc($result)) {
        $lessons[] = $row;
    }
}

// Return the lessons as a JSON response
echo json_encode($lessons);

// Close the database connection
mysqli_close($link);
?>
