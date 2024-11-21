<?php
include 'db.php';
$users = mysqli_query($conn, "SELECT * FROM users");

if (isset($_POST['delete_user'])) {
    $id = $_POST['id'];
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");
    header('Location: manage_users.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Manage Users</h2>
    <table class="table table-bordered table-hover table-sm">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = mysqli_fetch_assoc($users)) { ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                    <div class="d-flex">
                        <form method="POST" class="me-2">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <button type="submit" name="delete_user" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <a href="change_password.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Change Password</a>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
        <a href="dashboard.php" class="btn btn-secondary mb-4">Back to Dashboard</a>
    </table>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
