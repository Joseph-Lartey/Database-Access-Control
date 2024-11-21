<?php
// Database connection parameters
$host = 'localhost';        
$dbname = 'quickshop';      
$username = 'root';         
$password = '';             

$servername = "localhost";
$username = "root";
$password = "";
$databasename = "quickshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $databasename);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
