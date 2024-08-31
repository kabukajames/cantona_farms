<?php
include ('./connection/connection.php') ;



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $description = $_POST["description"];

    $sql = "UPDATE photo SET description='$description' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Photo updated successfully.";
    } else {
        echo "Error updating photo: " . $conn->error;
    }
}

$conn->close();
?>
