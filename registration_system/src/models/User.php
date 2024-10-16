<?php
// User.php
class User {
    private $db;

    public function __construct($dbconnect) {
        $this->db = $dbconnect;
    }
    
    public function create($fname, $lname, $email, $password) {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $query = "INSERT INTO users (fname, lname, email, password, registration_date) 
                VALUES (?, ?, ?, ?, NOW())"; // Using NOW() to set current date and time
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('ssss', $fname, $lname, $email, $hashed_password);
      return $stmt->execute();
  }
  

    public function getAllUsers() {
        $query = "SELECT fname, lname, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdat FROM users ORDER BY registration_date ASC";
        $result = $this->db->query($query);
        return $result;
    }
}
?>