<?php
require_once '../config/mysqli_connect.php';
require_once '../../src/models/User.php';

$userModel = new User($dbconnect);

// Get the user ID from the query string
$id = $_GET['id'] ?? null;

if ($id) {
    if ($userModel->deleteUser($id)) {
        header('Location: register-view-users.php?message=User deleted successfully');
        exit;
    } else {
        echo "Failed to delete user.";
    }
} else {
    echo "No user ID provided.";
}
?>