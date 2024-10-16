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
        <p class="main-paragraph">

        <?php if ($result): ?>
            <table>
                <tr>
                    <td><strong>Name</strong></td>
                    <td><strong>Registered Date</strong></td>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?></td>
                        <td><?= htmlspecialchars($row['regdat']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>

        <?php else: ?>
            <p class="error"> The current users could not be retrieved, contact the system administrator</p>
        <?php endif; ?>

        </p>
    </main>

    <?php include '../../includes/info-col.php'; ?>

    <?php include '../../includes/footer.php'; ?>

</div>
</body>

</html>