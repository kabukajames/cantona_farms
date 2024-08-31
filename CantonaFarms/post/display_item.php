<?php
// Include database connection file
include("../connection/connection.php");

// Fetch all items from the database
$sql = "SELECT * FROM items";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1 class="my-4">Items</h1>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo $row['image_path']; ?>" class="card-img-top" alt="Item Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['item_name']; ?></h5>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                            <p class="card-text">Price: $<?php echo $row['price']; ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No items found.";
        }
        ?>
    </div>
</div>

</body>
</html>
