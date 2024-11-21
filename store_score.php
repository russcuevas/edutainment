<?php
// Include database connection
include 'db.php'; // Ensure this file is in the same directory

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['score']) && isset($_POST['username'])) {
    $score = (int)$_POST['score'];
    $username = $_POST['username'];

    // Find the user ID based on the username
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, insert the score
        $user = $result->fetch_assoc();
        $userId = $user['id'];

        $insert_stmt = $conn->prepare("INSERT INTO scores (user_id, score) VALUES (?, ?)");
        $insert_stmt->bind_param("ii", $userId, $score);

        if ($insert_stmt->execute()) {
            echo "Score saved successfully!";
        } else {
            echo "Error saving score: " . $insert_stmt->error;
        }
        $insert_stmt->close();
    } else {
        echo "User not found!";
    }
    $stmt->close();
}
?>
