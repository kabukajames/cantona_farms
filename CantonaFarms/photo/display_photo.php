<?php

include('../connection/connection.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select photos from the database
$sql = "SELECT * FROM photo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-3">';
        echo '<img src="' . $row['image_path'] . '" class="img-fluid">';
        echo '<p>' . $row['description'] . '</p>';
        echo '<div>';
        echo '<a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No photos uploaded yet.";
}

$conn->close();
?>
