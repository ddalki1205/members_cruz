<?php
require_once '../config/mysqli_connect.php'; // database connection
require_once '../models/User.php'; // User model

class RegisterController {
    private $db;
    private $user;

    public function __construct($dbconnect) {
        $this->db = $dbconnect;
        $this->user = new User($dbconnect);
    }

    public function register($fn, $ln, $e, $p, $p2) {
      $errors = [];
  
      // Validate inputs
      if (empty($fn) || empty($ln) || empty($e) || empty($p) || empty($p2)) {
          $errors[] = "All fields are required.";
      }

      
      if ($p !== $p2) {
        $errors[] = "Passwords do not match.";
    }
  
      // Check if the email already exists
      $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
      $stmt->bind_param("s", $e);
      $stmt->execute();
      $result = $stmt->get_result();
  
      if ($result->num_rows > 0) {
          $errors[] = "Email is already registered.";
      }
  
      if (count($errors) === 0) {
          // Prepare to insert user
          $stmt = $this->db->prepare("INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)");
          $hashedPassword = password_hash($p, PASSWORD_DEFAULT);
          $stmt->bind_param("ssss", $fn, $ln, $e, $hashedPassword);
  
          // Execute the query
          if (!$stmt->execute()) {
              $errors[] = "Error in registration: " . $this->db->error;
          }
      }
  
      return $errors; // Return the array of errors (if any)
  }  
}
?>