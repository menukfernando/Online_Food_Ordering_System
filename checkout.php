<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Fresh Wheels</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic styling for the checkout page */
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

        #order-summary,
        #shipping-details {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .cart-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="email"],
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .cart-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .cart-buttons .btn {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .cart-buttons .btn:hover {
            background-color: #555;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>

    <main>
        <div class="container">
            <section id="order-summary">
                <h2>Order Summary</h2>
                <div class="cart-items">
                    <?php

                    if (isset($_SESSION['cart'])) {
                        $cart_items = $_SESSION['cart'];
                        foreach ($cart_items as $index => $item) {
                            echo '<div class="cart-item">';
                            echo '<h3>' . $item['name'] . '</h3>';
                            echo '<p>Price: ₨' . number_format($item['price'], 2) . '</p>'; 
                            echo '<p>Quantity: ' . $item['quantity'] . '</p>';
                            echo '<p>Total: ₨' . number_format($item['price'] * $item['quantity'], 2) . '</p>'; 
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Your cart is empty.</p>';
                    }
                    ?>
                </div>
            </section>

            <section id="shipping-details">
                <h2>Shipping Details</h2>
                <form action="process_checkout.php" method="post">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required>

                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <h2>Payment Method</h2>
                    <label for="payment-method">Select Payment Method:</label>
                    <select id="payment-method" name="payment_method" required>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="cash_on_delivery">Cash on Delivery</option>
                    </select>

                    <button type="submit" class="btn">Place Order</button>
                </form>
            </section>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Fresh Wheels. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
