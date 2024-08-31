<?php
include('../connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $image_name = $_FILES["image"]["name"];
    $description = $_POST["description"];
    $created_at = date("Y-m-d H:i:s");
    
    // Upload image to server
    $targetDirectory = "../uploads/upload.php";
    $targetFile = $targetDirectory . basename($image_name);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

    // Insert photo details into database
    $sql = "INSERT INTO photo (image_name, description, created_at) VALUES ('$image_name', '$description', '$created_at')";
    if ($conn->query($sql) === TRUE) {
        echo "Photo uploaded successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
