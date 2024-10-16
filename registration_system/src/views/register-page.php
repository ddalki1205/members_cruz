<?php
require_once '../config/mysqli_connect.php'; 
require_once '../controllers/RegisterController.php';

$fn = $ln = $e = $p = $p2 = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fn = trim($_POST['fname']);
    $ln = trim($_POST['lname']);
    $e = trim($_POST['email']);
    $p = trim($_POST['psword1']);
    $p2 = trim($_POST['psword2']);

    $registerController = new RegisterController($dbconnect);
    $errors = $registerController->register($fn, $ln, $e, $p, $p2);

    if (empty($errors)) {
      header("Location: ../views/register-thanks.php");
      exit(); // Important to exit after redirection
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/registration.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <title>Register</title>
</head>

<body> 
        <div style="margin-bottom: 20px;"> <!-- Cancel Registration Button -->
            <a href="../../public/index.php" class="cancel-button">Cancel Registration</a> <!-- Adjust the link as needed -->
        </div>

    <div class="container">
        <h1 class="form-title">Register</h1>

        <?php if (!empty($errors) && is_array($errors)): ?>
          <?php foreach ($errors as $error): ?>
            <p class="error"><?= htmlspecialchars($error); ?></p>
          <?php endforeach; ?>
        <?php endif; ?>


        <form class="registration-form" action="register-page.php" method="post">
            <label for="fname">First Name:</label>
            <input type="text" name="fname" id="fname" class="input-field" value="<?= htmlspecialchars($fn); ?>"><br>

            <label for="lname">Last Name:</label>
            <input type="text" name="lname" id="lname" class="input-field" value="<?= htmlspecialchars($ln); ?>"><br>

            <label for="email">Email:</label>
            <input type="text" name="email" id="email" class="input-field" value="<?= htmlspecialchars($e); ?>"><br>

            <label for="psword1">Password:</label>
            <input type="password" name="psword1" id="psword1" class="input-field"><br>

            <label for="psword2">Confirm Password:</label>
            <input type="password" name="psword2" id="psword2" class="input-field"><br>

            <input type="submit" value="Register" class="submit-button">
        </form>
        
    </div>

</body>

</html>
