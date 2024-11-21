<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Questions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
// Database connection
include 'db.php'; // Include your database connection file

// Fetch questions from the database
$query = "SELECT * FROM questions"; // Replace 'questions' with your table name
$questions = mysqli_query($conn, $query);

// Check if the query was successful
if (!$questions) {
    die("Query failed: " . mysqli_error($conn));
}

// Handle form submissions
if (isset($_POST['add_question'])) {
    $question_type = $_POST['question_type'];
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    
    if ($question_type == 'multiple_choice') {
        $option_a = $_POST['option_a'];
        $option_b = $_POST['option_b'];
        $option_c = $_POST['option_c'];
        $option_d = $_POST['option_d'];
        $correct_option = $_POST['correct_option'];

        $query = "INSERT INTO questions (question_type, question, option_a, option_b, option_c, option_d, correct_option)
                  VALUES ('multiple_choice', '$question', '$option_a', '$option_b', '$option_c', '$option_d', '$correct_option')";
        
    } elseif ($question_type == 'flashcard') {
        $flashcard_answer = $_POST['flashcard_answer'];
        
        $query = "INSERT INTO questions (question_type, question, answer) 
                  VALUES ('flashcard', '$question', '$flashcard_answer')";
        
    } elseif ($question_type == 'four_pics_one_word') {
        $four_pics_answer = $_POST['four_pics_answer'];
        $image_paths = [];
        
        // Handle image upload
        foreach ($_FILES['images']['tmp_name'] as $index => $tmp_name) {
            $file_name = basename($_FILES['images']['name'][$index]);
            $file_path = "uploads/" . $file_name; // Make sure 'uploads' directory exists
            move_uploaded_file($tmp_name, $file_path);
            $image_paths[] = $file_path;
        }
        
        // Store image paths as a comma-separated string
        $images = implode(',', $image_paths);
        
        $query = "INSERT INTO questions (question_type, question, images, answer) 
                  VALUES ('four_pics_one_word', '$question', '$images', '$four_pics_answer')";
    }

    // Execute query
    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>Question added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}

// Handle deleting a question
if (isset($_POST['delete_question'])) {
    $id = $_POST['id'];
    $delete_query = "DELETE FROM questions WHERE id = $id";
    if (mysqli_query($conn, $delete_query)) {
        echo "<div class='alert alert-success'>Question deleted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting question: " . mysqli_error($conn) . "</div>";
    }
}
?>

<div class="container mt-5">
    <h2>Manage Questions</h2>
    
    <!-- Back to Dashboard Button -->
    <a href="dashboard.php" class="btn btn-secondary mb-4">Back to Dashboard</a>

    <!-- Add Question Form -->
    <form method="POST" class="mb-4" enctype="multipart/form-data">
        <h4>Add New Question</h4>
        
        <!-- Question Type Selector -->
        <div class="mb-3">
            <label for="question_type" class="form-label">Question Type</label>
            <select class="form-select" id="question_type" name="question_type" required>
                <option value="multiple_choice">Multiple Choice</option>
                <option value="flashcard">Flashcard</option>
                <option value="four_pics_one_word">Four Pics One Word</option>
            </select>
        </div>
        
        <!-- Question Text -->
        <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <input type="text" class="form-control" id="question" name="question">
        </div>

        <!-- Multiple Choice Options (Only shown for Multiple Choice) -->
        <div id="multiple_choice_options" class="mb-3">
            <label for="option_a" class="form-label">Option A</label>
            <input type="text" class="form-control" id="option_a" name="option_a">
            
            <label for="option_b" class="form-label">Option B</label>
            <input type="text" class="form-control" id="option_b" name="option_b">
            
            <label for="option_c" class="form-label">Option C</label>
            <input type="text" class="form-control" id="option_c" name="option_c">
            
            <label for="option_d" class="form-label">Option D</label>
            <input type="text" class="form-control" id="option_d" name="option_d">
            
            <label for="correct_option" class="form-label">Correct Option</label>
            <select class="form-select" id="correct_option" name="correct_option">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
        </div>
        
        <!-- Flashcard Answer (Only shown for Flashcard) -->
        <div id="flashcard_answer" class="mb-3" style="display: none;">
            <label for="flashcard_answer" class="form-label">Flashcard Answer</label>
            <input type="text" class="form-control" id="flashcard_answer" name="flashcard_answer">
        </div>
        
        <!-- Four Pics One Word Images (Only shown for Four Pics One Word) -->
        <div id="four_pics_one_word" class="mb-3" style="display: none;">
            <label for="images" class="form-label">Upload 4 Images</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple >
            
            <label for="answer" class="form-label">Answer</label>
            <input type="text" class="form-control" id="four_pics_answer" name="four_pics_answer" >
        </div>
        
        <button type="submit" name="add_question" class="btn btn-primary">Add Question</button>
    </form>

    <!-- Display and Manage Questions -->
    <h4>All Questions</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Details</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are questions and display them
            if (mysqli_num_rows($questions) > 0) {
                while ($row = mysqli_fetch_assoc($questions)) { ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['question']; ?></td>
                <td>
                    <?php if ($row['question_type'] == 'multiple_choice') { ?>
                        <strong>Options:</strong><br>
                        A: <?= $row['option_a']; ?><br>
                        B: <?= $row['option_b']; ?><br>
                        C: <?= $row['option_c']; ?><br>
                        D: <?= $row['option_d']; ?><br>
                        <strong>Correct Answer:</strong> <?= $row['correct_option']; ?>
                    <?php } elseif ($row['question_type'] == 'flashcard') { ?>
                        <strong>Answer:</strong> <?= $row['answer']; ?>
                    <?php } elseif ($row['question_type'] == 'four_pics_one_word') { ?>
                        <strong>Images:</strong><br>
                        <?php
                        $images = explode(',', $row['images']);
                        foreach ($images as $image) {
                            echo "<img src='$image' alt='Image' width='100'><br>";
                        }
                        ?>
                        <strong>Answer:</strong> <?= $row['answer']; ?>
                    <?php } ?>
                </td>
                <td>
                    <!-- Delete Form -->
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <button type="submit" name="delete_question" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            <?php } 
            } else { ?>
                <tr><td colspan="4">No questions found.</td></tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
document.getElementById('question_type').addEventListener('change', function() {
    const questionType = this.value;

    // Toggle visibility of question type-specific fields
    document.getElementById('multiple_choice_options').style.display = questionType === 'multiple_choice' ? 'block' : 'none';
    document.getElementById('flashcard_answer').style.display = questionType === 'flashcard' ? 'block' : 'none';
    document.getElementById('four_pics_one_word').style.display = questionType === 'four_pics_one_word' ? 'block' : 'none';

    // Add or remove 'required' attribute based on selected question type
    const imagesInput = document.getElementById('images');
    const answerInput = document.getElementById('four_pics_answer');

    if (questionType === 'four_pics_one_word') {
        imagesInput.setAttribute('required', 'required');
        answerInput.setAttribute('required', 'required');
    } else {
        imagesInput.removeAttribute('required');
        answerInput.removeAttribute('required');
    }
});


</script>

</body>
</html>
