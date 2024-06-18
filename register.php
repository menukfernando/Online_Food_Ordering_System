<?php
// Initialize session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_food_ordering";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password (for production use, do not store plain passwords)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful, redirect to login page
        $_SESSION['message'] = 'Registration successful! Please log in.';
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to logout
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


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Fresh Wheels</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <div class="container">
            <h1>Online Food Ordering</h1>
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

    <section id="register">
        <div class="container">
            <h2>Register</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Fresh Wheels. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>