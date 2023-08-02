<?php
// Database credentials.
$host = 'localhost';  // Replace with your database host
$username = 'root';   // Replace with your database username
$password = '';       // Replace with your database password
$dbname = 'library';  // Replace with your database name
$port = 3308;         // Replace with your custom MySQL port number

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the connection is successful, you can now execute queries and perform other database operations using the $conn variable.

// Don't forget to close the connection when you're done
$conn->close();
?>
