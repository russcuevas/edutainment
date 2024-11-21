<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | EDUTAINMENT</title>
    <link rel="stylesheet" href="bootstrap.min.css">
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

        .navbar {
            background-color: black;
            border-bottom: 1px solid #ddd;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 9999 !important;
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

        .register-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin-top: 150px;
            margin-bottom: 100px;
        }

        .register-container h1 {
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

        .login-link {
            text-align: center;
            display: block;
            margin-top: 1rem;
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="custom-cursor" id="cursor"></div>
    <!-- Register Form -->
    <div class="register-container" style="background-color: rgba(0, 0, 0, 0.6); backdrop-filter: blur(5px); box-shadow: 0 10px 50px rgba(0, 0, 0, 0.6);">
        <h1 style="color: white;">Register</h1>
        <form action="process_register.php" method="POST">
            <div class="mb-3">
                <label style="color: white;" for="username" class="form-label">Username</label>
                <input style="cursor: none; border: 5px solid #6a11cb;" type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label style="color: white;" for="email" class="form-label">Email address</label>
                <input style="cursor: none; border: 5px solid #6a11cb;" type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label style="color: white;" for="password" class="form-label">Password</label>
                <input style="cursor: none; border: 5px solid #6a11cb;" type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label style="color: white;" for="confirm_password" class="form-label">Confirm Password</label>
                <input style="cursor: none; border: 5px solid #6a11cb;" type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <input type="hidden" name="role" value="user"> <!-- Automatically set the role -->
            <button type="submit" class="btn btn-primary">Register</button>
            <p style="color: white;" class="login-link">Already have an account? <a style="color:#6a11cb; cursor: none;" href="login.php">Login here</a>.</p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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