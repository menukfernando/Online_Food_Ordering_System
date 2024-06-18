<?php
session_start();

// Function to logout
function logout()
{
    session_unset();
    session_destroy();
    header("Location: index.php");
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