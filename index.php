<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh Wheels</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <?php include ('header.php'); ?>


    <section id="hero">
        <div class="container">
            <h2>Order Food Online</h2>
            <p>Discover local restaurants and your favorite dishes with ease!</p>
            <a href="#featured-restaurants" class="btn">Explore Restaurants</a>
        </div>
    </section>

    <section id="featured-restaurants">
        <div class="container">
            <h2>Featured Restaurants</h2>
            <div class="restaurant-list">
                <div class="restaurant">
                    <img src="./images/FoodImage2.jpg" alt="Restaurant A">
                    <h3>KingsBury</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <a href="restaurants.php" class="btn">View Menu</a>
                </div>
                <div class="restaurant">
                    <img src="./images/FoodImage.jpg" alt="Restaurant B">
                    <h3>Jadi</h3>
                    <p>Nulla facilisi. Sed feugiat tellus ut metus aliquet.</p>
                    <a href="restaurants.php" class="btn">View Menu</a>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Fresh Wheels. All rights reserved.</p>
        </div>
    </footer>
    <script>
        // JavaScript function to handle logout
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'index.php?logout=true';
            }
        }
    </script>
</body>

</html>