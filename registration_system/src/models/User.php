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
        $query = "SELECT fname, lname, id, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdat FROM users ORDER BY registration_date ASC";
        $result = $this->db->query($query);
        return $result;
    }
    
    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function getUserById($id) {
        $query = "SELECT id, fname, lname FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateUser($id, $fname, $lname) {
        $query = "UPDATE users SET fname = ?, lname = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssi', $fname, $lname, $id);
        return $stmt->execute();
    }
}

?>