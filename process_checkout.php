<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_food_ordering";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to calculate total cart price
function calculate_total_price($cart)
{
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

// Insert customer information
$customerName = $_POST['name'];
$customerEmail = $_POST['email'];
$customerAddress = $_POST['address'];
$customerPhone = $_POST['phone'];

$insertCustomerQuery = "INSERT INTO customers (name, email, address, phone) 
                       VALUES ('$customerName', '$customerEmail', '$customerAddress', '$customerPhone')";

if ($conn->query($insertCustomerQuery) === TRUE) {
    $customerId = $conn->insert_id; // Get the auto-generated ID of the inserted customer
} else {
    echo "Error: " . $insertCustomerQuery . "<br>" . $conn->error;
    exit;
}

// Insert order information
$totalAmount = calculate_total_price($_SESSION['cart']); // Calculate total amount from session cart
$paymentMethod = $_POST['payment_method'];
$orderStatus = 'Pending'; // Default status, can be updated as per order processing flow

$insertOrderQuery = "INSERT INTO orders (customer_id, total_amount, payment_method, order_status) 
                    VALUES ($customerId, $totalAmount, '$paymentMethod', '$orderStatus')";

if ($conn->query($insertOrderQuery) === TRUE) {
    $orderId = $conn->insert_id; // Get the auto-generated ID of the inserted order
} else {
    echo "Error: " . $insertOrderQuery . "<br>" . $conn->error;
    exit;
}

// Insert order items
foreach ($_SESSION['cart'] as $item) {
    $itemName = $item['name'];
    $itemPrice = $item['price'];
    $itemQuantity = $item['quantity'];
    $itemTotal = $itemPrice * $itemQuantity;

    $insertItemQuery = "INSERT INTO order_items (order_id, name, price, quantity, total) 
                        VALUES ($orderId, '$itemName', $itemPrice, $itemQuantity, $itemTotal)";

    if ($conn->query($insertItemQuery) !== TRUE) {
        echo "Error: " . $insertItemQuery . "<br>" . $conn->error;
        exit;
    }
}

// Close database connection
$conn->close();

// Clear the cart after successful checkout
unset($_SESSION['cart']);

// Redirect to a thank you page or order confirmation page
header('Location: orders.php');
exit;
?>
