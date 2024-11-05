<?php
require_once '../config/mysqli_connect.php';
require_once '../../src/models/User.php';

$userModel = new User($dbconnect);
$error = null;
$user = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission for updating user details
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    if ($userModel->updateUser($id, $fname, $lname)) {
        header('Location: register-view-users.php?message=User updated successfully');
        exit;
    } else {
        $error = "Failed to update user.";
    }
} else {
    // Get the user data for the form
    $id = $_GET['id'] ?? null;
    if ($id) {
        $user = $userModel->getUserById($id);
    }
    if (!$user) {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/web_design.css">
    <title>Edit User</title>
</head>
<body>
<div class="wrapper">
    <?php include '../../includes/header_small.php'; ?>
    <main class="main-content">
        <h2 class="main-heading">Edit User</h2>
        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error); ?></p>
        <?php elseif ($user): ?>
            <form method="POST" action="edit_user.php">
                <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']); ?>">
                <label for="fname">First Name:</label>
                <input type="text" name="fname" id="fname" value="<?= htmlspecialchars($user['fname']); ?>" required>
                <br>
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" id="lname" value="<?= htmlspecialchars($user['lname']); ?>" required>
                <br>
                <input type="submit" value="Update">
            </form>
        <?php else: ?>
            <p class="error">User not found.</p>
        <?php endif; ?>
    </main>
    <?php include '../../includes/footer.php'; ?>
</div>
</body>
</html>
