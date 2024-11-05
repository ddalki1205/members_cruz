<?php
require_once '../config/mysqli_connect.php'; 
require_once '../../src/models/User.php';

$userModel = new User($dbconnect);
$result = $userModel->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/web_design.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <title>Registered Users</title>
</head>
<body>
<div class="wrapper">
    <?php include '../../includes/header_small.php'; ?>

    <main class="main-content">
        <h2 class="main-heading">Registered Users</h2>

        <?php if ($result && $result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Registered Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?></td>
                            <td><?= htmlspecialchars($row['regdat']); ?></td>
                            <td class="td_actions">
                                <a class="edit_button" href="edit_user.php?id=<?=$row['id']; ?>">Edit</a>
                                <a class="delete_button" href="delete_user.php?id=<?=$row['id']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="error">No registered users found.</p>
        <?php endif; ?>

        <?php if (isset($_GET['message'])): ?>
            <p class="success"><?= htmlspecialchars($_GET['message']); ?></p>
        <?php endif; ?>
        
    </main>

    <?php include '../../includes/footer.php'; ?>
</div>
</body>
</html>