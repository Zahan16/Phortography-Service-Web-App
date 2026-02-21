<?php
// Set error reporting to display and log all errors
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json'); // Set the content type to JSON for the response

include '../DB/conn.php'; // Include the database connection

// Function to fetch images by gallery name
function fetchImagesByGallery($galleryName) {
    global $conn;
    
    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT p.Photo_ID, p.File_Name, p.Title, g.Gallery_Name 
                            FROM Photos p 
                            JOIN Gallery g ON p.Gallery_ID = g.Gallery_ID 
                            WHERE g.Gallery_Name = ?");
    
    // Handle SQL preparation errors
    if ($stmt === false) {
        echo json_encode(['error' => 'Prepare failed: (' . $conn->errno . ') ' . $conn->error]);
        return [];
    }

    // Bind the gallery name parameter
    $stmt->bind_param("s", $galleryName);

    // Execute the statement and handle execution errors
    if ($stmt->execute() === false) {
        echo json_encode(['error' => 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error]);
        $stmt->close();
        return [];
    }

    // Fetch the result and handle errors
    $result = $stmt->get_result();
    if ($result === false) {
        echo json_encode(['error' => 'Get result failed: (' . $stmt->errno . ') ' . $stmt->error]);
        $stmt->close();
        return [];
    }

    // Fetch all images as an associative array
    $images = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $images;
}

// Function to fetch all images
function fetchAllImages() {
    global $conn;
    
    // SQL query to fetch all images
    $sql = "SELECT p.Photo_ID, p.File_Name, p.Title, g.Gallery_Name 
            FROM Photos p 
            JOIN Gallery g ON p.Gallery_ID = g.Gallery_ID";
    
    // Execute the query and handle errors
    $result = $conn->query($sql);
    if ($result === false) {
        echo json_encode(['error' => 'Query failed: (' . $conn->errno . ') ' . $conn->error]);
        return [];
    }

    // Return all images as an associative array
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Get the gallery name from the query parameter, default to 'AllImages'
$gallery = isset($_GET['gallery']) ? $_GET['gallery'] : 'AllImages';

if ($gallery == 'AllImages') {
    $images = fetchAllImages(); // Fetch all images if 'AllImages' is requested
} else {
    $images = fetchImagesByGallery($gallery); // Fetch images for the specified gallery
}

// Return the images as a JSON response
echo json_encode($images);

// Handle any JSON encoding errors
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['error' => 'JSON encoding error: ' . json_last_error_msg()]);
}
?>
