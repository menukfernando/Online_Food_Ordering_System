<?php
session_start();

// Error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Simple validation (you can add more complex validation as needed)
    if (!empty($name) && !empty($email) && !empty($message)) {
        
        $host = 'localhost'; 
        $username = 'root'; 
        $password = ''; 
        $database = 'online_food_ordering'; 

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare SQL statement to insert message into 'messages' table
            $stmt = $pdo->prepare("INSERT INTO messages (name, email, message, created_at) VALUES (:name, :email, :message, NOW())");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':message', $message);

            // Execute the statement
            $stmt->execute();

            echo "Message inserted successfully."; // Debugging message

   
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage(); // Debugging message
        }
    } else {
        echo "Validation error: Please fill in all fields."; // Debugging message
    }
} else {
    echo "Method error: Only POST method allowed."; // Debugging message
}
?>
