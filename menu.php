<?php
// Define the getRandomImage function
function getRandomImage() {
    $imageDir = 'images/food/';
    $images = glob($imageDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

    if ($images !== false && count($images) > 0) {
        $randomImage = $images[array_rand($images)];
        return $randomImage;
    } else {
        return $imageDir . 'default.jpg'; // Fallback image if no images are found
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | Fresh Wheels</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic styling for the menu page */
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
            height: auto;
            margin: auto;
            overflow: hidden;
        }

        #menu-categories {
            margin-bottom: 20px;
        }

        #menu-categories h2{
            margin-bottom: 20px;
        }

        .category-list {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: space-around;
        }

        .category-list li {
            margin: 0 10px;
        }

        .category-list a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .category-list a.active {
            color: #ff6347;
        }


        .menu-item {
            background: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex-basis: calc(33.333% - 20px);
            box-sizing: border-box;
            flex-wrap: wrap;
            width: fit-content;
        }

        .menu-item h3 {
            margin: 0 0 10px 0;
        }

        .menu-item p {
            margin: 5px 0;
        }

        .menu-item .quantity {
            width: 50px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        .menu-item img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .add-to-cart {
            background-color: #ff6347;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-to-cart:hover {
            background-color: #ff4500;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <?php include ('header.php'); ?>

    <main>
        <div class="container">
            <section id="menu-categories">
                <h2>Menu Categories</h2>
                <ul class="category-list">
                    <li><a href="#" data-category="all" class="active">All</a></li>
                    <li><a href="#" data-category="appetizers">Appetizers</a></li>
                    <li><a href="#" data-category="main-courses">Main Courses</a></li>
                    <li><a href="#" data-category="desserts">Desserts</a></li>
                    <li><a href="#" data-category="drinks">Drinks</a></li>
                </ul>
            </section>

            <section id="menu-listings">
                <h2>Menu Items</h2>
                <div class="menu-items">
                    <?php
                    // Example PHP code to fetch menu items based on categories
                    $menu_items = [
                        ['name' => 'Caprese Salad', 'category' => 'appetizers', 'price' => '1000', 'description' => 'Fresh tomatoes, mozzarella, and basil.'],
                        ['name' => 'Margherita Pizza', 'category' => 'main-courses', 'price' => '1500', 'description' => 'Classic pizza with tomatoes, mozzarella, and basil.'],
                        ['name' => 'Tiramisu', 'category' => 'desserts', 'price' => '800', 'description' => 'Italian dessert with coffee, mascarpone, and cocoa.'],
                        ['name' => 'Cappuccino', 'category' => 'drinks', 'price' => '300', 'description' => 'Espresso with steamed milk and foam.'],
                        ['name' => 'Bruschetta', 'category' => 'appetizers', 'price' => '900', 'description' => 'Grilled bread with tomatoes, garlic, and basil.'],
                        ['name' => 'Lasagna', 'category' => 'main-courses', 'price' => '2000', 'description' => 'Layered pasta with meat, cheese, and tomato sauce.'],
                        ['name' => 'Cheesecake', 'category' => 'desserts', 'price' => '1200', 'description' => 'Creamy dessert with a graham cracker crust.'],
                        ['name' => 'Soda', 'category' => 'drinks', 'price' => '200', 'description' => 'Choice of cola, diet cola, or lemon-lime.'],
                        ['name' => 'Garlic Bread', 'category' => 'appetizers', 'price' => '700', 'description' => 'Toasted bread with garlic butter.'],
                        ['name' => 'Chicken Alfredo', 'category' => 'main-courses', 'price' => '2500', 'description' => 'Pasta with creamy Alfredo sauce and chicken.'],
                        ['name' => 'Chocolate Cake', 'category' => 'desserts', 'price' => '1500', 'description' => 'Rich chocolate cake with chocolate frosting.'],
                        ['name' => 'Iced Tea', 'category' => 'drinks', 'price' => '300', 'description' => 'Refreshing iced tea with lemon.'],
                    ];

                    foreach ($menu_items as $item) {
                        $randomImage = getRandomImage();
                        echo '<div class="menu-item ' . $item['category'] . '">';
                        echo '<img src="' . $randomImage . '" alt="' . $item['name'] . '">';
                        echo '<h3>' . $item['name'] . '</h3>';
                        echo '<p><strong>Price:</strong> Rs. ' . number_format($item['price']) . '</p>';
                        echo '<p><strong>Description:</strong> ' . $item['description'] . '</p>'; // Display description
                        echo '<p><strong>Quantity:</strong> <input type="number" class="quantity" value="1" min="1"></p>';
                        echo '<form method="POST" action="cart.php" class="add-to-cart-form">';
                        echo '<input type="hidden" name="name" value="' . $item['name'] . '">';
                        echo '<input type="hidden" name="price" value="' . $item['price'] . '">';
                        echo '<input type="hidden" name="description" value="' . $item['description'] . '">'; // Include description
                        echo '<input type="hidden" name="quantity" class="hidden-quantity" value="1">';
                        echo '<button type="submit" class="add-to-cart">Add to Cart</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Fresh Wheels. All rights reserved.</p>
        </div>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const addToCartForms = document.querySelectorAll('.add-to-cart-form');
        
        addToCartForms.forEach(form => {
            form.addEventListener('submit', function (event) {
                const quantityInput = this.querySelector('.quantity');
                const hiddenQuantityInput = this.querySelector('.hidden-quantity');
                hiddenQuantityInput.value = quantityInput.value;
            });
        });

        const categoryLinks = document.querySelectorAll('.category-list a');
        const menuItems = document.querySelectorAll('.menu-item');

        categoryLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const category = this.dataset.category;

                categoryLinks.forEach(link => link.classList.remove('active'));
                this.classList.add('active');

                menuItems.forEach(item => {
                    if (category === 'all' || item.classList.contains(category)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>

</body>
</html>
