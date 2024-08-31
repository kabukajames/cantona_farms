<?php
include('../connection/connection.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM photo WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        // Delete photo file from uploads folder (optional)
        // $photo_name = fetch photo name from database using $id
        // unlink("uploads/" . $photo_name);
        echo "Photo deleted successfully.";
    } else {
        echo "Error deleting photo: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
