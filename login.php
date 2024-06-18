<?php
// Initialize session
session_start();

// Check if user is already logged in
if (isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirect to homepage if logged in
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_food_ordering";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve user from database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id'];
            header("Location: index.php"); // Redirect to homepage
            exit();
        } else {
            $error_message = "Incorrect password";
        }
    } else {
        $error_message = "User not found";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Fresh Wheels</title>
    <link rel="stylesheet" href="styles.css">
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
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<li><a href="orders.php">My Orders</a></li>';
                        echo '<li><a href="#">' . $_SESSION['username'] . '</a></li>';
                    } else {
                        echo '<li><a href="register.php">Register</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>

    <section id="login">
        <div class="container">
            <h2>Login</h2>
            <?php
            if (isset($error_message)) {
                echo '<p class="error">' . $error_message . '</p>';
            }
            ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Fresh Wheels. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>