<?php
// // Database connection parameters
// $host = 'localhost';        
// $dbname = 'quickshop';      
// $username = 'root';         
// $password = '';             

// $servername = "localhost";
// $username = "root";
// $password = "";
// $databasename = "quickshop";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $databasename);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }


// Database connection parameters
$host = 'localhost';        
$dbname = 'quickshop';      
$username = 'root';         
$password = '';             

try {
    // Establish a connection to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error reporting
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Fetch results as associative arrays
} catch (PDOException $e) {
    // If connection fails, terminate script and display error message
    die("Database connection failed: " . $e->getMessage());
}
?>
