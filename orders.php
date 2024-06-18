<?php
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

// Query to fetch orders with customer and item details
$sql = "SELECT o.id as order_id, o.total_amount, o.payment_method, o.order_status, 
               c.name as customer_name, c.email, c.address, c.phone,
               oi.name as item_name, oi.price, oi.quantity, oi.total as item_total
        FROM orders o
        INNER JOIN customers c ON o.customer_id = c.id
        INNER JOIN order_items oi ON o.id = oi.order_id
        ORDER BY o.id DESC"; 

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders | Fresh Wheels</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic styling for the orders page */
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        .order-details {
            margin-bottom: 10px;
        }

        .order-items {
            border-top: 1px solid #ccc;
            margin-top: 10px;
            padding-top: 10px;
        }

        .item {
            margin-bottom: 10px;
        }

        .item:last-child {
            margin-bottom: 0;
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
            <h2>Orders</h2>
            <?php
            if ($result->num_rows > 0) {
                echo '<table>';
                echo '<tr>';
                echo '<th>Order ID</th>';
                echo '<th>Total Amount</th>';
                echo '<th>Payment Method</th>';
                echo '<th>Status</th>';
                echo '<th>Customer Name</th>';
                echo '<th>Email</th>';
                echo '<th>Address</th>';
                echo '<th>Phone</th>';
                echo '</tr>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['order_id'] . '</td>';
                    echo '<td>$' . $row['total_amount'] . '</td>';
                    echo '<td>' . $row['payment_method'] . '</td>';
                    echo '<td>' . $row['order_status'] . '</td>';
                    echo '<td>' . $row['customer_name'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['address'] . '</td>';
                    echo '<td>' . $row['phone'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo '<p>No orders found.</p>';
            }

            // Close database connection
            $conn->close();
            ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Fresh Wheels. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
