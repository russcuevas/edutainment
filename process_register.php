<?php
// process_register.php

// Include the database connection file
include 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));
    $role = 'user'; // Default role

    // Validate input (basic validation)
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        die("All fields are required.");
    }
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute SQL statement to insert user data
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("ssss", $username, $email, $hashed_password, $role); // "ssss" means all parameters are strings

    try {
        // Execute the statement
        $stmt->execute();
        echo "Registration successful!";
        // Optionally redirect to the login page or home page
        header("Location: login.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        // Handle SQL error
        echo "Error: " . $e->getMessage();
    }
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>
