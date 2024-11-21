<?php
// Include database connection
include 'db.php'; // Ensure this file is in the same directory



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['score'])) {
    // Store the score in the database
    $score = (int)$_POST['score'];

    // Prepare and execute the insert query
    $stmt = $conn->prepare("INSERT INTO scores (user_id, score) VALUES (?, ?)");
    $stmt->bind_param("ii", $userId, $score);

    if ($stmt->execute()) {
        echo "Score stored successfully!";
    } else {
        echo "Error storing score: " . $stmt->error;
    }
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUTAINMENT </title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Custom CSS for Minimalist Game Design -->
    <style>
        body {
            background: linear-gradient(45deg, #7f00ff, #000000);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            font-family: 'Arial', sans-serif;
        }

        /* Styles for the countdown */
        #countdown {
            position: fixed;
            /* Position it relative to the screen */
            top: 50%;
            /* Center it vertically */
            left: 50%;
            /* Center it horizontally */
            transform: translate(-50%, -50%);
            /* Perfect centering */
            z-index: 1000;
            /* Make sure it's above other content */
            font-size: 3rem;
            font-weight: bold;
            color: white;
        }

        /* Styles for the blurred backdrop */
        #backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Semi-transparent black background */
            backdrop-filter: blur(10px);
            /* Apply the blur effect */
            z-index: 999;
            /* Place the backdrop behind the countdown */
        }


        .container {
            max-width: 700px;
            margin-top: 40px;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .lead {
            font-size: 1.2rem;
            font-weight: 900;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 1rem;
            width: 100%;
            margin-bottom: 15px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004080;
        }

        .btn-success {
            background-color: #28a745;
            font-size: 1rem;
            width: 100%;
            margin-top: 15px;
        }

        .modal-content {
            border: none;
            border-radius: 8px;
            background-color: #fff;
        }

        #timer {
            text-align: center;
            font-size: 1.5rem;
            color: #d9534f;
            font-weight: bold;
        }

        .form-control {
            margin-top: 10px;
            border-radius: 5px;
            font-size: 1rem;
        }

        /* Image Styling */
        #imageContainer img {
            width: 100px;
            height: 100px;
            margin: 10px;
            border-radius: 10px;
            border: 2px solid #ddd;
        }

        /* Option buttons styling */
        .btn-choice {
            background-color: #f8f9fa;
            color: #333;
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .btn-choice:hover {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
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
    <nav style="background-color: #000000 !important;" class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a style="color: #7f00ff !important;" class="navbar-brand" href="dashboard.php">EDUTAINMENT </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link active" href="view_scores.php">View Scores</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
    <div class="container">
        <h1 style="color: white">EDUTAINMENT</h1>

        <!-- Introduction Modal -->
        <div class="modal fade" id="introModal" tabindex="-1" aria-labelledby="introModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p-4">
                    <h5 class="modal-title mb-3" id="introModalLabel">Welcome!</h5>
                    <p>Answer the questions to win virtual money! Each correct answer earns you 100 points. Good luck!</p>
                    <button type="button" class="btn btn-primary w-100 mt-3" id="startGameBtn">Start Game</button>
                </div>
            </div>
        </div>

        <!-- Timer display -->
        <div id="timer" class="lead mt-2"></div>

        <!-- Skip Button -->
        <button class="btn btn-warning mt-3" onclick="skipQuestion()">Skip</button> <!-- Skip button -->
        <!-- Question Section -->
        <div id="question-section" class="mt-4" style="display: none;">
            <div id="question-container">
                <p id="question" class="lead"></p>
                <!-- Multiple choice options -->
                <div id="multiple-choice-options" class="row">
                    <button id="optionA" class="btn btn-choice col-12" onclick="checkAnswer('A')"></button>
                    <button id="optionB" class="btn btn-choice col-12" onclick="checkAnswer('B')"></button>
                    <button id="optionC" class="btn btn-choice col-12" onclick="checkAnswer('C')"></button>
                    <button id="optionD" class="btn btn-choice col-12" onclick="checkAnswer('D')"></button>
                </div>

                <!-- Flashcard question -->
                <div id="flashcard-answer" class="mt-3" style="display: none;">
                    <input type="text" id="flashcardInput" class="form-control" placeholder="Enter your answer">
                    <button class="btn btn-primary mt-2" onclick="checkFlashcardAnswer()">Submit</button>
                </div>

                <!-- Four Pics One Word -->
                <div id="four-pics-one-word" style="display: none;">
                    <div id="imageContainer" class="d-flex justify-content-center"></div>
                    <input type="text" id="fourPicsInput" class="form-control mt-3" placeholder="Guess the word">
                    <button class="btn btn-primary mt-2" onclick="checkFourPicsAnswer()">Submit</button>
                </div>

            </div>
        </div>

        <!-- Save Score Section -->
        <div id="save-section" class="mt-4" style="display: none;">
            <label style="color: white" for="username">Enter your username:</label>
            <input type="text" id="username" class="form-control" placeholder="Enter your username">
            <button id="saveScoreBtn" class="btn btn-success mt-2" onclick="saveScore()">Save Score</button>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let currentQuestion = 0;
        let score = 0;
        let timer;
        const maxTime = 45;
        let timeRemaining = maxTime;

        const questions = <?php echo json_encode($questions_array); ?>;

        function showQuestion() {
            if (currentQuestion < questions.length) {
                timeRemaining = maxTime;
                document.getElementById('timer').innerHTML = `💣💣 Time left: ${timeRemaining} seconds 💣💣`;

                const question = questions[currentQuestion];
                document.getElementById('question').innerText = question.question;

                switch (question.question_type) {
                    case 'multiple_choice':
                        showMultipleChoice(question);
                        break;
                    case 'flashcard':
                        showFlashcard();
                        break;
                    case 'four_pics_one_word':
                        showFourPicsOneWord(question);
                        break;
                }

                startTimer();
            } else {
                let trophyImage = '';
                let trophyAlt = '';
                let titleMessage = '';
                let message = '';
                let imageUrl = '';

                if (score >= 300) {
                    trophyImage = 'gold-trophy.gif';
                    trophyAlt = 'Gold Trophy';
                    titleMessage = 'Congratulations';
                    message = `Great job! You earned a Gold Trophy!. Your final score is: ${score}`;
                    imageUrl = 'fireworks.gif';
                } else if (score >= 200) {
                    trophyImage = 'trophy-silver.gif';
                    trophyAlt = 'Silver Trophy';
                    titleMessage = 'Congratulations';
                    message = `Well done! You earned a Silver Trophy!. Your final score is: ${score}`;
                    imageUrl = 'fireworks.gif';
                } else if (score >= 1) {
                    trophyImage = 'bronze-trophy.gif';
                    trophyAlt = 'Bronze Trophy';
                    titleMessage = 'Congratulations';
                    message = `Good effort! You earned a Bronze Trophy!. Your final score is: ${score}`;
                    imageUrl = 'fireworks.gif';
                } else {
                    trophyImage = '';
                    trophyAlt = '';
                    titleMessage = 'Game Over!!';
                    message = `Sorry, you didn't earn a trophy. Your final score is: ${score}`;
                    imageUrl = 'nicetry.gif';
                }

                Swal.fire({
                    title: titleMessage,
                    html: `
                <p>${message}</p>
                ${trophyImage ? `<img src="${trophyImage}" alt="${trophyAlt}" style="width: 150px; margin-top: 20px;" />` : ''}
            `,
                    imageUrl: imageUrl, // This dynamically sets the image to either fireworks or nicetry based on score
                    imageWidth: 200, // Adjust the size of the gif as needed
                    imageHeight: 200, // Adjust the size of the gif as needed
                    showConfirmButton: false,
                    timer: 10000
                });

                document.getElementById('timer').style.display = 'none';
                document.querySelector('.btn-warning').style.display = 'none';

                // Hide the question section and show the score-saving section
                $('#question-section').hide();
                $('#save-section').show();
            }
        }





        function showMultipleChoice(question) {
            document.getElementById('multiple-choice-options').style.display = 'block';
            document.getElementById('flashcard-answer').style.display = 'none';
            document.getElementById('four-pics-one-word').style.display = 'none';

            document.getElementById('optionA').innerText = question.option_a;
            document.getElementById('optionB').innerText = question.option_b;
            document.getElementById('optionC').innerText = question.option_c;
            document.getElementById('optionD').innerText = question.option_d;
        }

        function showFlashcard() {
            document.getElementById('multiple-choice-options').style.display = 'none';
            document.getElementById('flashcard-answer').style.display = 'block';
            document.getElementById('four-pics-one-word').style.display = 'none';
        }

        function showFourPicsOneWord(question) {
            document.getElementById('multiple-choice-options').style.display = 'none';
            document.getElementById('flashcard-answer').style.display = 'none';
            document.getElementById('four-pics-one-word').style.display = 'block';

            const imageContainer = document.getElementById('imageContainer');
            imageContainer.innerHTML = ''; // Clear previous images
            const images = question.images.split(',');
            images.forEach(img => {
                const imgElement = document.createElement('img');
                imgElement.src = img;
                imgElement.style.width = '100px';
                imgElement.style.margin = '5px';
                imageContainer.appendChild(imgElement);
            });
        }

        function checkAnswer(selectedOption) {
            clearInterval(timer);
            const question = questions[currentQuestion];
            if (selectedOption === question.correct_option) {
                score += 100;
                Swal.fire({
                    icon: 'success',
                    title: 'Correct!',
                    text: 'You earned 100 points!',
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Wrong Answer!',
                    text: `The correct answer is: ${question.correct_option}`,
                    timer: 3000,
                    showConfirmButton: false
                });
            }
            currentQuestion++;
            setTimeout(showQuestion, 3000); // Delay before showing the next question
        }

        function checkFlashcardAnswer() {
            const userAnswer = document.getElementById('flashcardInput').value;
            const question = questions[currentQuestion];
            clearInterval(timer);
            if (userAnswer.toLowerCase() === question.answer.toLowerCase()) {
                score += 100;
                Swal.fire({
                    icon: 'success',
                    title: 'Correct!',
                    text: 'You earned 100 points!',
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Wrong Answer!',
                    text: `The correct answer is: ${question.answer}`,
                    timer: 3000,
                    showConfirmButton: false
                });
            }
            currentQuestion++;
            setTimeout(showQuestion, 3000); // Delay before showing the next question
        }

        function checkFourPicsAnswer() {
            const userAnswer = document.getElementById('fourPicsInput').value;
            const question = questions[currentQuestion];
            clearInterval(timer);
            if (userAnswer.toLowerCase() === question.answer.toLowerCase()) {
                score += 100;
                Swal.fire({
                    icon: 'success',
                    title: 'Correct!',
                    text: 'You earned 100 points!',
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Wrong Answer!',
                    text: `The correct answer is: ${question.answer}`,
                    timer: 3000,
                    showConfirmButton: false
                });
            }
            currentQuestion++;
            setTimeout(showQuestion, 3000); // Delay before showing the next question
        }


        function startTimer() {
            timer = setInterval(function() {
                timeRemaining--;
                document.getElementById('timer').innerText = `💣💣 Time left: ${timeRemaining} seconds 💣💣`;

                if (timeRemaining <= 0) {
                    clearInterval(timer);
                    checkAnswer(null);
                }
            }, 1000);
        }

        // Skip question without affecting score
        function skipQuestion() {
            clearInterval(timer); // Stop the timer
            currentQuestion++;
            showQuestion(); // Proceed to the next question
        }

        let countdownAudio; // Global variable for countdown sound
        let gameSound; // Global variable for game sound

        function saveScore() {
            const username = document.getElementById('username').value;
            if (username) {
                // Mute or pause the game sound when saving the score
                if (gameSound) {
                    gameSound.pause(); // Stop the game sound
                    gameSound.currentTime = 0; // Optionally reset the sound to the beginning
                }

                if (countdownAudio) {
                    countdownAudio.pause(); // Stop the countdown sound
                    countdownAudio.currentTime = 0; // Optionally reset the sound to the beginning
                }

                $.post("store_score.php", {
                    score: score,
                    username: username
                }, function(response) {
                    alert(response);
                });
            } else {
                // Replace the alert with SweetAlert warning
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops!',
                    text: 'Please enter a username.',
                    confirmButtonColor: '#ffcc00' // Optional: Adjust button color
                });
            }
        }


        $(document).ready(function() {
            $('#introModal').modal('show');

            $('#startGameBtn').click(function() {
                $('#introModal').modal('hide'); // Hide the intro modal
                $('#question-section').show(); // Show the question section

                // Create a countdown element
                const countdownElement = $('<div id="countdown" class="lead" style="font-size: 150px; text-align: center; color: white;"></div>');
                const backdrop = $('<div id="backdrop"></div>'); // Create a backdrop for the blur effect

                $('body').append(countdownElement); // Append countdown to the body
                $('body').append(backdrop); // Append backdrop to the body

                let countdownNumber = 3; // Start countdown from 3
                countdownElement.text(countdownNumber); // Display countdown

                // Create an audio element for quiz start sound (3, 2, 1 countdown)
                countdownAudio = new Audio('quiz-start.mp3');
                countdownAudio.play(); // Play the sound immediately when the countdown starts

                // Countdown function
                const countdownInterval = setInterval(function() {
                    countdownNumber--;
                    countdownElement.text(countdownNumber); // Update countdown number

                    // Play the countdown sound every time the number changes (except at the end)
                    if (countdownNumber > 0) {
                        countdownAudio.play(); // Play sound for each countdown step
                    }

                    if (countdownNumber <= 0) {
                        clearInterval(countdownInterval); // Stop the countdown
                        countdownElement.remove(); // Remove countdown element
                        backdrop.remove(); // Remove the backdrop

                        // Play the game sound after countdown ends
                        gameSound = new Audio('game-sound.mp3');
                        gameSound.play(); // Play the game sound

                        showQuestion(); // Start the game after countdown ends
                    }
                }, 1000); // Update every second (1000ms)
            });
        });
    </script>
</body>

</html>