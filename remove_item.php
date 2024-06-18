<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST['name'];

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $cart_item) {
            if ($cart_item['name'] === $item_name) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
        // Reindex the array to avoid gaps
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

header('Location: cart.php');
exit;
?>