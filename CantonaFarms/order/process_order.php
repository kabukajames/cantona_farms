<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $customerName = $_POST["customerName"];
    $equipment = $_POST["equipment"];
    $rentalPeriod = $_POST["rentalPeriod"];
    
    // Calculate total price based on rental period and equipment
    $pricePerDay = 50; // Assume a fixed price per day for all equipment (you can adjust this)
    $totalPrice = $pricePerDay * $rentalPeriod;
    
    // You can perform additional validation or processing here
    
    // Save the order to the database (you need to implement this part)
    // Example:
    // save_order_to_database($customerName, $equipment, $rentalPeriod, $totalPrice);
    
    // Redirect back to the homepage or show a success message
    // Example:
    // header("Location: index.php");
    // exit();
}
?>
