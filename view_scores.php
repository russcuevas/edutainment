<?php
include 'db.php'; // Include your database connection file

// Fetch users and their scores from the database
$query = "SELECT u.username, COALESCE(SUM(s.score), 0) AS total_score 
          FROM users u 
          LEFT JOIN scores s ON u.id = s.user_id 
          GROUP BY u.id 
          ORDER BY total_score DESC";

$result = mysqli_query($conn, $query);

// Prepare arrays to store usernames and scores
$usernames = [];
$scores = [];

// Fetch the data
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $usernames[] = htmlspecialchars($row['username']); // Store username
        $scores[] = (int)$row['total_score']; // Store score
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Scores |EDUTAINMENT </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js -->
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">EDUTAINMENT </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="view_scores.php">View Scores</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1>User Scores</h1>
    <canvas id="scoreChart" width="400" height="200"></canvas> <!-- Canvas for Chart -->

    <script>
        // Get the data from PHP and pass it to JavaScript
        const usernames = <?php echo json_encode($usernames); ?>;
        const scores = <?php echo json_encode($scores); ?>;

        // Create a bar chart using Chart.js
        const ctx = document.getElementById('scoreChart').getContext('2d');
        const scoreChart = new Chart(ctx, {
            type: 'bar', // Bar chart
            data: {
                labels: usernames, // Usernames as labels
                datasets: [{
                    label: 'Total Score',
                    data: scores, // Scores as the data
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Bar color
                    borderColor: 'rgba(54, 162, 235, 1)', // Border color
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Ensure the y-axis starts at 0
                    }
                }
            }
        });
    </script>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
