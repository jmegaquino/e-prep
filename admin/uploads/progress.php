<?php
require_once '../config.php';

// SQL query to get lesson progress data along with lesson titles from the lessons table
$sql = "
    SELECT 
        v.lesson_id,
        l.title AS lesson_title,
        COUNT(CASE WHEN p.progress_status = 'completed' THEN 1 END) AS completed_users,
        (SELECT COUNT(*) FROM users) AS total_users,
        (COUNT(CASE WHEN p.progress_status = 'completed' THEN 1 END) * 100.0 / (SELECT COUNT(*) FROM users)) AS completion_percentage
    FROM 
        virtual_labs v
    LEFT JOIN 
        progress p ON v.lesson_id = p.lesson_id
    JOIN 
        lessons l ON v.lesson_id = l.id  -- Corrected to use 'l.id' instead of 'l.lesson_id'
    GROUP BY 
        v.lesson_id
";

// Execute query and check for errors
$result = $link->query($sql);

// Check if the query was successful
if (!$result) {
    // If the query failed, output the error and stop the script
    die("Query failed: " . $link->error);
}

// Check if there are results
if ($result->num_rows > 0) {
    // Loop through the results and generate the HTML for each lesson
    while ($row = $result->fetch_assoc()) {
        $lesson_id = $row['lesson_id'];
        $lesson_title = $row['lesson_title'];  // Get the lesson title from the lessons table
        $completed_users = $row['completed_users'];
        $total_users = $row['total_users'];
        $completion_percentage = round($row['completion_percentage'], 2); // Round to 2 decimal places

        // Determine if all users have completed the lab
        $all_completed = ($completed_users == $total_users) ? "Complete!" : "$completion_percentage%";

        // Determine the color for the progress bar
        $progress_color = 'bg-primary'; // Default color

        if ($completion_percentage < 25) {
            $progress_color = 'bg-danger';
        } elseif ($completion_percentage < 50) {
            $progress_color = 'bg-warning';
        } elseif ($completion_percentage < 75) {
            $progress_color = 'bg-info';
        } else {
            $progress_color = 'bg-success';
        }

        // Output the HTML for each lesson, replacing lesson number with title
        echo "
        <h4 class='small font-weight-bold'>
            $lesson_title <span class='float-right'>$all_completed</span>
        </h4>
        <div class='progress mb-4'>
            <div class='progress-bar $progress_color' role='progressbar' style='width: $completion_percentage%' aria-valuenow='$completion_percentage' aria-valuemin='0' aria-valuemax='100'></div>
        </div>";
    }
} else {
    echo "No data available for progress tracking.";
}

// Close the connection
$link->close();
?>
