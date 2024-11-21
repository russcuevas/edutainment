<?php
$current_page = 'home.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUTAINMENT</title>
    <link rel="stylesheet" href="bootstrap.min.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        /* Gradient background with animation */
        body {
            background: linear-gradient(45deg, #7f00ff, #000000);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            color: #fff;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            position: relative;
            overflow: hidden;
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

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Page container with animation */
        .container {
            border: 2px solid #fff;
            border-radius: 20px;
            padding: 50px;
            width: 600px;
            height: 380px;
            backdrop-filter: blur(5px);
            background-color: rgba(0, 0, 0, 0.6);
            margin-top: 100px;
            opacity: 0;
            animation: fadeIn 2s forwards;
            box-shadow: 0 10px 50px rgba(0, 0, 0, 0.6);
        }

        /* Keyframe for fadeIn */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Heading and paragraph styles */
        h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 20px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.6);
        }

        .lead {
            font-size: 1.25rem;
            color: #fff;
            margin-bottom: 40px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.6);
        }

        /* Button styles with hover effect */
        .btn-primary {
            background-color: #7f00ff;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 50px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #5500b8;
            transform: scale(1.1);
            animation: bounce 1s infinite;
        }

        /* Hover animation for bouncing effect */
        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Center everything in the container */
        .text-center {
            margin-top: 100px;
            text-align: center;
        }

        /* Animation delays */
        .animate-delay-1 {
            animation: fadeInUp 1.5s ease-out;
        }

        .animate-delay-2 {
            animation: fadeInUp 1.5s ease-out 0.5s;
        }

        .animate-delay-3 {
            animation: fadeInUp 1.5s ease-out 1s;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 30px;
            }
        }

        @keyframes gradient {
            0% {
                background-position: 0% 0%;
            }

            50% {
                background-position: 100% 100%;
            }

            100% {
                background-position: 0% 0%;
            }
        }

        .wave {
            background: rgb(255 255 255 / 25%);
            border-radius: 1000% 1000% 0 0;
            position: fixed;
            width: 200%;
            height: 12em;
            animation: wave 10s -3s linear infinite;
            transform: translate3d(0, 0, 0);
            opacity: 0.8;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        .wave:nth-of-type(2) {
            bottom: -1.25em;
            animation: wave 18s linear reverse infinite;
            opacity: 0.8;
        }

        .wave:nth-of-type(3) {
            bottom: -2.5em;
            animation: wave 20s -1s reverse infinite;
            opacity: 0.9;
        }

        @keyframes wave {
            2% {
                transform: translateX(1);
            }

            25% {
                transform: translateX(-25%);
            }

            50% {
                transform: translateX(-50%);
            }

            75% {
                transform: translateX(-25%);
            }

            100% {
                transform: translateX(1);
            }
        }
    </style>
</head>

<body>

    <div class="custom-cursor" id="cursor"></div>

    <div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>

    <div class="container text-center animate__animated animate__fadeIn animate__delay-1s">
        <h1 class="animate__animated animate__fadeInUp animate__delay-1s">WELCOME TO EDUTAINMENT!</h1>
        <p class="lead animate__animated animate__fadeInUp animate__delay-2s">Test your knowledge, challenge your limits, and win the ultimate prize. Are you ready?</p>
        <a style="cursor: none;" href="login.php" class="btn btn-primary btn-lg">Play Now!</a>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Animate.js for animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>
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