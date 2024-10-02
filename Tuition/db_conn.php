<?php
$host = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "lms_database"; // The database you just created

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>