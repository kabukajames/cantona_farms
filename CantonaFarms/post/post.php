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
    $imageFileType = strtolower(pathinfo($targetFilePath,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        // Check file size
        if ($_FILES["file"]["size"] > 5000000) { // Adjust file size limit as needed
            echo "Sorry, your file is too large.";
        } else {
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            } else {
                // Upload file to server
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                    // Save the item to the database
                    $result = save_item_to_database($itemName, $description, $price, $targetFilePath);

                    // Redirect back to the dashboard with a success or error message
                    if ($result) {
                        header("Location: dashboard.php?message=Item posted successfully");
                        exit();
                    } else {
                        header("Location: dashboard.php?error=Error posting item");
                        exit();
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    } else {
        echo "File is not an image.";
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
        body {
            background-color: #f8f9fa; /* Set a light background color */
        }
        .form-container {
            max-width: 500px;
            margin: auto;
            background-color: #ffffff; /* Set a white background color for the form */
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Add a subtle shadow */
            padding: 30px;
            margin-top: 50px;
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #28a745; /* Set green color for the heading */
        }
        .form-control {
            border-color: #28a745; /* Set green border color for form controls */
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25); /* Add green focus effect */
            border-color: #28a745; /* Set green border color on focus */
        }
        .btn-primary {
            background-color: #28a745; /* Set green background color for primary button */
            border-color: #28a745; /* Set green border color for primary button */
        }
        .btn-primary:hover {
            background-color: #218838; /* Darker green color on hover */
            border-color: #1e7e34; /* Darker green border color on hover */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body form-container">
                    <h1 class="mb-4">Post a New Product</h1>
                    <form action="post_item.php" method="POST" enctype="multipart/form-data">
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
                        <button type="submit" class="btn btn-primary btn-block" ><a href="../index.html" style="color: #f8f9fa;">exit</a></button>                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
