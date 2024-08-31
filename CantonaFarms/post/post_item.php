<?php
// Include database connection file
include("../connection/connection.php");

// Function to save item to the database
function save_item_to_database($itemName, $description, $price, $imagePath) {
    global $conn;
    
    // Prepare SQL statement
    $sql = "INSERT INTO items (item_name, description, price, image_path) 
            VALUES ('$itemName', '$description', '$price', '$imagePath')";
    
    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        return true; // Item saved successfully
    } else {
        return false; // Error occurred while saving item
    }
}

// Check if the form for posting an item is submitted
if(isset($_POST["post_item"])) {
    // Retrieve form data
    $itemName = $_POST["itemName"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    // File upload
    $targetDir = "uploads/";
    $targetFilePath = $targetDir . basename($_FILES["file"]["name"]);

    // Check if the directory exists or create it
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Check if the file already exists
    if (file_exists($targetFilePath)) {
        echo "Sorry, a file with the same name already exists.";
    } else {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            // Save the item to the database
            $result = save_item_to_database($itemName, $description, $price, $targetFilePath);

            // Check if the item was saved successfully
            if ($result) {
                header("Location: post.php?message=Item posted successfully");
                exit();
            } else {
                header("Location: post.php?error=Error posting item to database");
                exit();
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Post Item</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Your CSS styles */
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h1 class="mb-4">Post a New Product</h1>
                    <?php
                    // Display success or error messages
                    if(isset($_GET["message"])) {
                        echo '<div class="alert alert-success">' . $_GET["message"] . '</div>';
                    } elseif(isset($_GET["error"])) {
                        echo '<div class="alert alert-danger">' . $_GET["error"] . '</div>';
                    }
                    ?>
                    <form action="post.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="itemName">Product Name</label>
                            <input type="text" class="form-control" id="itemName" name="itemName" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="file">Product Image</label>
                            <input type="file" class="form-control-file" id="file" name="file" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="post_item">Post Item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
