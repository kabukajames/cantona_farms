<?php 
include("../connection/connection.php");

if(isset($_POST["data"])){
    // Retrieve form data
    $customerName = $_POST["customerName"];
    $equipment = $_POST["equipment"];
    $rentalPeriod = $_POST["rentalPeriod"];
    
    // Calculate total price based on rental period and equipment
    $pricePerDay = 5000; // Assume a fixed price per day for all equipment (you can adjust this)
    $totalPrice = $pricePerDay * $rentalPeriod;

    // Function to save order to the database
    function save_order_to_database($customerName, $equipment, $rentalPeriod, $totalPrice) {
        global $conn;
        
        // Prepare SQL statement
        $sql = "INSERT INTO `order` (customer_name, equipment, rental_period, total_price) 
                VALUES ('$customerName', '$equipment', '$rentalPeriod', '$totalPrice')";
        
        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
    // Save the order to the database
    save_order_to_database($customerName, $equipment, $rentalPeriod, $totalPrice);
    
    // Redirect back to the homepage or show a success message
    header("Location: ../index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cantona Farms - Rent Farming Equipment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4" style="font-family: Georgia, 'Times New Roman', Times, serif;">Welcome to Cantona Farms</h1>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card" style="background-color:light-green;">
                <div class="card-header">
                    <h3 class="text-center" style="font-family: Georgia, 'Times New Roman', Times, serif;"  >Rent Farming Equipment</h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group">
                            <label for="customerName">Your Name</label>
                            <input type="text" aria-autocomplete="off" class="form-control" id="customerName" name="customerName" required>
                        </div>
                        <div class="form-group">
                            <label for="equipment">Select Equipment</label>
                            <select class="form-control" id="equipment" name="equipment" required>
                                <option value="">Select Equipment</option>
                                <option value="Tractor">Tractor</option>
                                <option value="Harvester">Harvester</option>
                                <option value="Plough">Plough</option>
                                <option value="Plough">land</option>
                                <option value="Plough">drone</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rentalPeriod">Rental Period (in days)</label>
                            <input type="number" class="form-control" id="rentalPeriod" name="rentalPeriod" required>
                        </div>
                        <button type="submit" class="btn btn-outline-primary" name="data" class="btn btn-primary btn-block">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
