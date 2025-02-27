<?php
# Initialize the session
session_start();

# If user is not logged in then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
  echo "<script>" . "window.location.href='../login';" . "</script>";
  exit;
}

// Include database connection
require_once "../config.php";

// Function to generate quiz link
function generateQuizLink($quizTable) {
    // Assuming your quiz pages are named quiz.php and you pass the quiz table name as a query parameter
    return "quiz?table=$quizTable";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-prep Certificate</title>
    <link rel="stylesheet" href="css/cert.css">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">

    <style>
        input{
            color: gray;
        }

        textarea:focus, input:focus{
            outline: none;
        }
    </style>

</head>

<body>
    <div class="container">
        <form action="#" id="form">
            <div class="first-name">
                <label for="fname"> First Name: <br>
                    <input type="text" name="fname" id="fname" value="<?= htmlspecialchars($_SESSION["first_name"]); ?>" readonly>
                </label>
            </div>
            <div class="last-name">
                <label for="lname"> Last Name: <br>
                    <input type="text" name="lname" id="lname" value="<?= htmlspecialchars($_SESSION["last_name"]);?>" readonly>
                </label>
            </div>
            <div class="btn">
                <button id="Generate" type="submit">Generate</button>
            </div>
        </form>

        <div id="certificate">
        </div>
        <button id="download" style="margin-bottom: 20px;">Download PDF</button>
    </div>
    
    <script>
        window.onload = function() {
            document.getElementById('Generate').click();
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="js/cert.js"></script>


</body>

</html>