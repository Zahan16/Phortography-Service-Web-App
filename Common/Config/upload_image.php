<?php
include '../DB/conn.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $title = $_POST['title'];
    $gallery = $_POST['gallery'];
    $file = $_FILES['file'];

    // Define the target directory based on the gallery name
    $targetDir = '../images/' . $gallery . '/';
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFile = $targetDir . basename($file['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Generate a unique file name
    $fileName = uniqid() . '-' . basename($file['name']);
    $uploadFile = $targetDir . $fileName;

    // Check if image file is an actual image or fake image
    $check = getimagesize($file['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // Check file size
    if ($file['size'] > 5000000) { // 5MB limit
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedFormats = array('jpg', 'jpeg', 'png', 'gif');
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    } else {
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            // Insert the gallery if it doesn't exist
            $stmt = $conn->prepare("INSERT INTO Gallery (Gallery_Name) SELECT ? WHERE NOT EXISTS 
            (SELECT 1 FROM Gallery WHERE Gallery_Name = ?)");
            if ($stmt === false) {
                echo "Prepare failed: (" . $conn->errno . ") " . $conn->error . "<br>";
            } else {
                $stmt->bind_param("ss", $gallery, $gallery);
                if (!$stmt->execute()) {
                    echo "Error inserting gallery: (" . $stmt->errno . ") " . $stmt->error . "<br>";
                }
                $stmt->close();
            }

            // Insert the photo
            $stmt = $conn->prepare("INSERT INTO Photos (Title, File_Name, Date_uploaded, Gallery_ID) 
               VALUES (?, ?, NOW(), (SELECT Gallery_ID FROM Gallery WHERE Gallery_Name = ?))");
            if ($stmt === false) {
                echo "Prepare failed: (" . $conn->errno . ") " . $conn->error . "<br>";
            } else {
                $stmt->bind_param("sss", $title, $fileName, $gallery);
                if ($stmt->execute()) {
                    echo "The file " . basename($file['name']) . " has been uploaded and inserted into the database.<br>";
                } else {
                    echo "Error inserting photo: (" . $stmt->errno . ") " . $stmt->error . "<br>";
                }
                $stmt->close();
            }
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }
}
?>