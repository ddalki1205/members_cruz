<?php

$host = 'localhost'; 
$user = '201cruz'; 
$password = 'cruz'; 
$database = 'members_cruz';


$dbconnect = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$dbconnect) {
  die('Connection failed: ' . mysqli_connect_error());
}


/* put in http://localhost/phpmyadmin -> registration_system -> SQL query box
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    registration_date DATETIME NOT NULL
);
*/
?>