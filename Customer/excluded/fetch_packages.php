<?php
include '../DB/conn.php';

header('Content-Type: application/json');

$service = isset($_GET['service']) ? $_GET['service'] : '';

// Prepare SQL query based on service type
$stmt = $conn->prepare("SELECT title, description, price FROM Packages WHERE service_type = ?");
$stmt->bind_param("s", $service);
$stmt->execute();
$result = $stmt->get_result();

$packages = [];
while ($row = $result->fetch_assoc()) {
    $packages[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($packages);
?>
