<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | EDUTAINMENT</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        /* Minimal and Stylish Look */
        body {
            background: linear-gradient(45deg, #7f00ff, #000000);
            background-size: 500% 500%;
            animation: gradientAnimation 10s ease infinite;
            color: #fff;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            position: relative;
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

        .container {
            border: 2px solid #fff;
            backdrop-filter: blur(5px);
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 20px;
            padding: 50px;
            width: 100%;
            height: auto;
            margin-top: 50px;
            margin-bottom: 50px;
        }

        h1,
        h2 {
            color: #222;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .lead {
            font-size: 1.1rem;
            color: #666;
        }

        .list-group-item {
            background-color: #f9f9f9;
            border: none;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .list-group-item:hover {
            background-color: #e9e9e9;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .text-center {
            margin-top: 30px;
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
    </style>
</head>

<body>
    <div class="custom-cursor" id="cursor"></div>

    <div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>

    <div class="container">
        <h1 style="color: white;">About EDUTAINMENT</h1>
        <p style="color: white;" class="lead">EDUTAINMENT (a fusion of education and entertainment) is your gateway to an educational and entertaining trivia game experience. Learn HTML while you play and challenge your knowledge.</p>

        <h2 style="color: white;">How to Play</h2>
        <ul class="list-group">
            <li class="list-group-item">1. You will face 15 thought-provoking random type questions.</li>
            <li class="list-group-item">2. Each question has 4 possible answers, but only one is correct.</li>
            <li class="list-group-item">3. Answer all 15 questions correctly to win the ultimate prize!</li>
            <li class="list-group-item">4. Use Skip to help you when you're stuck.
            </li>
            <li class="list-group-item">5. Quit anytime and keep your accumulated score.</li>
        </ul>

        <div class="text-center">
            <a style="cursor: none;" href="home.php" class="btn btn-primary">Back to Home</a>
        </div>
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