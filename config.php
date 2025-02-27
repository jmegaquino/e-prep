<?php
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "eprep");

# Connection
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

# Check connection
if (!$link) {
  die("Connection failed: " . mysqli_connect_error());
}

# Connect to quiz_db database
define("DB_QUIZ_SERVER", "localhost");
define("DB_QUIZ_USERNAME", "root");
define("DB_QUIZ_PASSWORD", "");
define("DB_QUIZ_NAME", "eprep");

$link_quiz = mysqli_connect(DB_QUIZ_SERVER, DB_QUIZ_USERNAME, DB_QUIZ_PASSWORD, DB_QUIZ_NAME);

# Check connection to quiz_db database
if (!$link_quiz) {
  echo "Connection to database failed: " . mysqli_connect_error() . "<br>";
}


?>