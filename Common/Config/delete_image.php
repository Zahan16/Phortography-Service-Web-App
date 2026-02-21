<?php
include '../DB/conn.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Check if the request method is POST
    $photoIds = json_decode($_POST['photo_ids'], true); // Decode the JSON array of photo IDs

    if (is_array($photoIds) && count($photoIds) > 0) { // Ensure there are photo IDs to process
        foreach ($photoIds as $photoId) {
            // Fetch the image file name and gallery ID from the database
            $stmt = $conn->prepare("SELECT File_Name, Gallery_ID FROM Photos WHERE Photo_ID = ?");
            $stmt->bind_param("i", $photoId);
            $stmt->execute();
            $stmt->bind_result($fileName, $galleryId);
            $stmt->fetch();
            $stmt->close();

            if ($fileName && $galleryId) { // Ensure the file name and gallery ID are found
                // Fetch the gallery name from the database
                $stmt = $conn->prepare("SELECT Gallery_Name FROM Gallery WHERE Gallery_ID = ?");
                $stmt->bind_param("i", $galleryId);
                $stmt->execute();
                $stmt->bind_result($galleryName);
                $stmt->fetch();
                $stmt->close();

                if ($galleryName) { // Ensure the gallery name is found
                    // Construct the file path based on the gallery name and file name
                    $filePath = '../images/' . $galleryName . '/' . $fileName;

                    // Delete the file from the server if it exists
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }

                    // Delete the record from the database
                    $stmt = $conn->prepare("DELETE FROM Photos WHERE Photo_ID = ?");
                    $stmt->bind_param("i", $photoId);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "No gallery found with the provided ID: $galleryId"; 
                    // Error message if gallery name is not found
                }
            } else {
                echo "No image found with the provided ID: $photoId"; 
                // Error message if file name or gallery ID is not found
            }
        }

        echo "Selected images have been deleted."; // Success message after deletion
    } else {
        echo "No image IDs provided."; // Error message if no photo IDs are provided
    }
} else {
    echo "Invalid request method."; // Error message if request method is not POST
}
?>
