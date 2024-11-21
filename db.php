<?php
// Database connection details
$servername = "localhost";  // Typically 'localhost'
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password
$dbname = "millionaire_game"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch questions
function fetchQuestions($conn) {
    $query = "SELECT * FROM questions"; // Query to select all questions
    $result = mysqli_query($conn, $query);
    $questions = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $questions[] = $row; // Store each row in the questions array
    }

    return $questions;
}

// Fetch questions from the database
$questions_array = fetchQuestions($conn);
?>
