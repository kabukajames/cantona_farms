<?php
include('../connection/connection.php');



$sql = "SELECT * FROM photo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-3">';
        echo '<img src="uploads/' . $row['image_name'] . '" class="img-fluid">';
        echo '<p>' . $row['description'] . '</p>';
        echo '</div>';
    }
} else {
    echo "No photos uploaded yet.";
}

$conn->close();
?>
