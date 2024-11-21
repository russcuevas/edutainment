<?php
session_start();
include 'db.php'; // Include database connection


// Handle login submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check for admin credentials
    if ($username === 'admin' && $password === '123admin') {
        // Set session variable for admin
        $_SESSION['user'] = ['username' => $username, 'role' => 'admin'];
        $_SESSION['message'] = ['type' => 'success', 'text' => 'Admin logged in successfully!'];
        header("Location: dashboard.php");
        exit();
    }

    // Prepare and execute a query to find the user
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password (assuming passwords are hashed)
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user'] = $user; // Store user information in session
            $_SESSION['message'] = ['type' => 'success', 'text' => 'User logged in successfully!'];
            // Redirect to the dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Incorrect password.'];
        }
    } else {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'No user found with that username.'];
    }

    $stmt->close();
}
// Check if the user is already logged in
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | EDUTAINMENT</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(45deg, #7f00ff, #000000);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Arial', sans-serif;
            cursor: none;
        }

        .custom-cursor {
            position: absolute;
            width: 32px;
            /* Adjust size of the cursor */
            height: 32px;
            background: url('cursor.gif') no-repeat center center;
            background-size: contain;
            pointer-events: none;
            z-index: 9999;
            transition: transform 0.1s ease-in-out;
        }

        .login-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin-top: 30px;
        }

        .login-container h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 30px;
            padding: 0.75rem 1rem;
        }

        .btn-primary {
            border-radius: 30px;
            padding: 0.75rem;
            width: 100%;
            font-size: 18px;
            background-color: #6a11cb !important;
            border: none;
        }

        .btn-primary:hover {
            background-color: #1d61d1 !important;
            cursor: none !important;
        }

        .form-label {
            font-weight: bold;
            color: #555;
        }

        .register-link {
            text-align: center;
            display: block;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="custom-cursor" id="cursor"></div>
    <!-- Login Form -->
    <div class="login-container" style="background-color: rgba(0, 0, 0, 0.6); backdrop-filter: blur(5px); box-shadow: 0 10px 50px rgba(0, 0, 0, 0.6);">
        <h1 style="color: white;">Login</h1>

        <form action="login.php" method="POST">
            <div class="mb-3">
                <label style="color: white;" for="username" class="form-label">Username</label>
                <input style="cursor: none; border: 5px solid #6a11cb;" type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label style="color: white;" for="password" class="form-label">Password</label>
                <input style="cursor: none; border: 5px solid #6a11cb;" type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <p style="color: white;" class="register-link">Don't have an account? <a style="color:#6a11cb; cursor: none" href="register.php">Register here</a>.</p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($_SESSION['message'])): ?>
                const message = <?= json_encode($_SESSION['message']); ?>;
                Swal.fire({
                    icon: message.type,
                    title: message.type === 'success' ? 'Success!' : 'Error!',
                    text: message.text,
                    confirmButtonText: 'OK'
                });
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
        });
    </script>

    <script>
        const cursor = document.getElementById('cursor');

        // Update cursor position on mouse move
        document.addEventListener('mousemove', (e) => {
            cursor.style.left = `${e.pageX - cursor.offsetWidth / 2}px`;
            cursor.style.top = `${e.pageY - cursor.offsetHeight / 2}px`;
        });

        // Optional: Add hover effect to make cursor slightly bigger when hovering over links
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('mouseenter', () => {
                cursor.style.transform = 'scale(1.5)';
            });
            link.addEventListener('mouseleave', () => {
                cursor.style.transform = 'scale(1)';
            });
        });
    </script>
</body>

</html>