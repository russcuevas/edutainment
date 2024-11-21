$(document).ready(function () {
    // Start the game when the "Start Game" button is clicked
    $('#startGameBtn').click(function () {
        $('#introModal').modal('hide');
        $('#question-section').show();
        showQuestion();
    });

    // Add animation for the timer countdown
    function updateTimer() {
        $('#timer').fadeOut(200, function () {
            $('#timer').text(`Time left: ${timeRemaining} seconds`).fadeIn(200);
        });
    }

    function startTimer() {
        timer = setInterval(function () {
            timeRemaining--;
            updateTimer();  // Update and animate the timer text

            if (timeRemaining <= 0) {
                clearInterval(timer);
                checkAnswer(null);  // Check answer when time is up
            }
        }, 1000);
    }

    // For smoother transition, add fade-out effect on question change
    function showQuestion() {
        if (currentQuestion < questions.length) {
            timeRemaining = maxTime;
            updateTimer();  // Update and animate the timer
            const question = questions[currentQuestion];

            $('#question').fadeOut(200, function () {
                $(this).text(question.question).fadeIn(200);
            });

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
            alert("Game Over! Your score: " + score);
            $('#question-section').hide();
            $('#save-section').show();
        }
    }
});
