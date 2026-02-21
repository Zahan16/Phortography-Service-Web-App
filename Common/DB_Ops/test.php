<?php
// Error reporting settings
ini_set('display_errors', 1); // Display errors to the browser for debugging
ini_set('log_errors', 1); // Log errors to the server's error log
error_reporting(E_ALL); // Report all PHP errors

// Include your database connection script
include 'conn.php'; // Adjust the path as needed

// Test the connection
if ($conn->connect_error) {
    // If there is a connection error, output the error message
    die("Connection failed: " . $conn->connect_error);
} else {
    // If connection is successful, output a success message
    echo "Connected successfully to the database.";
}

// Optionally, you can test a simple query to ensure the connection is fully functional
$result = $conn->query("SELECT 1");
if ($result) {
    echo "Query executed successfully.";
} else {
    echo "Query failed: " . $conn->error;
}

// Close the connection
$conn->close();
?>
