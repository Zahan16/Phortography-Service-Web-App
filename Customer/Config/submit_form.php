<?php
// Database connection settings
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "lismoreDB";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$inquiryType = $_POST['inquiry-type'];
$location = $_POST['location'];
$functionDate = $_POST['date'];
$inquiry = $_POST['inquiry'];

// Find the corresponding Service_ID
$sql = "SELECT Service_ID FROM services WHERE Service_Name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $inquiryType);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$serviceID = $row['Service_ID'];

if (!$serviceID) {
    die("Error: Service not found.");
}

// Prepare the SQL statement to insert data into the inquiries table
$sql = "INSERT INTO inquiries 
(Name, Email, Service_ID, Location, Function_Date, Inquiry) 
VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisss", $name, $email, $serviceID, 
$location, $functionDate, $inquiry);

// Execute the statement
if ($stmt->execute()) {
    echo "Inquiry submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
