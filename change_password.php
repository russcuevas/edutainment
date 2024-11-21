<?php
include 'db.php'; // Include your database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user data to display (optional, in case you want to show the username, etc.)
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
    $user = mysqli_fetch_assoc(result: $result);

    if (isset($_POST['change_password'])) {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if both passwords match
        if ($new_password == $confirm_password) {
            // Hash the new password before storing it in the database
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            
            // Update the password in the database
            mysqli_query($conn, "UPDATE users SET password = '$hashed_password' WHERE id = $id");

            // Redirect back to manage users page after successful password change
            header('Location: manage_users.php?status=success');
            exit; // Ensure the script stops executing after redirect
        } else {
            $error = "Passwords do not match!";
        }
    }
} else {
    // If no user ID is passed, redirect to manage users page
    header('Location: manage_users.php');
    exit; // Ensure the script stops executing after redirect
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light background color */
        }
        .container {
            margin-top: 50px;
            background-color: #ffffff; /* White background for the form */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }
        h2 {
            color: #343a40; /* Darker text for heading */
        }
        .alert {
            margin-bottom: 20px; /* Space below alerts */
        }
        .btn-primary {
            background-color: #007bff; /* Primary button color */
            border-color: #007bff;
        }
        .btn-secondary {
            background-color: #6c757d; /* Secondary button color */
            border-color: #6c757d;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Change Password for User: <?= htmlspecialchars($user['username']) ?></h2>
    <?php if (isset($error)) { ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php } ?>
    <form method="POST">
        <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
        <a href="manage_users.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
