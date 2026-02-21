<?php
// Include the file that contains functions to fetch images from the database
include '../Common/Config/fetch_images.php';

// Get the 'gallery' parameter from the URL query string, default to 'All' if not set
$gallery = isset($_GET['gallery']) ? $_GET['gallery'] : 'All';

// Fetch all images if 'All' is selected, otherwise fetch images from the specific gallery
if ($gallery === 'All') {
    $images = fetchAllImages(); // Fetch all images
} else {
    $images = fetchImagesByGallery($gallery); // Fetch images based on the selected gallery
}

// Set the content type to JSON for the response
header('Content-Type: application/json');

// Convert the images array to JSON format and output it
echo json_encode($images);
?>
