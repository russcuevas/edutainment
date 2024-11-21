<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user = $_SESSION['user'];

// Determine if the user is admin or regular user
$isAdmin = $user['role'] == 'admin';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Gradient background for the body */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(45deg, #7f00ff, #000000);
            color: #fff;
            margin: 0;
        }

        /* Sidebar styling */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(45deg, #7f00ff, #000000);
            /* Darker gray for a more neutral feel */
            border-right: 1px solid #444;
            color: #fff;
            padding-top: 20px;
        }

        /* Sidebar Links */
        .sidebar .nav-link {
            color: #adb5bd;
            /* Light gray for normal state */
            padding: 12px;
            font-weight: 500;
            transition: background 0.3s, color 0.3s;
        }

        /* Hover effect for sidebar links */
        .sidebar .nav-link:hover {
            background-color: #495057;
            /* Slightly lighter gray on hover */
            color: #fff;
            /* White color on hover for contrast */
        }

        /* Active link styling */
        .sidebar .nav-link.active {
            background-color: #00d4ff;
            /* Vibrant cyan for active link */
            color: #fff;
        }

        /* Sidebar Heading */
        .sidebar .sidebar-heading {
            font-size: 1rem;
            text-transform: uppercase;
            color: #ced4da;
            /* Soft light gray for heading */
        }

        /* Main content styling */
        .main-content {
            margin-left: 220px;
            padding: 20px;
        }

        .navbar {
            background-color: #000000 !important;
        }

        .navbar-brand {
            color: #fff;
        }

        .navbar-nav .nav-link {
            color: #bbb;
        }

        .navbar-nav .nav-link:hover {
            color: #fff;
        }

        .main-content h1,
        .main-content h2 {
            font-weight: 700;
        }

        /* Card styling */
        .card {
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            background-color: #333;
            color: #fff;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .btn-primary {
            background-color: #7f00ff;
            border-color: #7f00ff;
        }

        .btn-primary:hover {
            background-color: #5500cc;
            border-color: #5500cc;
        }

        /* Alerts */
        .alert-info,
        .alert-success {
            background-color: #444;
            border-color: #555;
            color: #fff;
        }

        /* Responsive Sidebar */
        @media (max-width: 992px) {
            .sidebar {
                position: relative;
                height: auto;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <a style="color: white !important;" class="navbar-brand" href="login.php"><img style="height: 50px;" src="logo.JPG" alt=""> EDUTAINMENT </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a style="color: white !important;" class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li style="margin-top: 70px;" class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="game.php">
                                Play Game
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_scores.php">
                                View Scores
                            </a>
                        </li>

                        <?php if ($isAdmin) { ?>
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span>Admin Section</span>
                            </h6>
                            <li class="nav-item">
                                <a class="nav-link" href="manage_users.php">
                                    Manage Users
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="manage_questions.php">
                                    Manage Questions
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="main-content col-md-9 ms-sm-auto col-lg-10">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Welcome, <?= $user['username']; ?></h1>
                </div>

                <!-- User/ Admin specific content goes here -->
                <?php if ($isAdmin) { ?>
                    <div class="alert alert-info">You have admin privileges.</div>
                <?php } else { ?>
                    <div class="alert alert-success">You are logged in as a user. You can play the game and view your scores.</div>
                <?php } ?>

                <!-- Minimalist cards -->
                <div class="row">
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card p-4">
                            <h5>Play Game</h5>
                            <p>Start playing and test your knowledge.</p>
                            <a href="game.php" class="btn btn-primary">Play Now</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card p-4">
                            <h5>View Scores</h5>
                            <p>Check your current score and performance history.</p>
                            <a href="view_scores.php" class="btn btn-primary">View Scores</a>
                        </div>
                    </div>
                    <?php if ($isAdmin) { ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card p-4">
                                <h5>Manage Users</h5>
                                <p>Admin access to manage user accounts.</p>
                                <a href="manage_users.php" class="btn btn-primary">Manage Users</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card p-4">
                                <h5>Manage Questions</h5>
                                <p>Add, edit, or remove game questions.</p>
                                <a href="manage_questions.php" class="btn btn-primary">Manage Questions</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>