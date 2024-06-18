<?php
session_start();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST['name'];
    $item_price = $_POST['price'];
    $item_quantity = $_POST['quantity'];

    // Debugging to the error log
    error_log('Form submitted');
    error_log('Item Name: ' . $item_name);
    error_log('Item Price: ' . $item_price);
    error_log('Item Quantity: ' . $item_quantity);

    // Add item to session cart
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if item already exists in cart and update quantity
    $item_exists = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['name'] === $item_name) {
            $cart_item['quantity'] += $item_quantity;
            $item_exists = true;
            break;
        }
    }

    // If item does not exist, add new item
    if (!$item_exists) {
        $_SESSION['cart'][] = [
            'name' => $item_name,
            'price' => $item_price,
            'quantity' => $item_quantity
        ];
    }

    // Redirect to the cart page to avoid form resubmission
    header('Location: cart.php');
    exit();
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

function logout()
{
    session_unset();
    session_destroy();
    header("Location: index.php"); // Redirect to index.php after logout
    exit;
}

// Check if user is logged in
if (isset($_SESSION['username'])) {
    $account_name = $_SESSION['username'];
    $account_link = "javascript:logout();"; // Logout function call
    $orders_link = '<li><a href="orders.php">My Orders</a></li>';
} else {
    $account_name = "Register";
    $account_link = "register.php";
    $orders_link = '';
}

// Handle logout request
if (isset($_GET['logout'])) {
    logout();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Fresh Wheels</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic styling for the cart page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        header nav ul li {
            margin-left: 20px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        main {
            padding: 20px 0;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        .cart-items {
            background: #fff;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            max-height: 300px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item h3 {
            margin: 0;
        }

        .cart-item p {
            margin: 0 10px;
        }

        .cart-item .quantity {
            width: 50px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        .remove-item {
            background-color: #ff6347;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .remove-item:hover {
            background-color: #ff4500;
        }

        .total {
            text-align: right;
            margin: 20px 0;
        }

        .total h3 {
            margin: 0;
        }

        .checkout-buttons {
            text-align: center;
            margin: 20px 0;
        }

        .checkout-buttons button {
            background-color: #ff6347;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 10px;
        }

        .checkout-buttons button:hover {
            background-color: #ff4500;
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <h1>Fresh Wheels</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="restaurants.php">Restaurants</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php echo $orders_link; ?>
                <li><a href="<?php echo $account_link; ?>"><?php echo $account_name; ?></a></li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <div class="container">
        <h2>Your Cart</h2>
        <div class="cart-items">
            <?php
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                foreach ($_SESSION['cart'] as $item) {
                    echo '<div class="cart-item">';
                    echo '<h3>' . $item['name'] . '</h3>';
                    echo '<p>Price: Rs. ' . number_format($item['price']) . '</p>'; // Display price in LKR
                    echo '<p>Quantity: ' . $item['quantity'] . '</p>';
                    echo '<form method="POST" action="remove_item.php">';
                    echo '<input type="hidden" name="name" value="' . $item['name'] . '">';
                    echo '<button type="submit" class="remove-item">Remove</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>Your cart is empty.</p>';
            }
            ?>
        </div>
        <div class="total">
            <h3>Total: Rs. <?php echo isset($_SESSION['cart']) ? number_format(calculate_total_price($_SESSION['cart'])) : '0.00'; ?></h3>
        </div>
        <div class="checkout-buttons">
            <button onclick="window.location.href='checkout.php'">Proceed to Checkout</button>
            <button onclick="window.location.href='menu.php'">Continue Shopping</button>
        </div>
    </div>
</main>

<footer>
    <div class="container">
        <p>&copy; 2024 Fresh Wheels. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
