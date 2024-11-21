<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Document</title>
    <style>
        .navbar {
            background-color: black;
            border-bottom: 1px solid #ddd;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: #7f00ff !important;
        }

        .nav-link {
            color: white !important;
            margin-right: 20px;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            cursor: none;
            color: #7f00ff !important;
            transform: translateY(-5px) scale(1.1);
        }

        .nav-link a.active {
            color: red;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a style="cursor: none" class="navbar-brand" href="home.php"><img src="logo.JPG" width="40px" height="40px"></img> EDUTAINMENT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script>
        function setActiveLink() {
            const navLinks = document.querySelectorAll("nav a");

            let currentSection = "";

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;

                if (pageYOffset >= sectionTop - sectionHeight / 3) {
                    currentSection = section.getAttribute("id");
                }
            });

            navLinks.forEach(link => {
                link.classList.remove("active");
                if (link.getAttribute("href") === `#${currentSection}`) {
                    link.classList.add("active");
                }
            });
        }

        window.addEventListener("scroll", setActiveLink);
    </script>
</body>

</html>